@props([
    'url' => null,
    'icon' => null,
    'image' => null,
    'label' => null,
    'circular' => false
])

@php
    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        'text-gray-700 dark:text-gray-200 text-sm font-medium flex items-center gap-x-3 p-2 rounded-lg hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5',
    ]);

    $iconWrapperClasses = \Illuminate\Support\Arr::toCssClasses([
        'icon h-6 w-6 flex justify-center items-center rounded-full bg-gray-200 dark:bg-white/10',
    ]);

    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'h-6 w-6 text-gray-600 dark:text-gray-200',
    ]);

    $imageClasses = \Illuminate\Support\Arr::toCssClasses([
        'h-6 w-6 bg-cover bg-center',
    ]);
@endphp
<li>
    <a
        href="{{ $url }}"
        {{
            $attributes
                ->only(['class'])
                ->class([$buttonClasses])
        }}
    >
        @if($label)
            <span class="flex-1">{{ $label }}</span>
        @endif

        @if($image)
            <div
                style="background-image: url('{{ $image }}')"
                @class([
                    $imageClasses,
                    'rounded-full' => $circular,
                    'rounded-md' => !$circular,
                ])></div>
        @else
            <div class="{{ $iconWrapperClasses }}">
                <x-filament::icon
                    :icon="$icon ?? 'heroicon-m-document-text'"
                    :class="$iconClasses"
                    :circular="$circular"
                />
            </div>
        @endif

    </a>
</li>
