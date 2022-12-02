<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'laravel-todos';
    protected $fillable = [
        'title',
        'date',
        'description',
        'status',
        'user_id',
        'done_date',
    ];
}
