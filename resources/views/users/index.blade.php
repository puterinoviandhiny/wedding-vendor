
@extends('layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('content')

<div class="app-toolbar">
    <div>
        <h3 class="fw-bold mb-1">User Management</h3>
        <p class="text-muted mb-0">
            Kelola anggota tim bisnis Anda.
        </p>
    </div>

    <x-button
        variant="primary"
        icon="plus"
        href="{{ route('users.create') }}"
    >
        Tambah User
    </x-button>
</div>

@if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="card dashboard-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                        <th class="text-end px-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="fw-semibold">
                                            {{ $user->name }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ $user->id === auth()->id() ? 'Akun Anda' : 'Anggota tim' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @php
                                    $roleStyles = [
                                        'owner' => 'role-owner',
                                        'admin' => 'role-admin',
                                        'finance' => 'role-finance',
                                    ];

                                    $roleLabels = [
                                        'owner' => 'Owner',
                                        'admin' => 'Admin',
                                        'finance' => 'Finance',
                                    ];

                                    $role = strtolower($user->role ?? 'staff');
                                @endphp

                                <span class="role-badge {{ $roleStyles[$role] ?? 'role-staff' }}">
                                    {{ $roleLabels[$role] ?? ucfirst($role) }}
                                </span>
                            </td>

                            <td>
                                {{ $user->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="text-end px-4">
                                <div class="app-btn-group justify-content-end">
                                    <x-button
                                        variant="edit"
                                        icon="edit"
                                        size="sm"
                                        href="{{ route('users.edit', $user) }}"
                                        title="Edit user"
                                    >
                                        Edit
                                    </x-button>

                                    @if ($user->id !== auth()->id())
                                        <form
                                            method="POST"
                                            action="{{ route('users.destroy', $user) }}"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus user {{ addslashes($user->name) }}?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <x-button
                                                variant="delete"
                                                icon="trash"
                                                size="sm"
                                                type="submit"
                                                title="Hapus user"
                                            >
                                                Hapus
                                            </x-button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <x-icon name="users" size="32" />

                                    <div class="fw-semibold">
                                        Belum ada user
                                    </div>

                                    <p class="text-muted mb-2">
                                        Tambahkan anggota tim untuk membantu operasional bisnis Anda.
                                    </p>

                                    <x-button
                                        variant="primary"
                                        icon="plus"
                                        href="{{ route('users.create') }}"
                                    >
                                        Tambah User
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>

@endsection
