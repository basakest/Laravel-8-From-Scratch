<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

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
    protected $fillable = ['title', 'excerpt', 'body', 'category_id', 'user_id', 'slug'];

    /**
     * The relations to eager load on every query.
     *
     * @var string[]
     */
    protected $with = ['author', 'category'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; // TODO: Change the autogenerated stub
    }

    /**
     * 直接调用该方法, 返回的是一个 BelongsTo 类的实例
     * 如果直接访问 category 属性, 会调用对应的魔术方法, 返回一个 Category 类的实例
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * To define a local scope in a model class, prefix an Eloquent model method with scope.
     *
     * @return void
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            // $search is the first argument when calling when method
            $query->where('title', 'like', '%' . $search . '%')->
                orWhere('body', 'like', '%' . $search . '%');
        });
        // Scopes should always return the same query builder instance or void
        // query scope will auto return the query builder?
    }
}
