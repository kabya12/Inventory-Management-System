@props([
    'route'
])

<x-button {{ $attributes->merge(['class' => 'btn btn-outline-info']) }} route="{{ $route }}">
    <i class="fas fa-money-bill"></i> <!-- Change the icon here -->
    {{ $slot }}
</x-button>
