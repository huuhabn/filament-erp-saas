@props([
    'src' => null,
    'circular' => true,
    'alt' => '',
    'switch' => false,
])

@php
    $flag = (string) ($src ?? '');
    $isUrl = filter_var($flag, FILTER_VALIDATE_URL) !== false;
@endphp

@if ($isUrl)
    <img
        src="{{ $flag }}"
        alt="{{ $alt }}"
        style="object-fit: cover !important; aspect-ratio: 1/1 !important;"
        @class([
            'w-8 h-8 flex-shrink-0',
            'rounded-full' => $circular,
            'rounded-lg' => ! $circular,
        ])
        {{ $attributes }}
    />
@else
    <span
        @class([
            'inline-flex items-center justify-center text-xs font-semibold uppercase bg-primary-500/10 text-primary-600 w-8 h-8',
            'rounded-full' => $circular,
            'rounded-lg' => ! $circular
        ])
        {{ $attributes }}
    >
        {{ $flag }}
    </span>
@endif
