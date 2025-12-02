<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-kategori|edit-kategori|delete-kategori', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-kategori', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kategori', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kategori', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        // view index
        $kategori = Kategori::orderBy('nama')->get();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        // create
        return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request)
    {
        // store & validate
        Kategori::create($request->validated());
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        // show
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        // edit
        return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        // update & validate
        $kategori->update($request->validated());
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        // Prevent deleting a category that still has related barangs
        if ($kategori->barangs()->exists()) {
            return redirect()->route('kategoris.index')->with('error', 'Kategori tidak dapat dihapus karena ada barang terkait.');
        }

        // delete
        $kategori->delete();

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
