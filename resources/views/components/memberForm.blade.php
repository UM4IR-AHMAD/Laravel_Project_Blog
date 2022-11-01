@props(['method', 'title', 'route', 'emailRoute', 'roles'])


<div class="basis-1/2 shadow py-4">
    <form class=" mx-auto w-5/6 " method="POST" action="{{ $route }}">
        @csrf
        @if ($method == 'put')
            @method('put')        
        @endif
    
        {{-- success message --}}
        @empty(session('email-sent'))
            <div class="w-full">
                <x-successMessage />
            </div>
        @endempty

        {{-- error --}}
        @error('password')
            <x-validationErrors />
        @enderror

        <!-- Id -->
        <x-input id="id"  class="block mt-1 w-full" type="hidden" name="id" :value="old('id')"  required autofocus />
    
        <!-- Role -->    
        @can('isSuperAdmin')
                <div class="my-4 mx-auto w-5/6 ">
                    <x-label for="role" :value="__('Role')" />
    
                    <x-select id="role" class="block mt-1 w-full" name="role_id" :value="old('role_id')" :data=$roles required />
                </div>
        @endcan
    
        <!-- Name -->
        <div class="mx-auto w-5/6  ">
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <!-- email -->    
        @if ($title === 'register')
            <div class="mt-4 mx-auto w-5/6 ">
                <x-label for="email" :value="__('Email Address')" />
        
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>    
        @endif
        
    
        <!-- username -->    
        <div class="mt-4 mx-auto w-5/6 ">
            <x-label for="username" :value="__('Username')" />
    
            <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
        </div>
    
        <!-- Password -->
        <div class="mt-4 mx-auto w-5/6">
            <x-label for="password" :value="__('Password')" />
    
            <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                             autocomplete="new-password" />
        </div>
    
        <!-- Confirm Password -->
        <div class="mt-4 mx-auto w-5/6">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />
    
            <x-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"  />
        </div>
    
        
        <div class="flex items-center justify-center mt-4">
            <x-button class="ml-4">
                {{ $title }}
            </x-button>
        </div>
    
    </form>
</div>


@if ($title === 'update')
    {{-- user email changing --}}
    <x-email-changing :emailRoute="$emailRoute" />
@endif
    