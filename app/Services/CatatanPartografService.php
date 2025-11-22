<?php

namespace App\Services;

use App\Models\CatatanPartograf;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CatatanPartografService
{
    // Buat catatan baru
    public function create(array $data)
{
    $validatedData = CatatanPartograf::validateData($data);

    // Logika bisnis: generate ID
    $validatedData['id'] = $validatedData['id'] ?? now()->format('YmdHis') . Str::random(7);

    // Waktu catat: pakai dari input jika ada, else pakai waktu sekarang
    if (!empty($data['waktu_catat'])) {
        // Parse format ISO dari React Native (2025-11-22T21:00:00) ke format SQL (2025-11-22 21:00:00)
        $validatedData['waktu_catat'] = Carbon::parse($data['waktu_catat'])->format('Y-m-d H:i:s');
    } else {
        $validatedData['waktu_catat'] = now()->toDateTimeString();
    }

    return CatatanPartograf::create($validatedData);
}

    // Ambil semua catatan berdasarkan partograf_id
    public function getByPartografId(string $partografId)
    {
        return CatatanPartograf::with('kontraksi')
            ->where('partograf_id', $partografId)
            ->orderBy('waktu_catat', 'asc')
            ->get();
    }
}
