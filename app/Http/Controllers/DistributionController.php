<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\DistributionDetail;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class DistributionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Distribution::with('barista')->latest();
            return DataTables::of($data)
                ->addColumn('barista', fn($row) => optional($row->barista)->name ?? '-')
                ->addColumn('action', function($row){
                    return '
                        <button class="btn btn-sm btn-info detail" data-id="'.$row->id.'">Detail</button>
                        <button class="btn btn-sm btn-danger delete" data-id="'.$row->id.'">Delete</button>
                    ';
                })
                ->make(true);
        }
        return view('distributions.index');
        
    }

    public function show($id)
    {
        $distribution = Distribution::with('products')->findOrFail($id);
        return view('distributions.show', compact('distribution'));
    }


    public function create()
    {
        $baristas = User::where('active',1)->get();
        $products = Product::where('active',1)->get();
        return view('distributions.create',compact('baristas','products'));
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){
            $distribution = Distribution::create([
                'barista_id' => $request->barista_id,
                'total_qty' => $request->total_qty,
                'estimated_result' => $request->estimated_result,
                'notes' => $request->notes,
                'created_by' => Auth::id(),
            ]);

            DistributionDetail::whereNull('distribution_id')
            ->where('created_by', Auth::id())
            ->update(['distribution_id' => $distribution->id]);

        });

        return redirect()->route('distributions.index')->with('success','Distribusi berhasil disimpan');
    }

    // DistributionController.php

public function destroy(Distribution $distribution)
{
    // Hapus header + cascade details (kalau FK tidak cascade, hapus manual)
    $distribution->details()->delete();
    $distribution->delete();

    return response()->json(['success' => true]);
}

public function details(Distribution $distribution)
{
    // JSON buat modal detail
    $distribution->load(['details.product', 'barista']);
    return response()->json([
        'id' => $distribution->id,
        'barista' => $distribution->barista->name ?? '-',
        'total_qty' => $distribution->total_qty,
        'estimated_result' => $distribution->estimated_result,
        'notes' => $distribution->notes,
        'created_at' => $distribution->created_at?->toDateTimeString(),
        'items' => $distribution->details->map(fn ($d) => [
            'product' => $d->product->name ?? '-',
            'qty' => $d->qty,
            'price' => $d->price,
            'total' => $d->total,
        ])->values(),
    ]);
}

}
