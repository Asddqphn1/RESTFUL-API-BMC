<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pasien extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'pasien';
    protected $primaryKey = 'no_reg';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'no_reg',
        'username',
        'nama',
        'password',
        'alamat',
        'umur',
        'gravida',
        'paritas',
        'abortus',
        'bidan_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'umur' => 'integer',
        'gravida' => 'integer',
        'paritas' => 'integer',
        'abortus' => 'integer',
    ];

    // 🔗 Relasi ke tabel bidan
    public function bidan()
    {
        return $this->belongsTo(Bidan::class, 'bidan_id', 'id');
    }

    // --- Metode Wajib JWT ---
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => 'pasien', // bisa dipakai buat identifikasi guard
        ];
    }
}
