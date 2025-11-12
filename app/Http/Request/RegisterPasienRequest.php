<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPasienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Di sini Anda bisa menambahkan logika untuk mengecek apakah user adalah Bidan.
     * Untuk saat ini, kita anggap middleware 'auth' sudah menangani ini.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Pastikan user sudah login
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'no_reg' => 'required|numeric|unique:pasien,no_reg',
            'username' => 'required|string|max:25|unique:pasien,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string|max:25',
            'umur' => 'required|numeric',
            'gravida' => 'required|numeric',
            'paritas' => 'required|numeric',
            'abortus' => 'required|numeric',
        ];
    }
}