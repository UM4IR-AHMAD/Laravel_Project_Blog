@props(['value', "data"])


{{-- 
    use this logic to fetch id and selection names from any array.
    In this project I have two arrays used here Roles and Categories.
 --}}
@php $keys = array_keys($data[0]); @endphp {{-- fetch key array --}}

{{-- {{ $disabled}} --}}
{{-- {{ ($value == 'super admin') ? 'disabled' : '' }}  --}}
<select 
{{$attributes ->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'])}} >
    <option value= '' > -- select --</option>
    @foreach ($data as $items)
        <option value= {{ $items[$keys[0]]}} {{ ($value == $items[$keys[0]]) ? 'selected' : '' }} > {{ $items[$keys[1]]}}</option>
    @endforeach
</select>
