<?php

namespace App\Model;

use App\Model\Category;
use App\Model\Reply;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['title', 'slug', 'body', 'user_id', 'category_id'];

    protected $with = ['replies'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPathAttribute(){
        return "question/$this->slug";
    }
}
