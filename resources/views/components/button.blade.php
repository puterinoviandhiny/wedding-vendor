
@props([
    'variant' => 'primary',
    'icon' => null,
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'iconOnly' => false,
    'disabled' => false,
    'loading' => false,
    'title' => null,
])

@php
    $classes = trim(
        'app-btn app-btn-' . $variant .
        ' app-btn-' . $size .
        ($iconOnly ? ' app-btn-icon-only' : '')
    );

    $attributes = $attributes->merge([
        'class' => $classes,
        'title' => $title,
    ]);

    $tag = $href ? 'a' : 'button';
@endphp

@if ($tag === 'a')
    <a href="{{ $href }}"
       {{ $attributes }}
       @if ($disabled) aria-disabled="true" tabindex="-1" @endif>
        @if ($icon)
            <x-icon :name="$icon" />
        @endif

        @unless ($iconOnly)
            <span>{{ $slot }}</span>
        @endunless
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes }}
        @disabled($disabled || $loading)
        @if ($loading) aria-busy="true" @endif
    >
        @if ($loading)
            <span class="app-btn-spinner" aria-hidden="true"></span>
        @elseif ($icon)
            <x-icon :name="$icon" />
        @endif

        @unless ($iconOnly)
            <span>{{ $slot }}</span>
        @endunless
    </button>
@endif
