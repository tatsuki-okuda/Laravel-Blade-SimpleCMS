<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * savingイベントでログイン情報を読み込むような処理をすると、
         * シーダーのコマンド実行時にもイベントが実行されてしまいエラーになります
         */
        \Event::fakeFor(function () {
            Post::factory()->count(50)->create();
        });
    }
}
