@extends('layouts.app')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="card dashboard-card">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-1">
                    Tambah User
                </h5>

                <p class="text-muted mb-4">
                    Tambahkan anggota tim ke bisnis Anda.
                </p>

                <form
                    method="POST"
                    action="{{ route('users.store') }}"
                >

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
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
                            value="{{ old('email') }}"
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

                            <option value="">
                                Pilih Role
                            </option>

                            <option value="admin">
                                Admin
                            </option>

                            <option value="staff">
                                Staff
                            </option>

                            <option value="finance">
                                Finance
                            </option>

                        </select>

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
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
                                required
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
                            Simpan
                        </x-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection