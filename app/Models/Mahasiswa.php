<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['nama', 'nim', 'jurusan', 'email', 'alamat'];
}

