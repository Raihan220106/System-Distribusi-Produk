<?php 
namespace App\Http\Controllers;

use App\Models\DistributionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class DistributionProductController extends Controller
{
    public function index(Request $request)
    {
        $data = DistributionDetail::whereNull('distribution_id')
            ->where('created_by', Auth::id())
            ->with('product');

        return DataTables::of($data)
            ->addColumn('product', fn($row) => $row->product->name ?? '-')
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $distributionDetail = DistributionDetail::create([
            'distribution_id' => null,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'price' => $product->price,
            'total' => $product->price * $request->qty,
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'success'=>true,
            'data'=>$distributionDetail
        ]);
    }

    public function destroy($id)
    {
        $detail = DistributionDetail::where('id',$id)
            ->whereNull('distribution_id')
            ->first();

        if (!$detail) {
            return response()->json(['success'=>false, 'message'=>'Data tidak ditemukan'], 404);
        }

        $detail->delete();
        return response()->json(['success'=>true]);
    }
}
