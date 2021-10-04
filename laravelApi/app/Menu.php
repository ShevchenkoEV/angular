<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
      'title',
      'path',
      'path_api',
      'type',
      'sort_order'
    ];

    public function getItemMenu($path)
    {
        return route($path);
    }
}
