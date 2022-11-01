@php 
    $class = '';
    if (session('notAllow')) {
        $class = 'cursor-not-allowed';
    }
@endphp


<nav x-data="{ open: false }" class="relative h-full pt-3 border-r-2 border-rose-900 overflow-hidden ">
    <!-- Primary Navigation Menu -->

                <!-- Logo -->
                <div class="mb-3">
                    <a  class="{{$class}} block w-max mx-auto " 
                            href="{{session('notAllow') 
                                ? '#' 
                                : route('dashboard')}}">
                        <x-application-logo class="w-24 h-24" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="h-full bg-rose-900  ">
                    
                    <x-nav-link
                        class="{{$class}}" 
                        :href=" session('notAllow') 
                                ? '#' 
                                : route('dashboard')" 
                        :active="request()->routeIs('dashboard*')">
                        <span class="">
                            <i class="fas fa-tachometer-alt mx-2 lg:inline hidden"></i>                            
                            {{ __('Dashboard') }}
                        </span>
                    </x-nav-link>

                    <x-nav-link
                        class="{{$class}}" 
                        :href=" session('notAllow') 
                                ? '#' 
                                : route('posts')" 
                        :active="request()->routeIs('post*')">
                        <span class="">
                            <i class="fas fa-th-list mx-2 lg:inline hidden"></i>
                            {{ __('Posts') }}
                        </span>
                    </x-nav-link>
                   
                    @can('notAuthor')
                        <x-nav-link 
                            class="{{$class}}" 
                            :href=" session('notAllow') 
                                ? '#' 
                                : route('categories')" 
                                
                            :active="request()->routeIs('categories*')">
                                <span class="">
                                    <i class="fa fa-shapes mx-2 lg:inline  hidden"></i>
                                    {{ __('Categories') }}
                                </span>
                            
                        </x-nav-link>    
                        <x-nav-link
                            class="{{$class}}" 
                            :href=" session('notAllow') 
                                ? '#' 
                                : route('members')"
                            :active="request()->routeIs('member*')">
                                <span class="">
                                    <i class="fas fa-users mx-2 lg:inline  hidden"></i>                                    
                                    {{ __('Members') }}
                                </span>
                        </x-nav-link>
                        <x-nav-link
                            class="{{$class}}" 
                            :href=" session('notAllow') 
                                ? '#' 
                                : route('settings')" 
                            :active="request()->routeIs('settings')">
                                <span class="">
                                    <i class="fas fa-cog mx-2 lg:inline  hidden"></i>
                                    {{ __('Settings') }}
                                </span>
                        </x-nav-link>     
                    @endcan

                </div>
            {{-- </div> --}}

            {{-- <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile')">
                                {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                        
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                            
                        </form>
                    </x-slot>
                </x-dropdown>
            </div> --}}

            <!-- Hamburger -->
            {{-- <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}

    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-dropdown-link :href="route('profile')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> --}}
</nav>
