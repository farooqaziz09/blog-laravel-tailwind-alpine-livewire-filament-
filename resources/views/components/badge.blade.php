@props([ 'bgColor', 'textColor'])
<button {{ $attributes }} class=" rounded-xl px-3 py-1 text-base border-solid border-2"
  style="background-color:{{ $bgColor }}; color:{{ $textColor }};">
  {{ $slot }}
</button>
