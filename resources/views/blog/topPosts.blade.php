<x-slot name="topPosts">
    <div class="w-4/5 mx-auto mt-10">

        @if (!$topPosts->isEmpty())
            <h1 class="font-bold">Top Posts</h1>
        @endif
        <div class=" flex flex-wrap flex-col md:flex-row gap-y-10 justify-evenly py-5">
            @foreach ($topPosts as $item)
                <div class="xl:basis-1/4 lg:basis-1/3 md:basis-1/2 box-border rounded-md flex flex-col items-center hover:bg-white bg-slate-100 border-t-2 border-rose-900 p-2 hover:scale-125 transition-all ">
                    <div class="h-1/3 ">
                        <img class="h-full hidden sm:block" src={{$item->getFirstMedia('posts')->getUrl('thumb')}} alt="">
                    </div>
                    
                    <div class="p-2 basis-3/5">
                        <div class="mb-2">
                            <div class=" text-xs">
                                <span>by 
                                    <a class="text-rose-800 hover:text-rose-400" 
                                        href="{{route('blog.postsByAuthor', ['username' => $item->user->username])}}">
                                        {{$item->user->name}}
                                    </a> |
                                </span>
                                <span> 
                                    <a class="text-rose-800 hover:text-rose-400" 
                                        href="{{route('blog.postsByCategory', ['category' => $item->category->category])}}">
                                        {{$item->category->category}}
                                    </a> |
                                </span>                                
                                <span class="block xxs:inline" > {{ date('F d, Y', strtotime($item->created_at)) }} </span>
                            </div>
                            <h1 class="text-2xl">{{$item->title}}</h1>
                        </div>
                        <div class="text-xs">{!! substr($item->description,0,140) !!}...</div>
                    </div>
                    <div class="block w-full self-end" >
                        <x-anchorButton :css="'block px-3 py-1'" href="{{route('blog.post.show', ['id'=> $item->id])}}" id="read-more ">
                            {{ __('Read More') }}
                        </x-anchorButton>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-slot>