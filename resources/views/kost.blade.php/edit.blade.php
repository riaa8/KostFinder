@extends('layouts.app')

@section('content')
    <h1>Edit Kost</h1>

    <form action="{{ route('kost.update', $kost->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Kost:</label>
            <input type="text" name="nama" value="{{ $kost->nama }}" required>
        </div>

        <div>
            <label>Deskripsi:</label>
            <textarea name="deskripsi" required>{{ $kost->deskripsi }}</textarea>
        </div>

        <div>
            <label>Harga Per Bulan:</label>
            <input type="number" name="harga_per_bulan" value="{{ $kost->harga_per_bulan }}" required>
        </div>

        <div>
            <label>URL Gambar:</label>
            <input type="text" name="url_gambar" value="{{ $kost->url_gambar }}">
        </div>

        <div>
            <label>Gender:</label>
            <select name="gender" required>
                <option value="campur" {{ $kost->gender == 'campur' ? 'selected' : '' }}>Campur</option>
                <option value="putra" {{ $kost->gender == 'putra' ? 'selected' : '' }}>Putra</option>
                <option value="putri" {{ $kost->gender == 'putri' ? 'selected' : '' }}>Putri</option>
            </select>
        </div>

        <button type="submit">Simpan Perubahan</button>
    </form>
@endsection
