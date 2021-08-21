<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoValidationRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller {


    public function index($userId) {
        
        return Todo::where('user_id', $userId)
                    ->orderByRaw('created_at DESC')
                    ->get();
    }

    public function store(TodoValidationRequest $request) {

        $request->validated();
        Todo::create($request->all());
    }

    public function update(Request $request) {

        $updatedTodo = Todo::find($request->todo);
        
        if(is_null($request->state)) {$request = new TodoValidationRequest();}
        
        $updatedTodo->update($request->all());
        $updatedTodo->save();
    }
    
    public function destroy($userId,$todo){
        
        $deletedTodo = Todo::find($todo);
        $deletedTodo->delete();
        return $this->index($userId);
    }
    
}
