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
</nav>
