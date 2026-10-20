
@extends('layouts.app')

@section('title', 'Edit Klien')
@section('page-title', 'Edit Klien')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">Edit Klien</h3>
        <p class="text-muted mb-0">
            Perbarui informasi {{ $client->name }}.
        </p>
    </div>

    <x-button
        variant="view"
        icon="eye"
        href="{{ route('clients.show', $client) }}"
    >
        Lihat Detail
    </x-button>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        Ada data yang perlu diperbaiki. Periksa kolom yang ditandai.
    </div>
@endif

<form method="POST" action="{{ route('clients.update', $client) }}">
    @csrf
    @method('PUT')
    @include('clients._form')
</form>
@endsection
