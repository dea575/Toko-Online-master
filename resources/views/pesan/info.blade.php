@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <img src="{{ asset('images/post/'.$barang->gambar) }}" class="rounded mx-auto d-block" height="300" alt="...">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h3> {{ $barang->nama_barang }}</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td> Rp. {{ number_format($barang->harga)}} / Meter</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td> {{ number_format($barang->stok)}} / Meter</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td>{{ $barang->deskripsi }}</td>
                                    </tr>

                                    <form action="{{ url('pesan/'.$barang->id) }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td><label for="stok" class=>{{ __('Stok') }}</label></td>
                                            <td>:</td>
                                            <td>{{ $barang->stok }}</td>
                                        </tr>
                                        <tr>
                                            <td><label for="jumlah_barang" class=>{{ __('Jumlah Barang') }}</label></td>
                                            <td>:</td>
                                            <td>
                                                <div class="input-group">
                                                    <input id="jumlah_barang" type="number" min="1" class="form-control @error('jumlah_barang') is-invalid @enderror" name="jumlah_barang" value="{{ old('jumlah_barang') }}" required autocomplete="jumlah_barang" autofocus>
                                                    <span class="input-group-text" id="harga">Meter</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <td colspan="4" align="right">
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i> Keranjang</button>
                                        </td>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
