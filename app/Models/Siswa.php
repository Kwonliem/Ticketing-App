<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'nisn';

    protected $fillable = [
        'nisn',
        'nama',
        'email',
        'email_verified_at',
        'username',
        'password',
        'telp',
        'telp_verified_at',
        'provider_id',
        'provider',
    ];
}
