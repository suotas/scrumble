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
            $table->string('card_name');
            $table->integer('seq');
            $table->date('deadline')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->foreignId('kanban_id')->constrained('kanbans');
            $table
                ->foreignId('assignee_id')
                ->constrained('users')
                ->nullable(true);
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
