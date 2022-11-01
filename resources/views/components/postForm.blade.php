@props(['method', 'title', 'route', 'categories'])




<form class="mx-auto w-5/6 " method="POST" action="{{ $route }}" enctype="multipart/form-data">
    @csrf
    @if ($method == 'put')
        @method('put')        
    @endif


   

    <!-- post_Id -->
    <x-input id="id"  class="block mt-1 w-full" type="hidden" name="id" :value="old('id') ? old('id') : 0 "  autofocus />

    <!-- Category -->
    <div class="mx-auto w-5/6  ">
        <x-label for="category" :value="__('Category')" />
        <x-select id="category" class="block mt-1 w-full" name="category_id" :value="old('category_id')" :data=$categories required />
    </div>

    <!-- Title -->    
    <div class="mt-4 mx-auto w-5/6 ">
        <x-label for="title" :value="__('Title')" />

        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"  />
    </div>



    <!-- Description -->
    <div class="mt-4  mx-auto w-5/6 relative">
        <x-label for="description" :value="__('Description')" />
        <textarea hidden name="description" id="description" required rows="10">
        </textarea>

        <div class="rounded-md bg-white shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <div id="quill-editor-container" >
                {!! old('description') !!}
            </div>
        </div>
        
    </div>
    

    <!-- Post Image -->
    <div class=" mt-4 mx-auto w-5/6">

        <x-label for="image" :value="__('Image')" />

        <x-input  id="image" class="block mt-1 w-full bg-slate-300"
                        type="file"
                        name="image"
        />
        
    </div>
 
   
    {{-- flex items-center w-5/6 justify-center mt-4 --}}
    <div class="w-5/6 mt-6 text-center mx-auto">
        <x-button class="w-2/4  h-10" type="submit" id="submit">
            {{ $title }}
        </x-button>
        <x-button :color='"bg-sky-800"' class="w-1/4   h-10" formaction="{{ route('post.preview') }}" formmethod="POST" type="submit" id="preview">
            Preview
        </x-button>
        <x-anchorButton :css="'px-4 py-3'" href="{{route('post.discart')}}" id="discart">
            {{ __('Discard') }}
        </x-anchorButton>

    </div>
</form>




