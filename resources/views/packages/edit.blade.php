@extends('layouts.app')

@section('title', 'Edit Paket')
@section('page-title', 'Edit Paket')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">Edit Paket Wedding</h3>
        <p class="text-muted mb-0">
            Perbarui paket: {{ $package->name }}.
        </p>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        Ada data yang perlu diperbaiki. Periksa kolom yang ditandai.
    </div>
@endif

<form method="POST" action="{{ route('packages.update', $package) }}">
    @csrf
    @method('PUT')
    @include('packages._form')
</form>
@endsection
