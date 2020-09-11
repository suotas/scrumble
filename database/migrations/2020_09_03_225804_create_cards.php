<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('board_id')->constrained('boards');
            $table->foreignId('kanban_id')->constrained('kanbans');
            $table->string('card_name');
            $table->integer('card_seq');
            $table->date('card_deadline')->nullable();
            $table->longText('card_description')->nullable();
            $table
                ->foreignId('assignee_id')
                ->constrained('users')
                ->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards', function (Blueprint $table) {
            $table->dropForeign('cards_assignee_id_foreign');
        });
    }
}
