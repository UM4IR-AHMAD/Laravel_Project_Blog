

{{-- in this way we cant compile component in php --}}

{{-- <a {{$attributes->merge(['class' => '  bg-red-800 border border-transparent rounded-md font-semibold text-center text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'])}}>
$slot
</a> --}}

<a {{$attributes}}  class ='bg-rose-800 border border-transparent rounded-md font-semibold text-center text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 {{$css}}'>
   {{ $slot}}
</a>