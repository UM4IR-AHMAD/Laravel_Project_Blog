<x-app-layout>
    <x-slot name="title">{{ __('Post Preview') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Post Preview') }}
        </h2>
    </x-slot>
    <div class="px-6 my-12 mx-auto sm:px-2 lg:px-8">
        <div class="bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="py-14 flex flex-col content-between items-center ">

                <p class="text-5xl mb-10">{{ $post['title'] }}</p>
                
                @isset($post['imageName'])
                    <img  src={{ asset('images/previews/'. $post['imageName']) }} alt="">
                @endisset

                @isset($post['imageUrl'])
                    <img  src={{ $post['imageUrl'] }} alt="">
                @endisset

                <div class="my-10 px-5">
                    {!! $post['description'] !!}
                </div>
                
                <a class="px-4 py-3 w-2/12 bg-red-800 border border-transparent rounded-md font-semibold text-center text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    {{-- href="javascript:history.back()" --}}
                    href="{{ $post['route'] }}"
                    id="discart">
                    Back
                </a>
            </div>
        </div>
    </div>
    {{ session()->flash('_old_input', old()) }}
</x-app-layout>
    