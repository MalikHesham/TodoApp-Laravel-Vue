<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoValidationRequest;
use App\Models\Todo;

class TodoController extends Controller {



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoValidationRequest $request) {

        $request->validated();

        Todo::create($request->all());
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoValidationRequest $request, $todo) {

        $updatedTodo = Todo::find($todo);
        $updatedTodo->update($request->all());
        $updatedTodo->save();
    }
}
