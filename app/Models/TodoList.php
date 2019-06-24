<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todolist';
    protected $fillable = ["name","completed"];
    protected $completed = false;
}
