<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title','is_todo_done','user_id'];

    /**
     * Get the user related to the todos.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
