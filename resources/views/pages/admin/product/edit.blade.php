@extends('layout.admin.main')
@section('title', 'Admin Edit Product')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.product') }}">Produk</a></div>
                <div class="breadcrumb-item">Edit Produk</div>
            </div>
        </div>
        <a href="{{ route('admin.product') }}" class="btn btn-icon icon-left btn-warning"> Kembali</a>
        <div class="card mt-4">
            <form action="{{ route('admin.product.update', $product->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="id_distributor">Nama Distributor</label>
                                <select name="id_distributor" class="form-control">
                                    @foreach ($distributor as $item)
                                    <option value="{{ $item->id }}" {{ $product->id_distributor == $item->id ? 'selected' : '' }}>{{ $item->nama_distributor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input id="name" type="text" class="form-control" name="name" required="" value="{{ $product->name }}">
                            <div class="invalid-feedback">
                                Kolom ini harus di isi!
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="price">Harga Produk (Point)</label>
                            <input id="price" type="number" class="form-control" name="price" required="" value="{{ $product->price }}">
                            <div class="invalid-feedback">
                                Kolom ini harus di isi!
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="discount">Diskon (%)</label>
                            <input id="discount" type="number" class="form-control" name="discount" placeholder="Diskon (%)" value="{{ $product->discount ?? 0 }}" required>
                            <div class="invalid-feedback">Kolom ini harus di isi!</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="category">Kategori Produk</label>
                            <input id="category" type="text" class="form-control" name="category" required="" value="{{ $product->category }}">
                            <div class="invalid-feedback">
                                Kolom ini harus di isi!
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Deskripsi Produk</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="40" required="">{{ $product->description }}</textarea>
                            <div class="invalid-feedback">
                                Isi berita harus di isi!
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="custom-file">
                                <input class="custom-file-input" name="image" id="customFile" type="file">
                                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</section>
</div>
@endsection