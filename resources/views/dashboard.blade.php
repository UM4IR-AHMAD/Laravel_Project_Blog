<x-app-layout>
    <x-slot name="title">{{ __('Dashboard') }}</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold capitalize text-xl text-gray-800 leading-tight">
            {{ __('welcome') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        <h1 class="text-4xl">{{ Auth::user()->name}}</h1>
                        <span class="uppercase">{{ Auth::user()->role->role}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" w-5/6 my-5 mx-auto flex flex-wrap justify-center gap-5">
       
        @can('isSuperAdmin')
            <x-dashboard-card class="bg-fuchsia-500" :icon="'fas fa-users'" :title="'Total Members'" :count="$totalUsers"/>
        @endcan

        @can('notAuthor')
            <x-dashboard-card class="bg-orange-500" :icon="'fa fa-shapes'" :title="'Total Categories'" :count="$totalCategories"/>
        @endcan
       
        <x-dashboard-card class="bg-purple-500" :icon="'fas fa-th-list'" :title="'Total Posts'" :count="$totalPosts"/>
        
        <x-dashboard-card class="bg-amber-500" :icon="'fas fa-eye'" :title="'Total Views'" :count="$totalViews"/>
        <x-dashboard-card class="bg-pink-500" :icon="'fas fa-th-list'" :title="'Your Posts'" :count="$yourPosts"/>
        <x-dashboard-card class="bg-lime-500" :icon="'fas fa-eye'" :title="'Your Views'" :count="$yourViews"/>

    </div>
</x-app-layout>
