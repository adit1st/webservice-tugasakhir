<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";
    protected $fillable = ['nik', 'nama_dosen', 'prodi_id', 'pendidikan', 'alamat_dosen'];
}
