@extends('layouts.app')

@section('content')
    <h2>Selamat datang di KostFinder</h2>
    <p>Cari kost idealmu sekarang!</p>
    <a href="{{ route('kost.index') }}">Lihat Daftar Kost</a>
@endsection
