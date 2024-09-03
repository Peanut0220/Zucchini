<x-app-layout>


@foreach($foods as $food)
    {{$food->name}}
@endforeach
</x-app-layout>
