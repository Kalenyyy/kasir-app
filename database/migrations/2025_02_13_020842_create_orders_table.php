<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name_customer')->nullable();
            $table->json('products_id');
            $table->bigInteger('members_id')->nullable();
            $table->bigInteger('users_id');
            $table->dateTime('tanggal_penjualan');
            $table->integer('total_barang');
            $table->integer('total_harga');
            $table->integer('customer_pay');
            $table->integer('customer_return');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
