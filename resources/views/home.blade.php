@extends('layouts.app')

@section('content')
<div class="container">

    @if (Auth::user())
        @if (Auth::user()->level == 1)
        <a href="{{ url('barang') }}" class="btn btn-success"><i class="fa fa-shopping-bag"></i></a>
        @endif
    @endif
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        @foreach($barangs as $barang)
        <div class="col-md-4 mt-3">
            <div class="card" style="width: 22rem;">
                <img src="{{ asset('images/post/'.$barang->gambar) }}" class="rounded mx-auto d-block" height="200" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                    <p class="card-text">
                        <strong>Keterangan :</strong> <br>
                        {{ $barang->deskripsi }}
                        <hr>
                        <strong>Stok :</strong>
                        @if (!empty($barang->stok))
                        {{ $barang->stok }} Meter<br>
                        @else
                        Kosong <br>
                        @endif
                        <strong>Harga :</strong> Rp. {{ number_format($barang->harga)}} / Meter <br>
                    </p>
                    <table>
                        <tr>
                            @csrf
                            <td><a href="{{ url('order/'.$barang->id) }}" class="btn btn-warning"><i class="fa fa-shopping-cart"></i></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
