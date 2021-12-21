@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('barang') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
    <div class="mt-4 d-flex justify-content-center">
        <h3><i class="fa fa-edit"></i> Edit Barang</h3>
    </div>
    <div class="row justify-content-left">
        <div class="col-md-12 mt-3">
            <div class="card">
                <img src="{{ asset('images/post/'.$barangs->gambar) }}" class="rounded mx-auto d-block float-right mt-4 mb-4"  width="300" alt="...">
                <div class="card-body">
                    <form method="POST" action="{{ url('edit', $barangs->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama_barang" class="col-md-2 col-form-label text-md-right">{{ __('Nama Barang') }}</label>
                            <div class="col-md-6">
                                <input id="nama_barang" type="text" value="{{ $barangs->nama_barang }}"  class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}" required autocomplete="nama_barang" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="deskripsi" class="col-md-2 col-form-label text-md-right">{{ __('Deskripsi') }}</label>

                            <div class="col-md-6">
                                <textarea id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi" autofocus cols="130" rows="5">{{ $barangs->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="harga" class="col-md-2 col-form-label text-md-right">{{ __('Harga') }}</label>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="harga">Rp.</span>
                                    <input id="harga" type="number" value="{{ $barangs->harga }}" min="1" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" required autocomplete="harga" autofocus>
                                </div>
                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stok" class="col-md-2 col-form-label text-md-right">{{ __('Stok') }}</label>

                            <div class="col-md-2">
                                <div class="input-group">
                                    <input id="stok" type="number" value="{{ $barangs->stok }}" min="1" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok') }}" required autocomplete="stok" autofocus>
                                    <span class="input-group-text" id="harga">Meter</span>
                                </div>
                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 input-group">
                            <div class="custom-file">
                                <label for="gambar" class="col-md-2 col-form-label text-md-right">{{ __('Gambar') }}</label>
                                <input id="gambar" type="file" value="{{ $barangs->gambar }}" class="custom-file-input @error('stok') is-invalid @enderror" name="gambar" value="{{ old('gambar') }}" autofocus>
                              </div>
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2 offset-md-2 ">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Edit Data?')">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
