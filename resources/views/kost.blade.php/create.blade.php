@extends('layouts.app')

@section('content')
    <h2>{{ isset($kost) ? 'Edit' : 'Tambah' }} Kost</h2>

    <form method="POST" action="{{ isset($kost) ? route('kost.update', $kost->id) : route('kost.store') }}">
        @csrf
        @if(isset($kost))
            @method('PUT')
        @endif

        <label>Nama Kost:</label>
        <input type="text" name="nama" value="{{ old('nama', $kost->nama ?? '') }}"><br>

        <label>Deskripsi:</label>
        <textarea name="deskripsi">{{ old('deskripsi', $kost->deskripsi ?? '') }}</textarea><br>

        <label>Harga per Bulan:</label>
        <input type="number" name="harga_per_bulan" value="{{ old('harga_per_bulan', $kost->harga_per_bulan ?? '') }}"><br>

        <button type="submit">{{ isset($kost) ? 'Update' : 'Simpan' }}</button>
    </form>
@endsection
