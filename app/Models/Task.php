<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Category;


class Task extends Model
{
    use SoftDeletes; use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'description', 'created_by', 'updated_by', 'deleted_by'];

    // Relasi banyak ke satu dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi banyak ke satu dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
