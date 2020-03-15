<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    public function posts() {
        return $this->hasMany('App\Post');
    }
    public function messages() {
        return $this->hasMany('App\Message');
    }
    public function likes() {
        return $this->hasMany('App\Like');
    }
    public function friends() {
        return $this->hasMany('App\Friend','user1');
    }
}
