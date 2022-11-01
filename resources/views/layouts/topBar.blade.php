<div class="">
     {{-- sm:flex sm:items-center --}}
    <!-- Settings Dropdown -->

    @if (session('notAllow'))
        <button class="flex items-center cursor-not-allowed  text-sm font-medium text-gray-200 hover:text-white hover:border-white focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
            <div>{{ Auth::user()->name }}</div>

            <div class="ml-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>    
    @else
        <div class="block  "> 
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center  text-sm font-medium text-gray-200 hover:text-white hover:border-white focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
                        <div>
                            <i class="fas fa-user"></i>
                            <span class="ml-1">{{ Auth::user()->name }}</span>
                            
                        </div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">

                    <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    {{-- <form method="POST" action="{{ route('logout') }}">
                        @csrf --}}

                    
                        <x-dropdown-link :href="route('logout')">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                        
                    {{-- </form> --}}
                </x-slot>
            </x-dropdown>
        </div>
    @endif
    
</div>