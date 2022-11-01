<x-app-layout>
  <x-slot name="title">{{ __('Members') }}</x-slot>
    <x-slot name="header">
            <a href="{{route('register')}}" class=" items-center px-4 py-3  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Register Member</a>
            <form class="" action="{{route('members.search')}}" method="GET">
                <div class="flex">
                    <x-input id="search" placeholder="Search by name" class="w-36 " type="text" name="search" required autofocus />
                    <x-button class="ml-4">
                        {{ __('search') }}
                    </x-button>
                </div>        
            </form>
    </x-slot>

    

    @if (session()->has('message'))
        <div class="fixed w-full top-28 animate-hide">
            <x-successMessage />
        </div>
    @endif  

    <div class="py-12 ">
        <div class="max-w-7xl  mx-auto sm:px-2 lg:px-8">
            <div class="bg-white   overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2   ">

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
                              Name
                            </th>
                            <th
                              class="px-4 py-2 border-r-2 text-left bg-blue-900 text-white text-sm font-bold"
                            >
                              Email
                            </th>
                            <th
                              class="px-4 py-2 border-r-2 text-left bg-blue-900 text-white text-sm font-bold"
                            >
                              Username
                            </th>
                            @can('isSuperAdmin')
                              <th
                              class="px-4 py-2 border-r-2 text-left bg-blue-900 text-white text-sm font-bold"
                            >
                              Role
                            </th>
                            @endcan
                           
                            <th
                              class="w-4  px-4 py-2 text-left bg-blue-900 text-white text-sm font-bold"
                            >
                              Options
                            </th>
                          </tr>
                        </thead>
                        <tbody>

                          @if ($data->count() === 0)
                              <tr  class="border-gray-300  box-border even:bg-gray-300 hover:bg-blue-200">
                                      <td colspan="6" rowspan="3" class=" text-center px-0 py-2 text-6xl  ">No record found</td>        
                              </tr>
                          @else
                            @php
                                // perPage() is paginator function
                                $pp = $data->perPage()
                            @endphp
                            @foreach ($data as $key => $user)
                              <tr class="border-gray-300 box-border even:bg-gray-300 hover:bg-blue-200">
                                      {{-- perPage() and currentPage() are paginator functions --}}
                                      <td class="w-min text-center px-0 py-2 text-sm"> {{($data->perPage() * $data->currentPage()) - (--$pp) }}</td>
                                      <td class="px-4 py-4 border-x-2 border-gray-100 text-sm">{{$user->name}}</td>
                                      <td class="px-4 py-4 border-r-2 border-gray-100 text-sm">{{$user->email}}</td>
                                      <td class="px-4 py-4 border-x-2 border-gray-100 text-sm">{{$user->username}}</td>
                                      @can('isSuperAdmin')
                                        <td class="px-4 py-4 border-r-2 border-gray-100 text-sm">{{$user->role->role}}</td>
                                      @endcan
                                      <td class=" px-4 py-4 text-sm">

                                          <x-option :toltip="'Edit'"  :icon="'far fa-edit'" :route="route('member.edit',['id'=>$user->id])" /> 

                                          <x-option :toltip="'delete'"  :icon="'far fa-trash-alt'" :route="route('member.delete', ['id'=>$user->id])" /> 
                                      </td>  
                                </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $data->links('pagination::tailwind') }}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>