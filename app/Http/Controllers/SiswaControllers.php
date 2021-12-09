<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sisw = Siswa::latest()->paginate(5);
        return view ('sisw.index',compact('sisw'))->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sisw.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*fungsi ini berisi data yang dapat dimasukkan melalui form di menu create
        Untuk media digunakan untuk menampung img atau gambar maksimal 5mb
        */

        $validatedData = $request->validate([
            'NIS' => 'required|max:255',
            'NamaSiswa' => 'required|max:255',
            'Alamat' => 'required|max:255',
            'media' => 'file|image|max:5000',
        ]);
        $validatedData['media']= $request->file('media')->store('media');

        Siswa::create([
            'NIS' => $validatedData['NIS'],
            'NamaSiswa' => $validatedData['NamaSiswa'],
            'Alamat' => $validatedData['Alamat'],
            'media' => $validatedData['media'],
        ]);

        return redirect()->route('sisw.index')->with('succes','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $sisw)
    {
        return view('sisw.show',compact('sisw'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Siswa $sisw)
    {
        return view('sisw.edit', compact('sisw'));
    }

    /**
     * Update the specified resource in storage.
     * Update data dengan cara menerimanya melalui request kemudian melakukan fungsi update
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $sisw)
    {
        $request->validate([
            'NIS' => 'required|max:255',
            'NamaSiswa' => 'required|max:255',
            'Alamat' => 'required|max:255',
            'media' => 'file|image|max:5000',
        ]);

        $request->media=$request->file('media')->store('media');
        
        $sisw->NIS = $request->NIS;
        $sisw->NamaSiswa = $request->NamaSiswa;
        $sisw->Alamat = $request->Alamat;
        $sisw->media = $request->media;

        $sisw->update();

        return redirect()->route('sisw.index')->with('succes','Siswa Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $sisw)
    {
        $sisw->delete();

        return redirect()->route('sisw.index')->with('succes','Data Berhasil di Hapus');
    }
}