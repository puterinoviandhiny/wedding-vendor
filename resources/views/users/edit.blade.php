@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="card dashboard-card">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-1">
                    Edit User
                </h5>

                <p class="text-muted mb-4">
                    Perbarui informasi user.
                </p>

                <form
                    method="POST"
                    action="{{ route('users.update', $user) }}"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $user->name) }}"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $user->email) }}"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Role
                        </label>

                        <select
                            name="role"
                            class="form-select"
                            required
                        >

                            <option
                                value="admin"
                                @selected($user->role === 'admin')
                            >
                                Admin
                            </option>

                            <option
                                value="staff"
                                @selected($user->role === 'staff')
                            >
                                Staff
                            </option>

                            <option
                                value="finance"
                                @selected($user->role === 'finance')
                            >
                                Finance
                            </option>

                        </select>

                    </div>


                    <hr class="my-4">


                    <h6 class="fw-bold">
                        Ubah Password
                    </h6>

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengubah password.
                    </small>


                    <div class="row mt-2">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                            >

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                            >

                        </div>

                    </div>


                    <div class="d-flex gap-2 mt-3">

                        
                        <x-button
                            variant="light"
                            icon="back"
                            
                            href="{{ route('users.index') }}"
                            >
                                Batal
                            </x-button>
                        <x-button variant="primary" icon="save" type="submit">
                            Simpan Perubahan
                        </x-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection