<x-blog-layout>
    @include('blog.header')
    <x-blog-posts-list :posts=$posts/>
    @include('blog.topPosts');
</x-blog-layout> 
