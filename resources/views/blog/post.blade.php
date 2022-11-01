<x-blog-layout>

    @include('blog.header')

    <div class="w-4/5 my-20 p-3 mx-auto shadow-sm rounded-md border-y-2 border-rose-900">
            <h1 class="text-5xl text-">{{$post->title}}</h1>
            <div class="text-right text-gray-500">
                <span>by 
                    <a class="text-rose-800 hover:text-rose-400" 
                        href="{{route('blog.postsByAuthor', ['username' => $post->user->username])}}">
                        {{$post->user->name}}
                    </a> |
                </span>
                <span> 
                    <a class="text-rose-800 hover:text-rose-400" 
                        href="{{route('blog.postsByCategory', ['category' => $post->category->category])}}">
                        {{$post->category->category}}
                    </a> |
                </span>         
                <span class="block xxs:inline">{{ date('F d, Y', strtotime($post->created_at)) }}</span>
            </div>
        <img class="mx-auto mt-5" src="{{$post->getFirstMedia('posts')->getUrl()}}" alt="">
        <div class="my-5">{!! $post->description !!}</div>
    </div>

    <div class="w-4/5 mx-auto">
        @if (!$posts->isEmpty())
            <h1 class="font-bold">More written by <a class="italic text-gray-600 hover:underline" href="{{route('blog.postsByAuthor', ['username' => $post->user->username])}}">{{$post->user->name}}</a></h1>
        @endif
        <div class="my-5 flex flex-col md:flex-row justify-around">
            @foreach ($posts as $item)
                <div class=" rounded-md mb-10 flex flex-col items-center bg-white border-t-2 border-rose-900 p-2 mx-2">
                    <div class="h-1/3 ">
                        <img class="h-full" src={{$item->getFirstMedia('posts')->getUrl('thumb')}} alt="">
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
                                <span class="block xxs:inline" > {{ date('F d, Y', strtotime($post->created_at)) }} </span>
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
    
    @include('blog.topPosts');

</x-blog-layout>







