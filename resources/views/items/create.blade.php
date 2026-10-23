@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="card p-4">
        <h4 class="mb-3">Tambah Barang</h4>
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Kode Inventaris</label>
                    <input type="text" name="code" class="form-control" value="{{ App\Models\Item::generateCode() }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Pilih kategori</option>
                        @foreach(App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Lokasi</label>
                    <select name="location_id" class="form-select">
                        <option value="">Pilih lokasi</option>
                        @foreach(App\Models\Location::where('is_active', true)->orderBy('name')->get() as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Merek</label>
                    <input type="text" name="brand" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Spesifikasi</label>
                    <textarea name="specification" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" value="1" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="unit" class="form-control" value="pcs">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kondisi</label>
                    <select name="condition" class="form-select">
                        <option>Baik</option>
                        <option>Rusak</option>
                        <option>Perlu Perbaikan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option>Tersedia</option>
                        <option>Dipinjam</option>
                        <option>Dipindahkan</option>
                        <option>Rusak</option>
                        <option>Hilang</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Pembelian</label>
                    <input type="date" name="purchase_date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="purchase_price" class="form-control" step="0.01" value="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Foto Barang</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
