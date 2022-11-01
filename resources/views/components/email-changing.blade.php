@props(['emailRoute'])

<div class="basis-1/2 shadow-lg p-2 h-max">
                        
    <div>
        <h1 class="mb-7">{{__('Change Email')}}</h1>

        @if (session('email-sent'))
            <div class="w-full">
                <x-successMessage />
            </div>
        @endif
      
        @error('email')
            <x-validationErrors />
        @enderror
        
        <div class="mt-2 mb-4 text-sm text-gray-600">
            {{ __('New email confirmation is mandtory. Enter the new email address.') }}
        </div>
        <form method="POST" action="{{ $emailRoute }}">
            @csrf
            @method('put')
            <!-- Id -->
            <x-input id="id"  class="block mt-1 w-full" type="hidden" name="id" :value="old('id')"  required autofocus />

            <!-- email -->
            <div>
                <x-label for="email" :value="__('New Email Address')" />

                <x-input id="email" class="block mt-1 w-full"
                                type="email"
                                name="email"
                                required />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Update Email') }}
                </x-button>
            </div>
        </form>
    </div>
</div>