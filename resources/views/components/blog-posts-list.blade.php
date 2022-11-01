@props(['posts'])
    @php
        $all = '' ;
    @endphp

    @foreach ($posts as $key => $post)

            @php
            // $attributes = ["class"=>"px-3 py-1", "href"=>"", "id"=>"read-more"];
            $attributes = ' href='.route('blog.post.show', ['id'=> $post->id]).'  id="read-more"';


            $all .= '<div class="rounded-md flex shadow bg-white border-t-2 border-rose-900 p-2 my-10 w-full h-full">
                        <div class="w-1/5 hidden sm:block">
                            <img class=" w-full h-full" src='.$post->getFirstMedia('posts')->getUrl('thumb').' alt="">
                        </div>
                        
                        <div class="p-2 w-full sm:w-4/5 flex flex-wrap justify-end">
                            <div class="mb-4 ">
                                <h1 class="text-2xl">'.$post->title.'</h1>
                                <div class=" text-xs mb-3">
                                    <span>by 
                                            <a class="text-rose-800 hover:text-rose-400" 
                                                href="' .route('blog.postsByAuthor', ['username' => $post->user->username]). '">
                                                '.$post->user->name.'
                                            </a> |
                                        </span>
                                        <span> 
                                            <a class="text-rose-800 hover:text-rose-400" 
                                                href="' .route('blog.postsByCategory', ['category' => ($post->category->category ?? 'random')]). '">
                                                '.($post->category->category ?? 'random' ).'
                                            </a> |
                                        </span>
                                    <span class="block xxs:inline" > '. date('F d, Y', strtotime($post->created_at)) .'</span>
                                </div>
                                <div class="text-xs">'. strip_tags(substr($post->description,0,280)) .'...</div>
                            </div>
                            <div class="text-right" >
                                '.view('components.anchorButton', ['attributes' => $attributes, 'css'=>' px-3 py-2 ', 'slot' => 'read More'])->toHtml().'
                            </div>
                            
                        </div>

                    </div>';
        @endphp
        @endforeach



    <div class="w-full lg:w-3/4 mx-auto px-4 xxs:my-0">
        @if ($posts->count() === 0)
            <h1 class="text-5xl text-center my-10">No result found</h1>
        @endif   
        {!! $all !!}
        <div class="-mt-8">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>