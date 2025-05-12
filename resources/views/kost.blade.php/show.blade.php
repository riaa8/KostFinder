@extends('layouts.app')

@section('content')
    <h2>{{ $kost->nama }}</h2>
    <p>{{ $kost->deskripsi }}</p>
    <p>Harga: Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}</p>
    <p>Alamat: {{ $kost->alamat->jalan }}, {{ $kost->alamat->kota }}</p>

    <h4>Fasilitas:</h4>
    <ul>
        @foreach ($kost->fasilitas as $f)
            <li>{{ $f->nama_fasilitas }}</li>
        @endforeach
    </ul>

    <h4>Review:</h4>
    <ul>
        @foreach ($kost->review as $r)
            <li>⭐ {{ $r->rating }} - {{ $r->komentar }}</li>
        @endforeach
    </ul>
@endsection
