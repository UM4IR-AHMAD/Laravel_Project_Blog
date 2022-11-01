 @props(['errors'])


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class=" flex space-x-2 items-center border-2 border-red-500  px-4 py-2 h-fit bg-red-200 rounded-md">
            <span class="text-red-500 text-3xl "><i class="far fa-times-circle"></i></span>
                <span class="">{{$error}}</span>
        </div>
    @endforeach
@endif
