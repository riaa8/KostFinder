@extends('layouts.app')

@section('content')
    <h2>Daftar Kost</h2>

    @foreach ($kosts as $kost)
        <div style="border:1px solid #ccc; margin:10px; padding:10px;">
            <h3>{{ $kost->nama }}</h3>
            <p>Rp {{ number_format($kost->harga_per_bulan, 0, ',', '.') }}/bulan</p>
            <a href="{{ route('kost.show', $kost->id) }}">Lihat Detail</a>
        </div>
    @endforeach
@endsection
