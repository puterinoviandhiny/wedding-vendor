
@extends('layouts.app')

@section('title', 'Detail Klien')
@section('page-title', 'Detail Klien')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">{{ $client->name }}</h3>
        <p class="text-muted mb-0">
            Detail informasi klien #{{ $client->id }}.
        </p>
    </div>

    <div class="app-btn-group">
        <x-button variant="light" icon="back" href="{{ route('clients.index') }}">
            Kembali
        </x-button>

        <x-button variant="edit" icon="edit" href="{{ route('clients.edit', $client) }}">
            Edit Klien
        </x-button>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card dashboard-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="user-avatar" style="width:56px;height:56px;flex-basis:56px;font-size:22px">
                        {{ strtoupper(substr($client->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $client->name }}</h5>
                        <div class="text-muted small">
                            Klien sejak {{ $client->created_at?->format('d F Y') ?? '—' }}
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Nomor Telepon</div>
                        <div class="fw-semibold">{{ $client->phone }}</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">WhatsApp</div>
                        <div class="fw-semibold">{{ $client->whatsapp ?: '—' }}</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Email</div>
                        <div class="fw-semibold">{{ $client->email ?: '—' }}</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Sumber Klien</div>
                        <div class="fw-semibold">
                            {{ $client->source === 'Other' ? 'Lainnya' : ($client->source ?: '—') }}
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-muted small mb-1">Alamat</div>
                        <div>{{ $client->address ?: 'Belum ada alamat.' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card dashboard-card mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Catatan Klien</h5>

                <div style="white-space:pre-wrap;overflow-wrap:anywhere">{{ $client->notes ?: 'Belum ada catatan untuk klien ini.' }}</div>
            </div>
        </div>

        <div class="card dashboard-card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-2">Langkah Berikutnya</h5>
                <p class="text-muted small mb-3">
                    Setelah data klien tersimpan, tahap berikutnya adalah membuat booking dan menghubungkannya ke klien ini.
                </p>

                <x-button variant="primary" icon="calendar" href="{{ route('clients.edit', $client) }}">
                    Perbarui Data Klien
                </x-button>
            </div>
        </div>
    </div>
</div>
@endsection
