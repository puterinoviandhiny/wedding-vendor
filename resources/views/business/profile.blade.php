@extends('layouts.app')

@section('title', 'Profil Bisnis')
@section('page-title', 'Profil Bisnis')

@section('content')

<form
    method="POST"
    action="{{ route('business.profile.update') }}"
>

    @csrf
    @method('PUT')

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card dashboard-card">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-1">
                        Informasi Bisnis
                    </h5>

                    <p class="text-muted mb-4">
                        Informasi vendor yang akan digunakan pada invoice.
                    </p>


                    <div class="row g-3">

                        <div class="col-md-8">

                            <label class="form-label">
                                Nama Bisnis
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $business->name) }}"
                                required
                            >

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Jenis Bisnis
                            </label>

                            <input
                                type="text"
                                name="business_type"
                                class="form-control"
                                value="{{ old('business_type', $business->business_type) }}"
                                placeholder="Wedding Vendor"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $business->email) }}"
                            >

                        </div>


                        <div class="col-md-3">

                            <label class="form-label">
                                Telepon
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $business->phone) }}"
                            >

                        </div>


                        <div class="col-md-3">

                            <label class="form-label">
                                WhatsApp
                            </label>

                            <input
                                type="text"
                                name="whatsapp"
                                class="form-control"
                                value="{{ old('whatsapp', $business->whatsapp) }}"
                            >

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                            >{{ old('address', $business->address) }}</textarea>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Kota
                            </label>

                            <input
                                type="text"
                                name="city"
                                class="form-control"
                                value="{{ old('city', $business->city) }}"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Provinsi
                            </label>

                            <input
                                type="text"
                                name="province"
                                class="form-control"
                                value="{{ old('province', $business->province) }}"
                            >

                        </div>

                    </div>

                </div>

            </div>


            <div class="card dashboard-card mt-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-1">
                        Pengaturan Invoice
                    </h5>

                    <p class="text-muted mb-4">
                        Digunakan untuk invoice pada modul berikutnya.
                    </p>

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Prefix Invoice
                            </label>

                            <input
                                type="text"
                                name="invoice_prefix"
                                class="form-control"
                                value="{{ old('invoice_prefix', $business->invoice_prefix) }}"
                                required
                            >

                            <small class="text-muted">
                                Contoh: INV
                            </small>

                        </div>


                        <div class="col-md-8">

                            <label class="form-label">
                                Catatan Invoice
                            </label>

                            <textarea
                                name="invoice_notes"
                                class="form-control"
                                rows="3"
                            >{{ old('invoice_notes', $business->invoice_notes) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            <div class="card dashboard-card mt-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-1">
                        Rekening Pembayaran
                    </h5>

                    <p class="text-muted mb-4">
                        Akan ditampilkan pada invoice.
                    </p>

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Bank
                            </label>

                            <input
                                type="text"
                                name="bank_name"
                                class="form-control"
                                value="{{ old('bank_name', $business->bank_name) }}"
                            >

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Nama Rekening
                            </label>

                            <input
                                type="text"
                                name="bank_account_name"
                                class="form-control"
                                value="{{ old('bank_account_name', $business->bank_account_name) }}"
                            >

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Nomor Rekening
                            </label>

                            <input
                                type="text"
                                name="bank_account_number"
                                class="form-control"
                                value="{{ old('bank_account_number', $business->bank_account_number) }}"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card dashboard-card">

                <div class="card-body p-4">

                    <h5 class="fw-bold">
                        Informasi
                    </h5>

                    <p class="text-muted">
                        Data ini akan digunakan oleh sistem
                        pada fitur booking dan invoice.
                    </p>

                    <hr>

                    <div class="mb-3">

                        <small class="text-muted">
                            Business ID
                        </small>

                        <div class="fw-bold">
                            #{{ $business->id }}
                        </div>

                    </div>

                    <div class="mb-3">

                        <small class="text-muted">
                            Slug
                        </small>

                        <div class="fw-bold">
                            {{ $business->slug }}
                        </div>

                    </div>

                    <div>

                        <small class="text-muted">
                            Dibuat
                        </small>

                        <div class="fw-bold">
                            {{ $business->created_at?->format('d M Y') }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="mt-4">

        <x-button variant="primary" icon="save" type="submit">

            Simpan Perubahan

        </x-button>

    </div>

</form>

@endsection