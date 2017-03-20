<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    // 指定在微博模型中可以进行正常更新的字段 
    protected $fillable = ['content'];

    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
