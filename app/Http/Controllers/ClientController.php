<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClientController extends Controller
{
    private function businessId(): int
    {
        $user = auth()->user();

        $businessId = $user->business_id
            ?? $user->business?->id;

        abort_unless($businessId, 403, 'Akun belum terhubung ke bisnis.');

        return (int) $businessId;
    }

    private function clientQuery()
    {
        return Client::query()
            ->where('business_id', $this->businessId());
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $clients = $this->clientQuery()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('whatsapp', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients', 'search'));
    }

    public function create(): View
    {
        $client = new Client();

        return view('clients.create', compact('client'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateClient($request);

        $validated['business_id'] = $this->businessId();

        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Klien berhasil ditambahkan.');
    }

    public function show(Client $client): View
    {
        $this->authorizeClient($client);

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        $this->authorizeClient($client);

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $this->authorizeClient($client);

        $validated = $this->validateClient($request);
        unset($validated['business_id']);

        $client->update($validated);

        return redirect()
            ->route('clients.show', $client)
            ->with('success', 'Data klien berhasil diperbarui.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->authorizeClient($client);

        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Klien berhasil dihapus.');
    }

    private function authorizeClient(Client $client): void
    {
        abort_unless(
            (int) $client->business_id === $this->businessId(),
            404
        );
    }

    private function validateClient(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:5000'],
            'source' => [
                'nullable',
                Rule::in([
                    'Instagram',
                    'Facebook',
                    'TikTok',
                    'WhatsApp',
                    'Referral',
                    'Website',
                    'Other',
                ]),
            ],
            'notes' => ['nullable', 'string', 'max:10000'],
        ]);
    }
}
