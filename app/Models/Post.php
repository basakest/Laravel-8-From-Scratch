<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $published_at
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\Category|null $category
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static Builder|Post filter(array $filters)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereBody($value)
 * @method static Builder|Post whereCategoryId($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereExcerpt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUserId($value)
 * @property string|null $thumbnail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @method static Builder|Post whereThumbnail($value)
 * @mixin \Eloquent
 */
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
    // protected $fillable = ['title', 'excerpt', 'body', 'category_id', 'user_id', 'slug'];

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

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * To define a local scope in a model class, prefix an Eloquent model method with scope.
     *
     * @return void
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, function (Builder $query, string $search) {
            // $search is the first argument when calling when method
            // 这里需要将 where title 和 orWhere body 对应的部分用括号包成一部分
            // 否则下面 whereHas 对应的 exists 语句只会对 orWhere body 生效, 导致查询出与预期不符的数据
            $query->where(function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')->
                    orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function (Builder $query, string $category) {
            // $query->whereExists(function (\Illuminate\Database\Query\Builder $query) use ($category) {
            //     $query->from('categories')
            //         ->whereColumn('categories.id', '=', 'posts.category_id')
            //         ->where('slug', $category);
            // });
            $query->whereHas('category', function (Builder $query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, function (Builder $query, string $author) {
            $query->whereHas('author', function (Builder $query) use ($author) {
                $query->where('username', $author);
            });
        });
        // Scopes should always return the same query builder instance or void
        // query scope will auto return the query builder?
    }
}
