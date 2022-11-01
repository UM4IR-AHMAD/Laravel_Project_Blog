@props(['toltip', 'route', 'icon'])

<a class=" hover:text-gray-700 relative after:absolute after:-top-4 after:-left-2 after:content-['{{ $toltip }}'] after:text-black after:font-bold after:invisible hover:after:visible"  href="{{$route}}"><i class="{{$icon}}"></i></a>