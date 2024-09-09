<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = ['name', 'email', 'username','created_by', 'updated_by', 'deleted_by'];

    // Relasi satu ke banyak dengan Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

