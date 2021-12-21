<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $barang = DB::table('barangs')->where('id', $id)->first();

        return view('pesan.info', compact('barang'));

    }

    public function keranjang(Request $request, $id)
    {
        //ambil data dan fasilitas
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi stok apakah jumlah barang yang dipesan lebih atau kurang dari stok
        if($request->jumlah_barang > $barang->stok || $request->jumlah_barang < 0){
            return redirect('order/'.$id)->with('status', 'Barang Melebihi Stok');
        }

        //validasi data dari tabel keranjang
        $cek_keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status', 0)->first();

        //Simpan ke table keranjang jika kosong
        if(empty($cek_keranjang)){
            $keranjang = new Keranjang;
            $keranjang->id_users = Auth::user()->id;
            $keranjang->jumlah_barang = $request->jumlah_barang;
            $keranjang->harga_total = $barang->harga * $request->jumlah_barang;
            $keranjang->tanggal = $tanggal;
            $keranjang->status = 0;
            $keranjang->save();
        }

        //update ke table keranjang jika ada isinya
        else{
            $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status', 0)->first();
            $keranjang->jumlah_barang = $keranjang->jumlah_barang + $request->jumlah_barang;
            $keranjang->harga_total = $keranjang->harga_total + $request->jumlah_barang * $barang->harga ;
            $keranjang->update();
        }


        //deklarasi baru keranjang & pembayaran yang sudah diupdate
        $keranjang_2 = Keranjang::where('id_users', Auth::user()->id)->where('status', 0)->first();


        //validasi data dari table pembayaran yang sudah diupdate
        $cek_pembayaran = Pembayaran::where('id_barangs', $barang->id)->where('id_keranjangs', $keranjang_2->id)->first();

        //simpan ke table pembayaran jika kosong
        if (empty($cek_pembayaran)) {
            $pembayaran = new Pembayaran;
            $pembayaran->id_barangs = $barang->id;
            $pembayaran->id_keranjangs = $keranjang_2->id;
            $pembayaran->jumlah_barang = $request->jumlah_barang;
            $pembayaran->jumlah_harga = $barang->harga * $request->jumlah_barang;
            $pembayaran->save();
        }

        //update ke table pembayaran jika ada isinya
        else{
            $pembayaran = Pembayaran::where('id_barangs', $barang->id)->where('id_keranjangs', $keranjang_2->id)->first();
            $pembayaran->jumlah_barang = $pembayaran->jumlah_barang + $request->jumlah_barang;
            $pembayaran->jumlah_harga = $pembayaran->jumlah_harga + $request->jumlah_barang * $barang->harga ;
            $pembayaran->update();
        }

        return redirect('checkout')->with('status', 'Barang Dimasukan ke Keranjang');

        // dd($request);
    }

    public function checkout()
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status', 0)->first();
        $pembayarans = [];
        if (!empty($keranjang)) {
            $pembayarans = Pembayaran::where('id_keranjangs', $keranjang->id)->get();
        }

        return view('pesan.checkout', compact('keranjang', 'pembayarans' ));

        // dd($pembayarans);
    }

    public function konfirmasi_checkout()
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status', 0)->first();
        $pembayarans = Pembayaran::where('id_keranjangs', $keranjang->id)->get();

        //update status
        $keranjang->status = 1;
        $keranjang->update();

        //update stok
        foreach ($pembayarans as $pembayaran) {
            $barang = Barang::where('id', $pembayaran->id_barangs)->first();
            $barang->stok = $barang->stok - $pembayaran->jumlah_barang;
            $barang->update();
            // $pembayaran->delete();
        }

        return redirect('checkout')->with('status', 'Checkout');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->first();

        //update jumlah barang dan harga total di tabel keranjang saat menghapus data pembayaran
        $keranjang = Keranjang::where('id', $pembayaran->id_keranjangs)->first();
        $keranjang->jumlah_barang = $keranjang->jumlah_barang - $pembayaran->jumlah_barang;
        $keranjang->harga_total = $keranjang->harga_total - $pembayaran->jumlah_harga;
        $keranjang->update();

        $pembayaran->delete();

        return redirect('checkout')->with('status', 'Barang Berhasil Dihapus');
    }
}
