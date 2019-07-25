<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $fillable = ['nim', 'nama_mahasiswa', 'pendidikan', 'alamat_mahasiswa'];
}
