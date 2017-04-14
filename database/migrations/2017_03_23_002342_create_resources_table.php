<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', [
              'LINK',
              'MARKDOWN',
              'CODE'
            ]);
            
            $table->string('title');
            $table->string('description')->nullable();
            
            // Type LINK
            $table->string('link')->nullable();
            $table->string('link_type')->nullable();
            $table->string('link_image')->nullable();
            $table->string('link_author')->nullable();
            $table->datetime('link_date')->nullable();
            
            // Type MARKDOWN
            $table->text('markdown')->nullable();
            
            // Type CODE
            $table->text('code')->nullable();
            $table->string('code_type')->nullable();
            
            $table->integer('user_id');
            $table->enum('visibility', ['PUBLIC', 'SHARED', 'PRIVATE'])->default('PRIVATE');
            
            $table->integer('likes')->default(0);
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
        Schema::dropIfExists('resources');
    }
}
