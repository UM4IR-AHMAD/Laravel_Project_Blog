<x-app-layout>
    <x-slot name="title">{{ __('Settings') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Settings') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center mx-auto w-1/2   bg-white border-gray-700">

                    <!-- Logo display -->
                    <h1>Logo</h1>
                    <x-application-logo class="mx-auto w-48 h-48" />

                    
                    <form class="mt-2 mx-auto  " method="POST" action="{{ route('settings.upload-logo') }}"  enctype="multipart/form-data">
                    @csrf
                        <!-- Logo upload -->
                        <div class="mx-auto w-3/5  ">
                            <x-input id="logo" class="block mt-1 w-full" type="file" name="logo" required autofocus />
                        </div>

                        
                        <div class="flex items-center gap-x-4  justify-center mt-4 ">
                            <x-button type="submit" class="bg-rose-800 hover:bg-rose-700 ml-4">
                                {{ __('Uplaod') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
