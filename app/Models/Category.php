<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded=[];

    public function product()
    {
        return $this->hasMany('App\Models\Product', "parent_id", "id");
    }
}
