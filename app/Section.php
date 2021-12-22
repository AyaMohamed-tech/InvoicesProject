<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
      'section_name',
      'description',
      'Created_by',
    ];


    public function products()
    {
        return $this->hasMany('App\Porduct','section_id','id');
    }

   
}
