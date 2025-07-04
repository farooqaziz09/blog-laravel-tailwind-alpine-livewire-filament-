@props(['active', 'navigate'])

@php
  $classes =
      $active ?? false
          ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
          : 'inline-flex items-center hover:text-yellow-900 text-sm text-grey-500';
@endphp

<a {{ $navigate ?? true ? 'wire:navigate' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
