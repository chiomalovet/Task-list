<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\RequestException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| 
*/



Route::get('/', function (){
    return redirect()->route("tasks.index");
});

Route::get('/tasks', function ()  {
    return view('index',
    ["tasks" => Task::latest()->paginate(10)
]);
})->name("tasks.index");

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get("/tasks/{task}/edit", function(Task $task) { 
    return view("edit", [
        'task'=> $task
    ]);
})->name("tasks.edit");

Route::get("/tasks/{task}", function(Task $task) { 
    return view("show", [
        'task'=> $task
    ]);
})->name("tasks.show");

Route::post('/tasks', function (TaskRequest $request){
$task= Task::create($request->validated());
// creating a new data for the database and then it shows in the show page

return redirect()->route('tasks.show', ['task'=> $task->id])->with('success', 'Creating a new Task is successful');
// sucess above is the variable while the second parameter is the value for creating a flash message
// the id => $task->id is where we pass what the user have typed in the form so that any new data can be displayed in the show page
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request){

    $task->update($request->validated());
    // creating a new data for the database and then it shows in the show page
    

    return redirect()->route('tasks.show', ['task'=> $task->id])->with('success', 'Updating a new Task is successful');
    // sucess above is the variable while the second parameter is the value for creating a flash message
    // the id => $task->id is where we pass what the user have typed in the form so that any new data can be displayed in the show page
    })->name('tasks.update');

    Route::delete('/tasks/{task}', function (Task $task){
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task has been deleted successfully');
    })->name('tasks.destory');

    Route::put('/tasks/{task}/toggle-completed', function (Task $task){
$task->toggleCompleted();
return redirect()->back()->with('sucess', ' You have Completed this task');
    })->name('tasks.toggle-complete');