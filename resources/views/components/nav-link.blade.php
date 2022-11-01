@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block  items-center px-1 py-3 border-b-2 border-b-red-300 border-r-8 border-red-300 text-sm font-medium leading-5 text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block  items-center px-1 py-3 border-b-2 border-b-red-300 border-r-4 border-transparent text-gray-300 text-sm font-medium leading-5 hover:text-white hover:border-gray-300 focus:border-gray-300  focus:outline-none focus:text-gray-700  transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>


{{-- #removing it to show that button is disabled, logic changed and placed these back --}}
{{-- text-gray-300 hover:text-white hover:border-gray-300 focus:border-gray-300 --}} 