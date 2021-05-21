<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body'
    ];

    //Function format will be used to confirm if user have submitted form already for pluralforms.. 
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id',$user->id);
    }
    // Since PostPolicy exists already..
    // public function ownedBy(User $user)
    // {
    //     return $user->id === $this->user_id;
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
