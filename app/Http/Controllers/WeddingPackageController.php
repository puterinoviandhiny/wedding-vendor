<?php

namespace App\Http\Controllers;

use App\Models\WeddingPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WeddingPackageController extends Controller
{
    private function businessId(): int
    {
        $user = auth()->user();

        $businessId = $user->business_id
            ?? $user->business?->id;

        abort_unless($businessId, 403, 'Akun belum terhubung ke bisnis.');

        return (int) $businessId;
    }

    private function packageQuery()
    {
        return WeddingPackage::query()
            ->where('business_id', $this->businessId());
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $status = (string) $request->query('status', '');

        $packages = $this->packageQuery()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($status, ['active', 'inactive'], true),
                fn ($query) => $query->where(
                    'is_active',
                    $status === 'active'
                )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('packages.index', compact(
            'packages',
            'search',
            'status'
        ));
    }

    public function create(): View
    {
        $package = new WeddingPackage();

        return view('packages.create', compact('package'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePackage($request);

        $this->packageQuery()->create([
            ...$validated,
            'business_id' => $this->businessId(),
        ]);

        return redirect()
            ->route('packages.index')
            ->with('success', 'Paket wedding berhasil ditambahkan.');
    }

    public function edit(WeddingPackage $package): View
    {
        $this->authorizePackage($package);

        return view('packages.edit', compact('package'));
    }

    public function update(
        Request $request,
        WeddingPackage $package
    ): RedirectResponse {
        $this->authorizePackage($package);

        $package->update($this->validatePackage($request));

        return redirect()
            ->route('packages.index')
            ->with('success', 'Paket wedding berhasil diperbarui.');
    }

    public function destroy(WeddingPackage $package): RedirectResponse
    {
        $this->authorizePackage($package);

        $package->delete();

        return redirect()
            ->route('packages.index')
            ->with('success', 'Paket wedding berhasil dihapus.');
    }

    private function authorizePackage(WeddingPackage $package): void
    {
        abort_unless(
            (int) $package->business_id === $this->businessId(),
            404
        );
    }

    private function validatePackage(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'code' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:10000'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'duration_hours' => ['nullable', 'integer', 'min:1', 'max:8760'],
            'included_services' => ['nullable', 'array', 'max:50'],
            'included_services.*' => ['required', 'string', 'max:200'],
            'is_active' => ['required', Rule::in(['0', '1', 0, 1, true, false])],
        ]);
    }
}
