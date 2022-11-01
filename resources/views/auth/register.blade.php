<x-app-layout>
    <x-slot name="title">{{ __('Add New Member') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Member') }}
        </h2>
    </x-slot>
    <div class="mt-2 px-2">
        <x-validationErrors :errors="$errors" />
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <x-memberForm title="register" :roles=$roles :route="route('register')" :method="__('post')"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>