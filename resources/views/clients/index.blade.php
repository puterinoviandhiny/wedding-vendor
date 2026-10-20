
@extends('layouts.app')

@section('title', 'Clients')
@section('page-title', 'Client Management')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">Client Management</h3>
        <p class="text-muted mb-0">
            Kelola informasi klien dan calon pelanggan wedding Anda.
        </p>
    </div>

    <x-button variant="primary" icon="plus" href="{{ route('clients.create') }}">
        Tambah Klien
    </x-button>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        Periksa kembali data yang dimasukkan.
    </div>
@endif

<div class="card dashboard-card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('clients.index') }}"
              class="d-flex flex-wrap gap-2">
            <div class="flex-grow-1" style="min-width:220px">
                <input
                    type="search"
                    name="search"
                    class="form-control"
                    value="{{ $search }}"
                    placeholder="Cari nama, email, atau nomor telepon..."
                    aria-label="Cari klien"
                >
            </div>

            <x-button variant="primary" icon="search" type="submit">
                Cari
            </x-button>

            @if ($search !== '')
                <x-button variant="light" icon="refresh" href="{{ route('clients.index') }}">
                    Reset
                </x-button>
            @endif
        </form>
    </div>
</div>

<div class="card dashboard-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Klien</th>
                        <th>Kontak</th>
                        <th>Sumber</th>
                        <th>Tanggal Ditambahkan</th>
                        <th class="text-end px-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">
                                            {{ $client->name }}
                                        </div>
                                        <div class="small text-muted">
                                            Klien #{{ $client->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div>{{ $client->phone }}</div>
                                @if ($client->email)
                                    <div class="small text-muted">
                                        {{ $client->email }}
                                    </div>
                                @endif
                            </td>

                            <td>{{ $client->source ?: '—' }}</td>

                            <td>{{ $client->created_at?->format('d M Y') ?? '—' }}</td>

                            <td class="text-end px-4">
                                <div class="app-btn-group justify-content-end">
                                    <x-button
                                        variant="view"
                                        icon="eye"
                                        size="sm"
                                        href="{{ route('clients.show', $client) }}"
                                        title="Lihat detail klien"
                                    >
                                        Lihat
                                    </x-button>

                                    <x-button
                                        variant="edit"
                                        icon="edit"
                                        size="sm"
                                        href="{{ route('clients.edit', $client) }}"
                                        title="Edit klien"
                                    >
                                        Edit
                                    </x-button>

                                    <form
                                        method="POST"
                                        action="{{ route('clients.destroy', $client) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus klien ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <x-button
                                            variant="delete"
                                            icon="trash"
                                            size="sm"
                                            type="submit"
                                        >
                                            Hapus
                                        </x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <x-icon name="users" size="32" />
                                <p class="fw-semibold mt-3 mb-1">
                                    Belum ada data klien
                                </p>
                                <p class="text-muted mb-3">
                                    Tambahkan klien pertama Anda untuk mulai mencatat pemesanan.
                                </p>
                                <x-button
                                    variant="primary"
                                    icon="plus"
                                    href="{{ route('clients.create') }}"
                                >
                                    Tambah Klien
                                </x-button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $clients->links() }}
</div>
@endsection
