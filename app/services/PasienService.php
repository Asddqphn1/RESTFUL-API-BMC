<?php

namespace App\Services;

use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasienService
{
    /**
     * Membuat data pasien baru.
     *
     * @param array $data Data tervalidasi dari request.
     * @param string $bidanId ID Bidan yang sedang login.
     * @return \App\Models\Pasien
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createPasien(array $data, string $bidanId): Pasien
    {
        // Cek duplikasi no_reg atau username
        if (Pasien::where('no_reg', $data['no_reg'])->exists()) {
            throw ValidationException::withMessages([
                'no_reg' => 'Nomor registrasi sudah terdaftar.',
            ]);
        }

        if (Pasien::where('username', $data['username'])->exists()) {
            throw ValidationException::withMessages([
                'username' => 'Username sudah terdaftar.',
            ]);
        }

        // Buat pasien baru
        $pasien = Pasien::create([
            'no_reg' => $data['no_reg'],
            'username' => $data['username'],
            'nama' => $data['nama'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'umur' => $data['umur'],
            'gravida' => $data['gravida'],
            'paritas' => $data['paritas'],
            'abortus' => $data['abortus'],
            'bidan_id' => $bidanId, // Ambil dari Bidan yang login
        ]);

        return $pasien;
    }
}
  