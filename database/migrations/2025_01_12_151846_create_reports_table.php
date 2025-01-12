<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // معرف البلاغ
            $table->foreignId('report_type_id')->constrained('report_types')->onDelete('cascade'); // مفتاح أجنبي لربط نوع البلاغ
            $table->enum('priority', ['High', 'Medium', 'Low']); // مدى أهمية البلاغ
            $table->string('title'); // اسم البلاغ
            $table->text('message'); // رسالة البلاغ
            $table->json('attachments')->nullable(); // مرفقات البلاغ
            $table->timestamps(); // حقول created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
