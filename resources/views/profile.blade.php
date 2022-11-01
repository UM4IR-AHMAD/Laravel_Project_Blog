<x-app-layout>
    <x-slot name="title">{{ __('Profile') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold capitalize text-xl text-gray-800 leading-tight">
            {{  $data->role->role  }} {{__(' Profile')}}
        </h2>
    </x-slot>

  


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black shadow-sm sm:rounded-lg">
                <div class="flex gap-x-4 p-6 bg-white border-b border-gray-200 relative">

                    {{-- User Information  --}}
                    <div class="basis-1/2 shadow-lg p-2 relative">

                        <h1 class="mb-7">{{__('Information')}}</h1>
                       
                        @empty(session('password link'))
                            <div class="w-full">
                                <x-successMessage />
                            </div>
                        @endempty
                    
                        @if (!$errors->has('password') && !$errors->has('email') )
                            <x-validationErrors  />
                        @endif

                        @can('isSuperAdmin')    
                            <form class="mt-2 mx-auto  " method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('put')        

                                <!-- Id -->
                                <x-input id="id"  class="block mt-1 w-full" type="hidden" name="id" :value="old('id', $data->id)" readonly  required autofocus />

                                <!-- Email Address -->    
                                <div class=" mx-auto w-5/6 ">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $data->email)" readonly required />
                                </div>

                                <!-- Name -->
                                <div class="mx-auto my-4 w-5/6  ">
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $data->name)" required autofocus />
                                </div>

                                <!-- username -->    
                                <div class=" mx-auto w-5/6 ">
                                    <x-label for="username" :value="__('Username')" />

                                    <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', $data->username)" required />
                                </div>
                                
                                <div class="flex items-center gap-x-4  justify-center mt-4 ">
                                    <x-button class=" ml-4">
                                        {{ __('Update') }}
                                    </x-button>
                                </div>
                            </form>
                        @endcan

                        @cannot('isSuperAdmin')
                            <div class="mx-auto w-1/2 text-gray-600 ">
                                <h3>Name: <span class="text-black">{{$data->name}}</span></h3>
                                <h3 class="my-4">Email: <span class="text-black ">{{$data->email}}</span></h3>
                                <h3>Username: <span class="text-black">{{$data->username}}</span></h3>
                            </div>
                        @endcannot
                    </div>

                    <div class="basis-1/2 h-max">

                        {{-- user password changing --}}
                        <div class=" shadow-lg p-2">
                            <h1 class="mb-7">{{__('Change Passowrd')}}</h1>

                            @if (session('password link'))
                                <div class="w-full">
                                    <x-successMessage />
                                </div>
                            @endif
                          
                            @error('password')
                                <x-validationErrors />
                            @enderror
                            
                            <div class="mt-2 mb-4 text-sm text-gray-600">
                                {{ __('This is your sensitive information. Please confirm your password.') }}
                            </div>
                            <form method="POST" action="{{ route('password.forChangePassword') }}">
                                @csrf
                    
                                <!-- Password -->
                                <div>
                                    <x-label for="password" :value="__('Current Password')" />
                    
                                    <x-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="current-password" />
                                </div>
                    
                                <div class="flex justify-end mt-4">
                                    <x-button>
                                        {{ __('Change Password') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>

                        @can('isSuperAdmin')
                            <div class="p-2 shadow-lg mt-3 ">
                                {{-- change email address --}}
                                <x-email-changing :emailRoute="route('profile.updateEmail')"/>
                            </div>
                        @endcan
                            
                    </div>
    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>