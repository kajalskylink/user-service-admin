@props([
    'url' => null,
    'type' => 'button',
    'class' => 'btn-primary',
    'icon' => null,
])

@if($url)
    <a href="{{ $url }}" {{ $attributes->merge(['class' => 'btn ' . $class]) }}>
        @if($icon) <i data-feather="{{ $icon }}" class="me-2"></i> @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn ' . $class]) }}>
        @if($icon) <i data-feather="{{ $icon }}" class="me-2"></i> @endif
        {{ $slot }}
    </button>
@endif
