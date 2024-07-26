<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Giả định rằng bạn có bảng users
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('order_status')->default('Chờ xác nhận');
            $table->timestamp('order_date')->useCurrent();
            $table->integer('total_quantity');
            $table->decimal('total_money', 15, 2);
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
        Schema::dropIfExists('orders');
    }
}