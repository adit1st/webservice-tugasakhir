<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
	protected $table = "mahasiswa";
	protected $fillable = ['nim', 'nama_mahasiswa', 'prodi_id', 'alamat_mahasiswa'];

	public function prodi()
	{
		return $this->belongsTo(Prodi::class);
	}
}
