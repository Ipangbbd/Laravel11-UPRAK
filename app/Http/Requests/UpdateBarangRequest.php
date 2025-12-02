<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:barangs,nama,'.$this->barang->id,
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
        ];
    }
}