
@php
    $isEdit = $client->exists;
@endphp

<div class="card dashboard-card">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-1">Informasi Klien</h5>
        <p class="text-muted small mb-4">
            Masukkan informasi kontak agar mudah dihubungi saat proses pemesanan.
        </p>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">
                    Nama Klien <span class="text-danger">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $client->name) }}"
                    maxlength="150"
                    required
                    autofocus
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">
                    Nomor Telepon <span class="text-danger">*</span>
                </label>
                <input
                    id="phone"
                    name="phone"
                    type="tel"
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $client->phone) }}"
                    maxlength="30"
                    required
                    placeholder="Contoh: 081234567890"
                >
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $client->email) }}"
                    maxlength="255"
                    placeholder="nama@email.com"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                <input
                    id="whatsapp"
                    name="whatsapp"
                    type="tel"
                    class="form-control @error('whatsapp') is-invalid @enderror"
                    value="{{ old('whatsapp', $client->whatsapp) }}"
                    maxlength="30"
                    placeholder="Nomor WhatsApp jika berbeda"
                >
                @error('whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="source" class="form-label">Sumber Klien</label>
                <select
                    id="source"
                    name="source"
                    class="form-select @error('source') is-invalid @enderror"
                >
                    <option value="">Pilih sumber</option>
                    @foreach ([
                        'Instagram',
                        'Facebook',
                        'TikTok',
                        'WhatsApp',
                        'Referral',
                        'Website',
                        'Other',
                    ] as $source)
                        <option
                            value="{{ $source }}"
                            @selected(old('source', $client->source) === $source)
                        >
                            {{ $source === 'Other' ? 'Lainnya' : $source }}
                        </option>
                    @endforeach
                </select>
                @error('source')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Alamat</label>
                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    maxlength="5000"
                    class="form-control @error('address') is-invalid @enderror"
                    placeholder="Alamat klien..."
                >{{ old('address', $client->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="notes" class="form-label">Catatan Klien</label>
                <textarea
                    id="notes"
                    name="notes"
                    rows="4"
                    maxlength="10000"
                    class="form-control @error('notes') is-invalid @enderror"
                    placeholder="Preferensi, kebutuhan khusus, atau informasi penting..."
                >{{ old('notes', $client->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="profile-actions col-12 mt-4 d-flex justify-content-end gap-2">
            <x-button
                variant="light"
                icon="back"
                href="{{ route('clients.index') }}"
            >
                Batal
            </x-button>

            <x-button
                variant="primary"
                icon="save"
                type="submit"
            >
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Klien' }}
            </x-button>
        </div>
    </div>
</div>
