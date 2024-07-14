@extends('layout.app')

@section('title', 'The List Of Tasks')


@section("content")
{{-- @if(count($tasks)) --}}

<nav class="container mb-4">
    <a href="{{route('tasks.create')}}" 
    class="link">Create Task</a>
    
</nav>

@forelse ($tasks as $task)
    <div> 
    <a href="{{route('tasks.show', ['task' => $task->id ]) }}" 
        @class(['font-bold  line-through decoration-pink-500' => $task->completed])>{{$task->title}}</a> 
    </div>

    @empty 
<div>There are no Tasks!</div>

@endforelse
@if ($tasks->count())
<nav class="mt-4">
    {{$tasks->links()}}
</nav>

@endif
@endsection
{{-- @endif --}}