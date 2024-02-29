<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 如果将 guarded 设置为空, 将允许对任意字段进行批量赋值
    // protected $guarded = [];

    /**
     * 允许进行批量赋值的字段
     * updated_at 和 created_at 似乎不受该属性影响?
     *
     * @var string[]
     */
    protected $fillable = ['title', 'excerpt', 'body'];
}
