<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = "prodi";
    protected $fillable = ['nama_prodi', 'akreditas'];
}
