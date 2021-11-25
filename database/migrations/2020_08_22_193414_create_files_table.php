<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            //$table->uuid('user_id');

            //$table->uuid('channel_id')->index();
           // $table->foreign('channel_id')
             //   ->references('id')->on('channels')
               // ->onDelete('restrict');

            $table->string('path');
            $table->string('client_file_name');
           $table->string('mime_type');
            $table->string('servername');
            //$table->enum('type', [FileType::VIDEO, FileType::THUMBNAIL]);

            $table->string('server_file_name');
            $table->string('url');
            //$table->json('info')->nullable();

            //$table->boolean('available')->default(false);

           // $table->string('job_last')->nullable();
           // $table->string('job_status_url', 2083)->nullable();
            //$table->string('job_message_id')->nullable();

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}

