@extends('layouts.app')

@section('title', 'Tambah Paket')
@section('page-title', 'Tambah Paket')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">Tambah Paket Wedding</h3>
        <p class="text-muted mb-0">Buat paket layanan baru untuk klien Anda.</p>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        Ada data yang perlu diperbaiki. Periksa kolom yang ditandai.
    </div>
@endif

<form method="POST" action="{{ route('packages.store') }}">
    @csrf
    @include('packages._form')
</form>
@endsection
