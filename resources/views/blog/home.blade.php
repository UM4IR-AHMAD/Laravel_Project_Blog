<x-blog-layout>
    @include('blog.header')

    <div class="relative overflow-hidden px-4">
        <img  class="hidden lg:block lg:scale-125 inset-0 absolute" src="http://ishtiaq.sandbox.etdevs.com/blogger/wp-content/uploads/sites/30/2021/09/blogger_53.jpg" alt="">

        <div class="w-full lg:w-3/5 relative py-7 mx-auto">
            <div id="carouselExampleCaptions" class="carousel slide relative" data-bs-ride="carousel">
            <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                
                @for ($i = 0; $i < $corusalPosts->count(); $i++)
                    <button
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="{{$i}}"
                        @if ($i == 0)
                            class="active"
                            aria-current="true"                            
                        @endif
                        aria-label="Slide {{ $i + 1 }}">   
                    </button>
                @endfor
            </div>
            <div class="carousel-inner relative overflow-hidden w-full ">

                @foreach ($corusalPosts as $key => $post)
                        <div class=" carousel-item relative float-left w-full bg-cover bg-center 
                                    {{ ($key == 0) ? 'active' : ''}}"
                            style="background-image: url('{{ $post->getFirstMedia('posts')->getUrl() }}')">

                            <div class="bg-black border-2 border-white opacity-70 carousel-caption h-80 xl:h-96 text-center">
                                <div class="w-3/4 mx-auto mt-10 sm:mt-20 xl:mt-32 mb-4">
                                    <h5 class="text-3xl text">{{ substr($post->title,0,20) }}</h5>
                                    <div class="text-rose-500  text-sm">

                                        <span>by 
                                            <a class="hover:text-rose-400" 
                                                href="{{ route('blog.postsByAuthor', ['username' => $post->user->username]) }}">
                                                {{ $post->user->name  }}
                                            </a> |
                                        </span>
                                        <span> 
                                            <a class="hover:text-rose-400" 
                                                href="{{ route('blog.postsByCategory', ['category' => ($post->category->category) ?? 'none']) }}">
                                                {{ $post->category->category ?? 'random'}}
                                            </a> |
                                        </span>
                                        <span>{{ date('F d, Y', strtotime($post->created_at)) }}</span>
                                    </div>
                                    <div class="text-xs">{!! substr($post->description,0,169) !!}...</div>
                                </div>
                                <x-anchorButton :css="'px-3 py-1 '" href="{{route('blog.post.show', ['id'=> $post->id])}}" id="read-more">
                                    {{ __('Read More') }}
                                </x-anchorButton>                        
                            </div>
                        </div>    
                @endforeach
                
            </div>
            <button
                class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
    </div>

    <x-blog-posts-list :posts=$posts/>

    @include('blog.topPosts');

</x-blog-layout> 
