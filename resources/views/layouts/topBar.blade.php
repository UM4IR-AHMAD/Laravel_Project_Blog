<div class="">
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
            <div id="dropdown" class="relative" onclick="dropMenu()"  >
                <div>
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
                </div>

                <div id="dropdownMenu" class="absolute inset-0 h-0 overflow-hidden z-10 bg-white top-7 -left-9 transition-all text-xs " onmouseleave="closeMenu()">

                    <a class="block w-36 py-2 px-2 hover:bg-gray-200" href="route('profile.edit')">
                            {{ __('Profile') }}
                    </a>
                    <a class="block w-36 py-2 px-2 hover:bg-gray-200" href="route('logout')">
                        {{ __('Log Out') }}
                    </a>
                </div>
            </div>
        </div>
    @endif
    
</div>
