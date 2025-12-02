<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:barangs,nama',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
        ];
    }
}
