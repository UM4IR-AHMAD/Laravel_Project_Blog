@props(['title', 'action'])

<form id="form" class="bg-white box-border p-4" action="{{$action}}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- <!-- Id --> session('id') ?? ''--}} 
    <x-input id="id"  class="block mt-1 w-full" type="hidden" name="id" :value=" old('id')  "  required autofocus />


    <!-- Category Name -->
    <div class="mt-4 mx-auto relative">
        <x-label for="category" :value="__('Category')" />

        <x-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')  "  
         />
    </div>


    <!-- Category Image -->
    <div class=" mt-4 mx-auto w-full">

        <x-label for="image" :value="__('Image')" />

        <x-input  id="image" class="block mt-1 w-full bg-slate-300"
                        type="file"
                        name="image"/>
        
    </div>
    
    <div class="flex items-center justify-center mt-4">
        <x-button class="submit-btn ml-4">
            {{$title}}
        </x-button>
    </div>
</form>