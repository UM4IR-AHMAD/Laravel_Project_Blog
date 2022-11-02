<x-slot name="header">
    <header class="2xl:w-11/12 mx-auto flex flex-col justify-evenly items-center  text-white  ">
            <div class="flex flex-col sm:flex-row sm:justify-between items-center px-4 w-full lg:w-3/4 xl:px-14">
                <a  href="{{ route('blog.home') }}">
                    <x-application-logo class="w-32 h-32  mb-5"  />
                </a>
                <div class="overflow-hidden ">
                    <form class="focus-within:translate-x-0 hover:translate-x-0 transition duration-500 sm:translate-x-2/3 " action="{{route('blog.search')}}" method="GET">
                        <div class="flex items-center text-black">

                                <input id="search" placeholder="Search by" class="mr-1 sm:m-auto w-32 sm:w-auto text-sm rounded focus:ring-rose-400  " type="text" name="search" value="{{old('search')}}" required autofocus />
        
                                <select id="search_by" name="search_by" class=" h-10 sm:h-auto rounded ">
                                    
                                    <option class=""  value="title" {{ (old('search_by') == 'title') ? 'selected' : '' }} >Title</option>
                                    
                                    <option  value="user" {{ (old('search_by') == 'user') ? 'selected' : '' }}>Author</option>Author</option>

                                </select>
                        </div>        
                    </form>
                </div>
            </div>

            <div class=" w-full lg:w-3/4 flex flex-wrap justify-center mt-5 sm:pt-2 bg-rose-800 sm:bg-transparent shadow sm:shadow-transparent">
                @foreach ($categories as $category)
                    <div class=" xl:basis-1/6 md:basis-1/5 sm:basis-1/4 basis-1/6 text-center my-2" >

                        {{-- request()->segment(2) use to get the value after second forward slash in URL --}}
                        <a class="inline-block  tracking-wider underline-offset-8 hover:underline {{ (request()->segment(2) == $category->category) ? ' underline  ' : ''  }} "
                        href="{{ route('blog.postsByCategory', ['category' => $category->category]) }}">
                            
                            <img class="hidden sm:block hover:shadow-none shadow-md shadow-rose-700 w-32  hover:scale-110 transition rounded-full  mb-2" src="{{ $category->getFirstMedia('categories')->getUrl('thumb') }}" alt="">

                            <span class="text-xs capitalize sm:text-md md:text-lg lg:text-xl">{{$category->category}} </span>

                        </a>
                    </div>
                @endforeach
            </div>
    </header>
</x-slot>


