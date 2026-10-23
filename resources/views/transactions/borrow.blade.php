@extends('layouts.app')

@section('title', 'Ambil Barang')

@section('content')
    <div class="card p-4">
        <h4 class="mb-3">Ambil / Pinjam Barang</h4>
        <form action="{{ route('transactions.borrow') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Barang</label>
                    <select name="item_id" class="form-select" required>
                        <option value="">Pilih barang</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" @selected((string) old('item_id') === (string) $item->id)>
                                {{ $item->code }} - {{ $item->name }} (asal: {{ $item->location?->name ?? '-' }}, stok {{ $item->quantity }} {{ $item->unit }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dipinjam oleh (staf perpustakaan)</label>
                    <select name="staff_id" class="form-select" required>
                        <option value="">Pilih staf</option>
                        @foreach($staff as $staffMember)
                            <option value="{{ $staffMember->id }}" @selected((string) old('staff_id') === (string) $staffMember->id)>{{ $staffMember->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dipinjam ke lokasi</label>
                    <select name="to_location" class="form-select" required>
                        <option value="">Pilih tujuan penggunaan</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->name }}" @selected(old('to_location') === $location->name)>{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Waktu Transaksi</label>
                    <input type="time" name="transaction_time" class="form-control" value="{{ old('transaction_time', now()->format('H:i')) }}" step="1" required>
                    <div class="form-text">Format 24 jam (HH:mm)</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Keperluan</label>
                    <input type="text" name="purpose" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Keterangan</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
