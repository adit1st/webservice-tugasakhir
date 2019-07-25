<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dosen;

class Matakuliah extends Model
{
	protected $table = "matakuliah";
	protected $fillable = ['kode_matakuliah', 'nama_matakuliah', 'dosen_id'];

	public function dosen()
	{
		return $this->belongsTo(Dosen::class);
	}
}
