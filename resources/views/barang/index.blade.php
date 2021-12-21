@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('home') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i></a>
    <div class="mt-4 d-flex justify-content-center">
        <h3><i class="fa fa-plus-product"></i> Barang</h3>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        @foreach($barangs as $barang)
        <div class="col-md-4 mt-4">
            <div class="card" style="width: 22rem;">
                <img src="{{ asset('images/post/'.$barang->gambar) }}" class="rounded mx-auto d-block" height="200" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                    <p class="card-text">
                        <strong>Keterangan :</strong> <br>
                        {{ $barang->deskripsi }}
                        <hr>
                        <strong>Stok :</strong>
                        {{ $barang->stok }} Meter<br>
                        <strong>Harga :</strong> Rp. {{ number_format($barang->harga)}} / Meter <br>
                    </p>
                    <table>
                        <tr>
                            <td><a href="{{ url('edit/'.$barang->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a></td>
                            <td>
                                <form action="{{ url('hapus/'.$barang->id) }}" method="POST" onsubmit="return confirm('Yakin Hapus Barang?')">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-4 mt-4">
            <div class="card">
              <div class="card-body">
                <a href="{{ url('tambah') }}" class="rounded mx-auto d-block">
                    <img src="{{ url('assets/plus_icon.png') }}" class="rounded mx-auto d-block" width="207" alt="">
                </a>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
