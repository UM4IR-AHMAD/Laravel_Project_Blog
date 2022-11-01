@if (session('message'))
    <div class=" flex space-x-2 items-center border-2 border-green-500  px-4 py-2 h-fit bg-green-200 rounded-md">
        <span class="text-green-500 text-3xl "><i class="far fa-check-circle"></i></span>
        <span class="">{{session('message')}}</span>
    </div>
@endif
    
