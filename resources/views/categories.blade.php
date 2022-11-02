<x-app-layout>
  <x-slot name="title">{{ __('Categories') }}</x-slot>
    <x-slot name="header">
       
            <a href="javascript:void(0);" class="items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
            onclick="

            showBlock();
            // hide errors
            hideErrors();

            document.querySelector('.selected-option').innerText = 'Add new category';
            ">Add category</a>

            

            <form class="" action="{{route('categories.search')}}" method="GET">
                <div class="flex">
                    <x-input id="search" placeholder="Search by category" class="w-36 " type="text" name="search" required autofocus />
                    <x-button class="ml-4" >
                        {{ __('search') }}
                    </x-button>
                </div>        
            </form>
    </x-slot>

   
    {{-- window for Add and update --}}
    <div class="add-category z-10 top-10 bottom-0 w-11/12 hidden fixed  bg-gray-100 ">
      <div class="selected-option block bg-white text-xl p-6">{{ session('update-fail') ?? 'Add new '}} category</div>

      <div class="show-errors inline-block">
        <x-validationErrors :errors="$errors" />
      </div> 
        <div class="w-2/4 mx-auto mt-28">
          <span class="block text-right hover:text-gray-500 cursor-pointer"
          onclick="
            hideBlock();
            clearForm();
          "><i class="fas fa-times"></i></span>
          <x-categoryForm title="{{ session('update-fail') ?? 'Add'}}" :action="session('action') ?? route('category.store')" />
        </div>
    </div>


    


   
    

    {{-- show success message --}}
    @if (session()->has('message'))
        <div class="fixed w-full top-28 animate-hide">
            <x-successMessage />
        </div>
    @endif

   
   
    <div class="py-12">
        <div class="max-w-7xl  mx-auto sm:px-2 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 relative">

                    <table class="w-full table-auto rounded-sm">
                        <thead>
                          <tr class="box-border">
                            <th
                              class="  py-2  bg-blue-900 text-white text-center text-sm font-bold"
                            >
                              #
                            </th>
                            <th
                              class="px-4 py-2 border-x-2 text-left bg-blue-900 text-white text-sm font-bold"
                            >
                              Category
                            </th>
                            <th
                            class="px-4 py-2 border-x-2  bg-blue-900 text-white text-sm font-bold"
                          >
                            Images
                          </th>
                            <th
                              class="w-4  px-4 py-2 text-left bg-blue-900 text-white text-sm font-bold"
                            >
                              Options
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                
                                        <tr class="relative box-border even:bg-gray-300 hover:bg-blue-200">
                                            <td class="w-min text-center px-0 py-2 text-sm">{{ $data->firstItem() + $key}}</td>
                                            <td class="px-4 py-2 border-x-2 border-gray-100 text-sm">{{$item->category}}</td>
                                            <td class="px-4 py-2 border-x-2 border-gray-100 text-sm w-40">
                                              <img class="h-20 mx-auto" src="{{$item->getFirstMedia('categories')->getUrl('thumb')}}" alt="">
                                            </td>

                                            <td class=" w-4 px-4 py-2 text-sm ">
                                                <a id={{$item->id}} class="relative after:absolute after:-top-4 after:-left-2 after:content-['Edit'] after:text-black after:font-bold after:invisible hover:after:visible hover:text-gray-700" href="javascript:void(0);" onclick="

                                                  // pass selected row data to Update form
                                                  let category = this.parentNode.parentNode.firstElementChild.nextElementSibling.innerText;
                                                  document.querySelector('#id').value = this.id;
                                                  document.querySelector('#category').value = category;

                                                  // show the form
                                                  showBlock();

                                                  // hide errors
                                                  hideErrors();
                                                  
                                                  // set form action and button value
                                                  document.querySelector('#form').action = '{{route('category.update')}}';
                                                  document.querySelector('.submit-btn').innerText = 'Update';


                                                  // set the update window Label
                                                  document.querySelector('.selected-option').innerText = 'Update category';
                                                  
                                                  // clear errors

                                                  "><i class="far fa-edit"></i></a>


                                                <a class="relative after:absolute after:-top-4 after:-left-2 after:content-['Delete'] after:text-black after:font-bold after:invisible hover:after:visible hover:text-gray-700" id="deletePost"  href="#" onclick="
                                                var deletationWindow = this.parentNode.nextElementSibling;
                                                deletationWindow.classList.toggle('left-full');
                                                deletationWindow.classList.toggle('left-0');
                                                "><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            <td class="absolute bg-gray-200 bg-opacity-70 p-2 w-full h-full border-2  left-full  whitespace-nowrap transition-all duration-300 ">
                                              <div class=" text-center w-max m-auto">
                                                <h2 class="mb-3 font-semibold">All Posts of this category will be removed</h2>
                                                <x-anchorButton :css="'px-3 py-2 hover:bg-rose-700'" href="{{route('category.delete', ['id'=>$item->id])}}" id="approve-deletation">
                                                  {{ __('delete') }}
                                              </x-anchorButton>
                                              <x-anchorButton  :css="'px-3 py-2 ml-2 bg-black'" href="#" id="cancel-deletation" onclick="
                                                var deletationWindow = this.parentNode.parentNode;
                                                deletationWindow.classList.toggle('left-full');
                                                deletationWindow.classList.toggle('left-0');                                              ">
                                                {{ __('cancel') }}
                                            </x-anchorButton>   
                                            </div>
                                          
                                          </td>  

                                        </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $data->links('pagination::tailwind') }}
                    </div>


                </div> 
            </div>
        </div>
    </div>

    

    <script>
      
      function showBlock() {
        document.querySelector('.add-category').style.display = 'block';
        document.body.style.overflowY = 'hidden';
      }

      function hideBlock() {
        document.querySelector('.add-category').style.display = 'none';
        document.body.style.overflowY = '';        
      }


      function hideErrors() {
        document.querySelector('.show-errors').style.display = 'none';
      }


      function clearForm() {
        document.querySelector('#id').value = '';
        document.querySelector('#category').value = '';
      }  

    </script>



    @if ($errors->any())
      <script>
        showBlock();
      </script> 
    @endif


</x-app-layout>


