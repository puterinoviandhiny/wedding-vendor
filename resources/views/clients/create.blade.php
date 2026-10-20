
@extends('layouts.app')

@section('title', 'Tambah Klien')
@section('page-title', 'Tambah Klien')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">Tambah Klien</h3>
        <p class="text-muted mb-0">
            Catat informasi klien baru.
        </p>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        Ada data yang perlu diperbaiki. Periksa kolom yang ditandai.
    </div>
@endif

<form method="POST" action="{{ route('clients.store') }}">
    @csrf
    @include('clients._form')
</form>
@endsection
