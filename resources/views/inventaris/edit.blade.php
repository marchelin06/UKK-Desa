@extends('layouts.admin')

@section('title', 'Edit Inventaris')

@section('content')
<style>
    .page-inventaris-form {
        max-width: 800px;
        margin: 30px auto;
        padding: 0 15px;
        font-family: Arial, sans-serif;
    }
    .card-form {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        padding: 20px 25px;
    }
    .form-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1b3b2f;
    }
    .form-group label {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 4px;
    }
</style>

<div class="page-inventaris-form">
    <a href="{{ route('inventaris.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card-form">
        <h1 class="form-title">Edit Data Inventaris</h1>

        <form action="{{ route('inventaris.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3 form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control"
                       value="{{ old('nama_barang', $item->nama_barang) }}"
                       @if(auth()->user()->role === 'admin') readonly @endif>
                @error('nama_barang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 form-group">
                <label>Kode Barang (opsional)</label>
                <input type="text" name="kode_barang" class="form-control"
                       value="{{ old('kode_barang', $item->kode_barang) }}"
                       @if(auth()->user()->role === 'admin') readonly @endif>
                @error('kode_barang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3 form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" min="0"
                           value="{{ old('jumlah', $item->jumlah) }}"
                           @if(auth()->user()->role === 'admin') readonly @endif>
                    @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label>Kondisi</label>
                    <select name="kondisi" class="form-control">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Baik" {{ old('kondisi', $item->kondisi)=='Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi', $item->kondisi)=='Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi', $item->kondisi)=='Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3 form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                           value="{{ old('lokasi', $item->lokasi) }}"
                           @if(auth()->user()->role === 'admin') readonly @endif>
                    @error('lokasi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3 form-group">
                <label>Keterangan (opsional)</label>
                <textarea name="keterangan" rows="3" class="form-control"
                          @if(auth()->user()->role === 'admin') readonly @endif>{{ old('keterangan', $item->keterangan) }}</textarea>
                @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Batal</a>
            @if(auth()->user()->role === 'admin')
            <small class="d-block mt-2 text-muted">
                ℹ️ Sebagai admin, Anda hanya dapat mengubah kondisi barang. Data lainnya tidak dapat diubah.
            </small>
            @endif
        </form>
    </div>
</div>
@endsection
