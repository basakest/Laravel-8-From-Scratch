<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 运行 php artisan db:seed 命令, 默认不会删除之前创建的记录
        // 如需删除之前的记录, 可以使用 php artisan migrate:fresh --seed 命令
        // 或者手动调用 Model 类下的 truncate() 方法来清空已有记录
        // Model 类的 __call 方法会去调用 Illuminate\Database\Eloquent\Builder 下的方法
        // Run a truncate statement on the table.
        User::truncate();
        Post::truncate();
        Category::truncate();

        // 如果 factory() 方法中指定了数字, 返回的是一个 collection
        // $user = User::factory(1)->create();
        // 这样 $user 是一个 model 类对象实例
        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family',
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work',
        ]);

        Post::create([
            'category_id' => $personal->id,
            'user_id'     => $user->id,
            'title'       => 'My Personal Post',
            'slug'        => 'my-personal-post',
            'excerpt'     => 'This is a personal post.',
            'body'        => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        ]);

        Post::create([
            'category_id' => $family->id,
            'user_id'     => $user->id,
            'title'       => 'My Family Post',
            'slug'        => 'my-family-post',
            'excerpt'     => 'This is a family post.',
            'body'        => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        ]);

        Post::create([
            'category_id' => $work->id,
            'user_id'     => $user->id,
            'title'       => 'My work Post',
            'slug'        => 'my-work-post',
            'excerpt'     => 'This is a work post.',
            'body'        => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
