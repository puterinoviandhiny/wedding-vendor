@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">

    <div>

        <h1 class="page-title">
            Dashboard
        </h1>

        <div class="page-subtitle">
            Overview bisnis wedding Anda hari ini.
        </div>

    </div>

    <div class="page-header-actions">

        <x-button
        variant="primary"
        icon="plus"
        >
            New Booking
        </x-button>

    </div>

</div>

<div class="row g-4">

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon rose">
                Rp
            </div>

            <div class="stat-label">
                Total Revenue
            </div>

            <div class="stat-value">
                Rp 0
            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon sage">
                ✓
            </div>

            <div class="stat-label">
                Total Paid
            </div>

            <div class="stat-value">
                Rp 0
            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon peach">
                ◷
            </div>

            <div class="stat-label">
                Receivables
            </div>

            <div class="stat-value">
                Rp 0
            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon mauve">
                ♡
            </div>

            <div class="stat-label">
                Upcoming Weddings
            </div>

            <div class="stat-value">
                0
            </div>

        </div>

    </div>

</div>

<div class="row g-4 mt-1">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    Revenue Overview
                </div>

            </div>

            <div class="card-body">

                <div
                    id="revenueChart"
                    style="height: 300px;"
                >

                    <div class="text-center text-muted pt-5">
                        Belum ada data transaksi.
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    Upcoming Events
                </div>

            </div>

            <div class="card-body">

                <div class="text-center text-muted py-5">

                    Belum ada booking.

                </div>

            </div>

        </div>

    </div>

</div>

@endsection