<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Produk\StoreRequest;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        if($keyword) {
            $products = Produk::when($keyword, function($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
        } else {
            $products = Produk::latest()->paginate(10)->withQueryString();
        }

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);

        return view('produk.create');
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data['user_id'] = Auth::id();
        $data['nama'] = $dataReq['name'];
        $data['harga_beli'] = $dataReq['purchase_price'];
        $data['harga_jual'] = $dataReq['selling_price'];
        $data['stok'] = $dataReq['stock'];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Product created successfully.');
    }

    public function edit(Produk $produk)
    {
        $this->authorize('create', $produk);

        return view('produk.edit', compact('produk'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('create', $produk);

        $dataReq = $request->validated();

        
        $data = [
            'user_id' => Auth::id(),
            'nama' => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok' => $dataReq['stock'],
        ];

        if ($request->hasFile('foto')) {
            
        if (
            $produk->foto &&
            Storage::disk('public')->exists($produk->foto)
        ) {
            Storage::disk('public')->delete($produk->foto);
        }
        $data['foto'] = $request->file('foto')->store('products', 'public');
        }
        $produk->update($data);

        return redirect()->route('produk.edit', $produk->id)->with('success', 'Product update successfully');
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('create', $produk);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Product deleted successfully');
    }

    public function show(Produk $produk)
{
    $this->authorize('view', $produk);

    return view('produk.show', compact('produk'));
}
}
