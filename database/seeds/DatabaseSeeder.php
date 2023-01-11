<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (DB::table('users')->count() == 0) {


            DB::table('users')->insert(
                ['name' => 'admin', 'password' => '$2y$10$fA8uqm0zXkD8w.vCmP.Qhenbtkx2b/7CjYjIhzPwn.vT4/cG/gEbG', 'email' => 'admin@admin',],


            );
            DB::table('users')->insert(
                ['name' => 'د حسن أبو جراد', 'password' => '$2y$10$fA8uqm0zXkD8w.vCmP.Qhenbtkx2b/7CjYjIhzPwn.vT4/cG/gEbG', 'email' => 'admin1@admin',],

            );
            DB::table('users')->insert(
                ['name' => 'د سهام أبو العمرين', 'password' => '$2y$10$fA8uqm0zXkD8w.vCmP.Qhenbtkx2b/7CjYjIhzPwn.vT4/cG/gEbG', 'email' => 'admin2@admin',]

            );

            DB::table('categories')->insert(
                ['ctg_name' => 'العلمية','user_id' => 1,]

            );
            DB::table('categories')->insert(
                ['ctg_name' => 'الإقتصادية','user_id' => 1,]

            );

            DB::table('journals')->insert([
                'jr_name' => 'جامعة غزة',
                'editorial_board' => 2,
                'editorial_board_vice' => 3,
                'user_id' => 1,
            ]);
            DB::table('folders')->insert([
                'fldr_no' => 1,
                'fldr_year' => 2023,
                'user_id' => 1,
            ]);
            DB::table('versions')->insert([
                'vr_no' => 1,
                'folder_id' => 1,
                'user_id' => 1,
            ]);
        }

    }
}
