<?php 
namespace App\Http\Controllers;

use App\Models\DistributionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistributionProductController extends Controller
{
    public function index(Request $request)
    {
        $data = DistributionDetail::whereNull('distribution_id')
            ->where('created_by', auth()->id)
            ->with('product');

        return DataTables::of($data)
            ->addColumn('product', fn($row) => $row->product->name)
            ->make(true);
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        DistributionDetail::create([
            'distribution_id' => null,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'price' => $product->price,
            'total' => $product->price * $request->qty,
            'created_by' => auth()->id,
        ]);

        return response()->json(['success'=>true]);
    }

    public function destroy($id)
    {
        DistributionDetail::where('id',$id)
            ->whereNull('distribution_id')
            ->delete();

        return response()->json(['success'=>true]);
    }
}
