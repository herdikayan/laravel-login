<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_post', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('post_title');
            $table->string('category');
            $table->string('image')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        /** gunakan script berikut jika ingin menambah data otomatis */
        $categories = ['Politik', 'Kesehatan', 'Olahraga'];
        for ($a = 1; $a <= 15; $a++)
            DB::table('tb_post')->insert([
                'post_title' => 'Judul Artikel ' . $a,
                'category' => $categories[array_rand($categories)],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_post');
    }
}
