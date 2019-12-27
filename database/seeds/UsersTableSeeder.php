<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = App\User::create([
        'name' => 'Administrator',
        'email' => 'admin@sharif-forum.com',
        'password' => bcrypt('Admin@123'),
        'admin' => 1
    ]);

        App\Profile::create([
            'user_id' => $user1->id,
            'avatar' => 'uploads/avatar/admin_avatar.jpg',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam autem consectetur culpa eum ipsa maiores molestiae molestias, nulla numquam pariatur provident reiciendis repellendus saepe sit totam vel veritatis vero!',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);

        $user2 = App\User::create([
            'name' => 'Ruba Sarmini',
            'email' => 'ruby@sarmini.com',
            'password' => bcrypt('pass123'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user2->id,
            'avatar' => 'uploads/avatar/default_avatar_f.png',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam autem consectetur culpa eum ipsa maiores molestiae molestias, nulla numquam pariatur provident reiciendis repellendus saepe sit totam vel veritatis vero!',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);

        $user3 = App\User::create([
            'name' => 'Adam Arabi',
            'email' => 'adam@gmail.com',
            'password' => bcrypt('pass123'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user3->id,
            'avatar' => 'uploads/avatar/default_avatar.png',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam autem consectetur culpa eum ipsa maiores molestiae molestias, nulla numquam pariatur provident reiciendis repellendus saepe sit totam vel veritatis vero!',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);
    }
}
