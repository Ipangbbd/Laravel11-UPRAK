<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\User;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-peminjaman|edit-peminjaman|delete-peminjaman', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-peminjaman', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-peminjaman', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-peminjaman', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $peminjaman = Peminjaman::with(['barang', 'user'])->orderByDesc('id')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }


    public function create()
    {
        $barang = Barang::orderBy('nama')->get();
        $user = User::orderBy('name')->get();
        return view('peminjaman.create', compact('barang', 'user'));
    }

    public function store(StorePeminjamanRequest $request)
    {
        Peminjaman::create($request->validated());
        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil dibuat');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['barang', 'user']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $barang = Barang::orderBy('nama')->get();
        $user = User::orderBy('name')->get();
        return view('peminjaman.edit', compact('peminjaman', 'barang', 'user'));
    }

    public function update(UpdatePeminjamanRequest $request, Peminjaman $peminjaman)
    {
        $peminjaman->update($request->validated());
        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
