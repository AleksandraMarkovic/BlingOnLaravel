<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function getGrade($id){
        return \DB::table('grades')
            ->where('product_id', $id)
            ->where('user_id', session('user')->user_id)
            ->first();
    }
}
