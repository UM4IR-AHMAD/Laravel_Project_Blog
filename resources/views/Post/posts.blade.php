<x-app-layout>
  <x-slot name="title">{{ __('Posts') }}</x-slot>
    <x-slot name="header">
          <div class=" items-left  font-semibold text-xs text-white uppercase tracking-widest ">

            <a href="{{route('posts')}}" class="inline-block  px-4 py-3  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase  hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">All</a>
            
            @can('notAuthor')
              <a href="{{route('posts.mine')}}" class="inline-block px-4 py-3  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Mine</a>
            @endcan

            <a href="{{route('post.create')}}" class="inline-block px-4 py-3  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create New </a>
          </div>

          <div>
            <form class="" action="{{route('posts.search')}}" method="GET">
              <div class="flex">
                  <div  class = 'rounded-md border-2 shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'>

                    <input id="search" placeholder="Search by" class="border-0 focus:ring-0 focus:ring-gray-600 " type="text" name="search" value="{{old('search')}}" required autofocus />

                    <select id="search_by" name="search_by" class="focus:ring-0 border-0 border-l-2 ">
                          <option value="title" {{ (old('search_by') == 'title') ? 'selected' : '' }} >Title</option>
                          <option value="category" {{ (old('search_by') == 'category') ? 'selected' : '' }}>Category</option>
          
                          @can('notAuthor')
                            <option value="user" {{ (old('search_by') == 'user') ? 'selected' : '' }}>Author</option>Author</option>
                          @endcan

                    </select>

                </div>

                    <x-button class="ml-4">
                        {{ __('search') }}
                    </x-button>
              </div>        
            </form>
          </div>          
            
    </x-slot>

    
    @if (session()->has('message'))
        <div class="fixed w-full top-28 animate-hide">
            <x-successMessage />
        </div>
    @endif  

    <div class="px-12 mt-12  mx-auto sm:px-2 lg:px-8">
       <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-2">
                    <table class="w-full table-auto rounded-sm">
                        <thead>
                          <tr class="box-border text-white">
                            <th class="  py-2  bg-blue-900  text-center text-sm font-bold">
                              #
                            </th>
                            <th class="px-4 py-2 border-x-2 text-left bg-blue-900  text-sm font-bold">
                              Title
                          </th>
                          <th class="px-4 py-2 border-r-2 text-center bg-blue-900  text-sm font-bold">
                            Image
                          </th>
                            <th class="px-4 py-2 border-r-2 text-center bg-blue-900  text-sm font-bold">
                              views
                            </th>
                              <th class="px-4 py-2 border-r-2 text-center bg-blue-900  text-sm font-bold">
                              Category
                            </th>
                            <th class="px-4 py-2 border-r-2 text-center bg-blue-900  text-sm font-bold">
                            Author
                          </th>

                            <th class="w-4  px-4 py-2 text-left bg-blue-900  text-sm font-bold">
                              Options
                            </th>
                          </tr>
                        </thead>
                        
                        <tbody >
                          @if ($data->count() === 0)
                              <tr  class="border-gray-300  box-border even:bg-gray-300 hover:bg-blue-200">
                                      <td colspan="6" rowspan="3" class=" text-center px-0 py-2 text-6xl  ">No record found</td>        
                              </tr>
                          @else
                              @php
                                  # perPage() is paginator function
                                  $pp = $data->perPage()
                              @endphp
                              @foreach ($data as $key => $item)
                                          <tr class="border-gray-300 box-border even:bg-gray-300 hover:bg-blue-200">
                                            
                                            {{-- count number --}}
                                            <td class="text-center  px-2 py-2 text-sm"> {{($data->perPage() * $data->currentPage()) - (--$pp) }}</td>
                                            
                                            {{-- post title --}}
                                            <td class="w-2/5 px-4 py-2 border-x-2 border-gray-100 text-sm">
                                              <a href="{{ route('dashboard')}}">  
                                                {{$item->title}}
                                              </a>
                                            </td>

                                            {{-- post image --}}
                                              <td class="px-4 py-2 border-x-2 border-gray-100 text-sm">
                                                <img class="h-10 mx-auto w-10" src=" {{ $item->getFirstMedia('posts')->getUrl('thumb') }}" alt="">
                                              </td>

                                              {{-- post view --}}
                                              <td class="px-4 py-2 text-center border-r-2 border-gray-100 text-sm">{{$item->views}}</td>

                                              {{-- post category --}}
                                              <td class="px-4 py-2 text-center border-r-2 border-gray-100 text-sm">{{$item->category->category}}</td>
                                              
                                              {{-- post author --}}
                                              <td class="px-4 py-2 text-center border-r-2 border-gray-100 text-sm">{{$item->user->name}}</td>

                                              {{-- opetions --}}
                                              <td class=" px-3 py-2 text-sm">
                                                 

                                                  <x-option :toltip="'Edit'"  :icon="'far fa-edit'" :route="route('post.edit',['id'=>$item->id])" /> 

                                                  <x-option :toltip="'delete'"  :icon="'far fa-trash-alt'" :route="route('post.delete', ['id'=>$item->id])" /> 

                                                  <x-option :toltip="'View'"  :icon="'far fa-eye'" :route="route('blog.post.show', ['id'=> $item->id])" /> 
                                              </td>  
                                          </tr>
                              @endforeach
                            @endif
                        </tbody> 
                    </table>
                     
                    <div class="mt-3">
                        {{ $data->links('pagination::tailwind') }}

                        {{-- trying to check how to use pagination functions
                        @if ($data->hasPages())
                            <h4>{{$data->firstItem()}}</h4>
                        @endif --}}
                    </div>
             </div>
        </div> 
    </div>


</x-app-layout>