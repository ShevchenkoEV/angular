<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
           [
               'title' => 'Main admin page',
               'path' => 'main.page',
               'path_api' => '/admin/',
               'type' => 'admin',
               'sort_order' => 100,
           ],
            [
                'title' => 'Users',
                'path' => 'users.index',
                'path_api' => 'users',
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Посты',
                'path' => 'posts.index',
                'path_api' => 'posts',
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Категории',
                'path' => 'categories.index',
                'path_api' => 'categories',
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Меню',
                'path' => 'menus.index',
                'path_api' => 'menus',
                'type' => 'admin',
                'sort_order' => 100,
            ],
            [
                'title' => 'Главная страница',
                'path' => 'home',
                'path_api' => '/',
                'type' => 'admin',
                'sort_order' => 90,
            ],
            [
                'title' => 'Главная страница',
                'path' => 'home',
                'path_api' => '/',
                'type' => 'front',
                'sort_order' => 90,
            ],
        ]);
    }
}
