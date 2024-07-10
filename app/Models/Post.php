<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $casts = [
        'body'=> 'array',
    ]; # cast body to array for easy converstion from json from DB to array

    protected $fillable = [
        'title',
        'body',
    ];

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'post_user', 'post_id' , 'user_id');
    }

    public function getTitleToUpperCaseAttribute(){ # Accessor to get uppercase title
            return strtoupper($this->title);
    }

    public function setTitleAttribute($value){ # Mutator to set lowercase title
        return $this->attributes['title'] = strtolower($value);
}

}
