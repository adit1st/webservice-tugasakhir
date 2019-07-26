<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Prodi;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = mahasiswa::with('prodi')->get();
        $data2 = prodi::all();

        return response()->json(['item' => $data, 'item2' => $data2], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nim'=>'required|unique:mahasiswa|numeric',
            'nama_mahasiswa'=>'required',
            'prodi_id'=>'required',
            'alamat_mahasiswa'=>'required',
            
        ]);

        $data = mahasiswa::create($request->all());
        return response()->json(['item' => $data], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Mahasiswa::findOrFail($id);
        return response()->json(['item' => $data], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nim'=>'required|numeric',
            'nama_mahasiswa'=>'required',
            'prodi_id'=>'required',
            'alamat_mahasiswa'=>'required',
            
        ]);
        $data = Mahasiswa::findOrFail($id);

        $data->update($request->all());

        return response()->json(['item' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = mahasiswa::find($id);
        $data->delete();
        return $data;
    }
}
