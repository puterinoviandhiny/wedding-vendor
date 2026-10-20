@extends('layouts.app')

@section('title', 'Wedding Packages')
@section('page-title', 'Wedding Packages')

@section('content')
<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">Wedding Packages</h3>
        <p class="text-muted mb-0">
            Kelola harga dan layanan paket wedding bisnis Anda.
        </p>
    </div>

    <x-button variant="primary" icon="plus" href="{{ route('packages.create') }}">
        Tambah Paket
    </x-button>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="text-muted small mb-2">Total Paket</div>
                <div class="fs-3 fw-bold">{{ $packages->total() }}</div>
                <div class="small text-muted">Sesuai filter yang dipilih</div>
            </div>
        </div>
    </div>
</div>

<div class="card dashboard-card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('packages.index') }}"
              class="row g-2 align-items-end">
            <div class="col-lg-7">
                <label for="search" class="form-label">Cari Paket</label>
                <input
                    id="search"
                    name="search"
                    type="search"
                    class="form-control"
                    value="{{ $search }}"
                    placeholder="Nama paket, kode, atau deskripsi..."
                >
            </div>

            <div class="col-lg-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="active" @selected($status === 'active')>Aktif</option>
                    <option value="inactive" @selected($status === 'inactive')>Nonaktif</option>
                </select>
            </div>

            <div class="col-lg-2 d-flex gap-2">
                <x-button variant="primary" icon="search" type="submit">
                    Cari
                </x-button>
                <x-button variant="light" icon="refresh" href="{{ route('packages.index') }}">
                    Reset
                </x-button>
            </div>
        </form>
    </div>
</div>

<div class="card dashboard-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Paket</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th class="text-end px-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($packages as $package)
                        <tr>
                            <td class="px-4">
                                <div class="fw-semibold">{{ $package->name }}</div>
                                <div class="small text-muted">
                                    {{ $package->code ?: 'Tanpa kode' }}
                                </div>
                            </td>

                            <td class="fw-semibold">
                                Rp {{ number_format((float) $package->price, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $package->duration_hours
                                    ? $package->duration_hours . ' jam'
                                    : '—' }}
                            </td>

                            <td>
                                {{ count($package->included_services ?? []) }} layanan
                            </td>

                            <td>
                                @if ($package->is_active)
                                    <span class="role-badge role-finance">Aktif</span>
                                @else
                                    <span class="role-badge role-staff">Nonaktif</span>
                                @endif
                            </td>

                            <td class="text-end px-4">
                                <div class="app-btn-group justify-content-end">
                                    <x-button
                                        variant="edit"
                                        icon="edit"
                                        size="sm"
                                        href="{{ route('packages.edit', $package) }}"
                                    >
                                        Edit
                                    </x-button>

                                    <form
                                        method="POST"
                                        action="{{ route('packages.destroy', $package) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus paket {{ addslashes($package->name) }}?')"
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
                            <td colspan="6" class="text-center py-5">
                                <x-icon name="file" size="32" />
                                <p class="fw-semibold mt-3 mb-1">Belum ada paket</p>
                                <p class="text-muted mb-3">
                                    Buat paket pertama untuk mulai menawarkan layanan wedding.
                                </p>
                                <x-button
                                    variant="primary"
                                    icon="plus"
                                    href="{{ route('packages.create') }}"
                                >
                                    Tambah Paket
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
    {{ $packages->links() }}
</div>
@endsection
