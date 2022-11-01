<x-app-layout>
    <x-slot name="title">{{ __('Update Post') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit post') }}
        </h2>
    </x-slot>
    <div class="mt-2 px-2">
        <x-validationErrors :errors="$errors" />
    </div>

    <div class="px-6 my-12  mx-auto sm:px-2 lg:px-8">
        <div class="bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="py-5   ">
                    <x-postForm title="Update" :route="route('post.update')" :categories=$categories :method="__('put')"/>
                </div>
            </div>
        </div>

</x-app-layout>
