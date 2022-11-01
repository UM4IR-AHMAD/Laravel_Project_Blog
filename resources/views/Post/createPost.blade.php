<x-app-layout>
    <x-slot name="title">{{ __('Create New Post') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Create new post') }}
        </h2>
    </x-slot>
    <div class="mt-2 px-2">
        <x-validationErrors :errors="$errors" />
    </div>

    <div class="px-6 my-12  mx-auto sm:px-2 lg:px-8">
        <div class="bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="py-5   ">
                    <x-postForm title="Publish" :route="route('post.store')" :categories=$categories :method="__('post')"/>
                </div>
            </div>
        </div>

</x-app-layout>



