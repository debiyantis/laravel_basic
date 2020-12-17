<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        //Mengambil data dari tabel pegawai
        $pegawai = DB::table('pegawai')->get();

        //menampilkan data ke index
        return view('index', ['pegawai' => $pegawai]);
    }

    public function tambah(){
        //menampilkan form tambah
        return view('tambah');
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('gambar'), $fileName);

        DB::table('pegawai')->insert([
            'pegawai_nama' => $request->nama,
            'pegawai_jabatan' => $request->jabatan,
            'pegawai_alamat' => $request->alamat,
            'pegawai_gambar' => $fileName
        ]);

        //kembali ke index
        return redirect('/pegawai')->with('sukses', 'Data Pegawai berhasil dimasukkan');
    }

    public function edit($id)
    {
        //mengambil data pegawai berdasarkan ID dengan method GET
        $pegawai = DB::table('pegawai')->where('pegawai_id', $id)->get();

        //mempassing data ke form edit
        return view('edit', ['pegawai'=>$pegawai]);
    }

    public function update(Request $request)
    {
        if($fileName = $request->file('file')){
            $destinationPath = 'gambar/';
            $foto = time().".". $fileName->getClientOriginalExtension();
            $fileName->move($destinationPath, $foto);
        }
        else{
            $foto = $request->file_old;
        }

        //untuk mengupdate data pegawai
        DB::table('pegawai')->where('pegawai_id', $request->id)->update([
            'pegawai_nama' => $request->nama,
            'pegawai_jabatan' => $request->jabatan,
            'pegawai_alamat' => $request->alamat,
            'pegawai_gambar' => $foto,

        ]);
        //kembali ke halaman data pegawai
        return redirect('/pegawai');
    }

    public function hapus($id)
    {
        //untuk menghapus data pegawai berdasarkan id
        DB::table('pegawai')->where('pegawai_id', $id)->delete();

        //kembali ke halaman data pegawai
        return redirect('/pegawai');
    }



}
