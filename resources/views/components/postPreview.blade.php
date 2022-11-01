@props(['post'])

<div class="px-6 my-12  mx-auto sm:px-2 lg:px-8">
    <div class="bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="py-10 flex-col content-center">
            <h1>{{ $post['title'] }}</h1>
            @isset($post['imageName'])
                <img  src={{ asset('images/previews/'. $post['imageName']) }} alt="post-image">
            @endisset

            @isset($post['imageUrl'])
                <img  src={{ $post['imageUrl'] }} alt="post-image">
            @endisset


            {!! $post['description'] !!}
            
       
        </div>
    </div>
</div>
 