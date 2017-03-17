<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(200)->make();
        User::insert($users->toArray()); // 将生成假用户列表数据批量插入到数据库中

        $user = User::find(1);
        $user->name = 'Symon';
        $user->email = '778022227@qq.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->save();
    }
}
