@extends('layout.app')

@section('title', $task->title )

@section("content")
<div class="mb-4 ">
    <a href="{{route('tasks.index')}}" class="link">
        ← Go Back To The List</a>
</div>
{{-- <h1> {{$task->title}} </h1> --}}
<p class="mb-4 text-slate-700"> {{$task->description}} </p>

@if($task->long_description)
    <p class="mb-4 text-slate-700"> {{$task->long_description}} </p>
@else
<p class="mb-4 text-slate-700"> {{"There is no long decription for the task"}} </p>
@endif

<p class="mb-4 text-sm text-slate-500">
     Created {{$task->created_at->diffForHumans()}} • Updated {{$task->updated_at->diffForHumans()}}</p>

<p>
    
@if ($task->completed)
<span class="text-medium text-green-500">Sucessfully completed</span>

 @else
 <span class="text-medium text-red-500"> Not Completed</span>
   
@endif
</p>

<div class="flex">
    <a href="{{route('tasks.edit', ['task'=>$task]) }}" 
        class="btn">Edit</a>

    <form action="{{route('tasks.toggle-complete', ['task' => $task])}}" method="post">
        @csrf
        @method('PUT')
    <button type="submit" class="btn">
        Mark as {{$task->completed ? 'completed': 'not completed'}}
    </button>
    </form>

    <form action="{{route('tasks.destory', ['task' => $task]) }}" method="post">
    @csrf
    @method('DElETE')

    <button type="submit" class="btn">DELETE</button>
    </form>
</div>
@endsection