@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                @if (session('status'))
                <div class="alert alert-success mt-3">
                    {{ session('status') }}
                </div>
                @endif
                <?php $no = 1 ?>
                @foreach ($pembayarans as $pembayaran)
                <div class="card mt-3" style="width: 40rem">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>No Pembayaran</td>
                                    <td>:</td>
                                    <td> {{$pembayaran->keranjang->id}} </td>
                                </tr>
                                @foreach ($pembayarans as $pembayaran)
                                <tr>
                                    <td>Nama Barang {{ $no++ }}</td>
                                    <td>:</td>
                                    <td>{{ $pembayaran->barang->nama_barang }}</td>
                                    <td>{{ $pembayaran->jumlah_barang }} Meter</td>
                                </tr>
                                <tr>
                                    <td>Harga Barang</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format( $pembayaran->barang->harga ) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Harga Total </td>
                                    <td>: </td>
                                    <td>Rp. {{ $keranjang->harga_total }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
