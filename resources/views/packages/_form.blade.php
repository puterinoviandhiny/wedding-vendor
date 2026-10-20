@php
    $isEdit = $package->exists;

    $services = old(
        'included_services',
        $package->included_services ?? ['']
    );

    if (!is_array($services) || count($services) === 0) {
        $services = [''];
    }
@endphp

<div class="card dashboard-card">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-1">Informasi Paket</h5>
        <p class="text-muted small mb-4">
            Tentukan nama, harga, durasi, dan layanan yang diterima klien.
        </p>

        <div class="row g-3">
            <div class="col-md-8">
                <label for="name" class="form-label">
                    Nama Paket <span class="text-danger">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $package->name) }}"
                    placeholder="Contoh: Wedding Gold Package"
                    maxlength="150"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="code" class="form-label">Kode Paket</label>
                <input
                    id="code"
                    name="code"
                    class="form-control @error('code') is-invalid @enderror"
                    value="{{ old('code', $package->code) }}"
                    placeholder="Contoh: WED-GOLD"
                    maxlength="50"
                >
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="price" class="form-label">
                    Harga Paket (Rp) <span class="text-danger">*</span>
                </label>
                <input
                    id="price"
                    name="price"
                    type="number"
                    min="0"
                    max="9999999999999.99"
                    step="0.01"
                    class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price', $package->price ?? '0') }}"
                    required
                >
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="duration_hours" class="form-label">
                    Durasi Layanan (jam)
                </label>
                <input
                    id="duration_hours"
                    name="duration_hours"
                    type="number"
                    min="1"
                    max="8760"
                    class="form-control @error('duration_hours') is-invalid @enderror"
                    value="{{ old('duration_hours', $package->duration_hours) }}"
                    placeholder="Contoh: 8"
                >
                @error('duration_hours')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="description" class="form-label">
                    Deskripsi Paket
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    maxlength="10000"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Jelaskan keunggulan dan ketentuan paket..."
                >{{ old('description', $package->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Layanan yang Termasuk</label>
                <p class="text-muted small">
                    Tambahkan layanan satu per satu, misalnya dekorasi, fotografi, atau makeup.
                </p>

                <div id="packageServices" class="d-flex flex-column gap-2">
                    @foreach ($services as $index => $service)
                        <div class="d-flex gap-2 package-service-row">
                            <input
                                name="included_services[]"
                                class="form-control"
                                value="{{ $service }}"
                                maxlength="200"
                                placeholder="Nama layanan"
                            >

                            <button
                                type="button"
                                class="app-btn app-btn-delete app-btn-icon-only remove-package-service"
                                title="Hapus layanan"
                                aria-label="Hapus layanan"
                            >
                                <x-icon name="trash" size="16" />
                            </button>
                        </div>
                    @endforeach
                </div>

                @error('included_services')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror

                @error('included_services.*')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror

                <button
                    type="button"
                    id="addPackageService"
                    class="app-btn app-btn-light app-btn-sm mt-3"
                >
                    <x-icon name="plus" size="15" />
                    Tambah Layanan
                </button>
            </div>

            <div class="col-12">
                <label for="is_active" class="form-label">Status Paket</label>
                <select
                    id="is_active"
                    name="is_active"
                    class="form-select @error('is_active') is-invalid @enderror"
                    required
                >
                    <option value="1" @selected((string) old('is_active', $package->exists ? (int) $package->is_active : 1) === '1')>
                        Aktif
                    </option>
                    <option value="0" @selected((string) old('is_active', $package->exists ? (int) $package->is_active : 1) === '0')>
                        Nonaktif
                    </option>
                </select>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="profile-actions col-12 mt-4 d-flex justify-content-end gap-2">
            <x-button
                variant="light"
                icon="back"
                href="{{ route('packages.index') }}"
            >
                Batal
            </x-button>

            <x-button variant="primary" icon="save" type="submit">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Paket' }}
            </x-button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('packageServices');
    const addButton = document.getElementById('addPackageService');

    if (!container || !addButton || container.dataset.initialized) return;
    container.dataset.initialized = 'true';

    function updateRows() {
        const rows = container.querySelectorAll('.package-service-row');
        rows.forEach((row) => {
            const removeButton = row.querySelector('.remove-package-service');
            if (removeButton) {
                removeButton.disabled = rows.length === 1;
                removeButton.style.opacity = rows.length === 1 ? '.4' : '1';
            }
        });
    }

    addButton.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'd-flex gap-2 package-service-row';

        const input = document.createElement('input');
        input.name = 'included_services[]';
        input.className = 'form-control';
        input.maxLength = 200;
        input.placeholder = 'Nama layanan';

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'app-btn app-btn-delete app-btn-icon-only remove-package-service';
        remove.title = 'Hapus layanan';
        remove.setAttribute('aria-label', 'Hapus layanan');
        remove.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="m19 6-1 14H6L5 6"/><path d="M10 11v5M14 11v5"/></svg>';

        row.append(input, remove);
        container.append(row);
        updateRows();
        input.focus();
    });

    container.addEventListener('click', function (event) {
        const target = event.target;
        if (!(target instanceof Element)) return;

        const button = target.closest('.remove-package-service');
        if (!button || container.querySelectorAll('.package-service-row').length <= 1) return;

        button.closest('.package-service-row')?.remove();
        updateRows();
    });

    updateRows();
});
</script>
@endpush
