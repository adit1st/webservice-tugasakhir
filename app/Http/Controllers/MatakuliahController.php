<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matakuliah;
use App\Dosen;
use App\Prodi;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = matakuliah::with('dosen', 'prodi')->get();
        $data2 = dosen::all();
        $data3 = prodi::all();
        
        return response()->json(['item' => $data, 'item2' => $data2, 'item3' => $data3], 200);
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
            'kode_matakuliah'=>'required|unique:matakuliah',
            'nama_matakuliah'=>'required',
            'prodi_id'=>'required',
            'dosen_id'=>'required',
        ]);
        $data = matakuliah::create($request->all());
       
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
        $data = matakuliah::findOrFail($id);
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
        //
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
            'kode_matakuliah'=>'required',
            'nama_matakuliah'=>'required',
            'prodi_id'=>'required',
            'dosen_id'=>'required',
        ]);
        $data = matakuliah::findOrFail($id);
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
        $data = matakuliah::find($id);
        $data->delete();
        return $data;
    }
}
