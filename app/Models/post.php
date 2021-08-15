<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $guarded = array('id');
    use HasFactory;
    public static $rules = array(
        'title' => 'required',
        'content' => 'required',
    );
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
