<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Task extends Model
{
    protected $fillable=['title','description','priority','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_task');
    }

    public function users(){
        return $this->belongsToMany(User::class,'favorites');
    }
}
