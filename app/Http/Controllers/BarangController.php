<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barangs = DB::table('barangs')->get();

        return view('barang.index', compact('barangs'));

        // dd($barangs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('barang.add');
    }

    public function addprocess(Request $request)
    {

        $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer'],
            'stok' => ['required', 'integer']
        ]);


        $post = new Barang;
        $post->nama_barang = $request->nama_barang;
        $post->deskripsi = $request->deskripsi;
        $post->harga = $request->harga;
        $post->stok = $request->stok;

        if($request->file('gambar')){
            $gambar = $request->file('gambar');
            $name = $gambar->getClientOriginalName();
            $gambar->move('images/post', $name);
            $post->gambar = $name;
        }


        $post->save();

        return redirect('barang')->with('status', 'Barang Berhasil Di Tambah');
        // dd($request->all());
    }

    public function edit($id)
    {
        $barangs = DB::table('barangs')->where('id', $id)->first();

        return view('barang.edit', compact('barangs'));
        // dd($barangs);
    }
    public function editprocess(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer'],
            'stok' => ['required', 'integer'],
        ]);

        $post = Barang::findorfail($id);

        $post->nama_barang = $request->nama_barang;
        $post->deskripsi = $request->deskripsi;
        $post->harga = $request->harga;
        $post->stok = $request->stok;

        if($request->file('gambar')) {
            $gambar = $request->file('gambar');
            $name = $gambar->getClientOriginalName();
            $gambar->move('images/post', $name);
            $post->gambar = $name;
        }

        $post->update();

        // dd($request->all());
        return redirect('barang')->with('status', 'Barang Berhasil Di Edit');

    }

    public function destroy($id)
    {
        DB::table('barangs')->where('id', $id)->delete();
        return back()->with('status', 'Barang Berhasil Di Hapus');
    }
}
