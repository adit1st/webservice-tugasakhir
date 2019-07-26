<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dosen;
use App\Prodi;

class Matakuliah extends Model
{
	protected $table = "matakuliah";
	protected $fillable = ['kode_matakuliah', 'nama_matakuliah', 'prodi_id', 'dosen_id'];

	public function dosen()
	{
		return $this->belongsTo(Dosen::class);
	}

	public function prodi()
	{
		return $this->belongsTo(Prodi::class);
	}
}
