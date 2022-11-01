<x-app-layout>
    <x-slot name="title">{{ __('Update Member') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update member information') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex gap-x-4 p-2 bg-white border-b border-gray-200">
                 
                    @if (isset($roles))
                        <x-memberForm title="update" :route="route('member.update')" :emailRoute="route('member.updateEmail')"  :method="__('put')" :roles=$roles />
                    @else
                        <x-memberForm title="update" :route="route('member.update')" :emailRoute="route('member.updateEmail')"  :method="__('put')" />
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
