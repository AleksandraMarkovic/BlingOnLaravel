<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function getMenu(){
        return \DB::table('menus')->orderBy('order')->get();
    }
}
