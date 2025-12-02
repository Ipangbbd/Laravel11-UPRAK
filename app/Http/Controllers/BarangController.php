<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-barang', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-barang', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-barang', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-barang', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        // index view
        return view('barang.index', [
            'barangs' => Barang::orderByDesc('id')->paginate(10)
        ]);
    }

    public function create(): View
    {
        // create view
        return view('barang.create', [
            'kategoris' => Kategori::orderBy('nama')->get(),
        ]);
    }

    public function store(StoreBarangRequest $request)
    {
        // store
        Barang::create($request->validated());
            return redirect()->route('barangs.index')->withSuccess('Barang berhasil ditambahkan');
    }

    public function show(Barang $barang): View
    {
        // show
        return view('barang.show', [
            'barang' => $barang
        ]);
    }

    public function edit(Barang $barang): View
    {
        // edit
        return view('barang.edit', [
            'barang' => $barang,
            'kategoris' => Kategori::orderBy('nama')->get(),
        ]);
    }

    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        // update
        $barang->update($request->validated());
            return redirect()->route('barangs.index')->withSuccess('Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang): RedirectResponse
    {
        // delete
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus');
    }
}
