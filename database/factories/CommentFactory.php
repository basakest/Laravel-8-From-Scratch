<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body'    => $this->faker->paragraph(),
            // factory 方法后不需要再接上 create 的调用, 加上的话即时调用 factory()->create([]) 时指定了属性, 也会被覆盖
            // 具体的一个体现就是批量生成数据时产生了如下报错
            // SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'architecto' for key 'categories.categories_name_unique'
            // 'post_id' => Post::factory()->create(),
            // 'user_id' => User::factory()->create(),
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
        ];
    }
}
