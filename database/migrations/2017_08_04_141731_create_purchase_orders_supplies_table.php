<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorders_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchaseorder_id')->unsigned();
            $table->foreign('purchaseorder_id')
                    ->references('id')
                    ->on('purchaseorders')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('date',100)->nullable();
            $table->integer('supply_id')->unsigned();
            $table->foreign('supply_id')
                    ->references('id')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->decimal('unitcost')->default(0);
            $table->integer('ordered_quantity')->default(0);
            $table->integer('received_quantity')->default(0);
            $table->integer('remaining_quantity')->default(0);
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
        Schema::dropIfExists('purchaseorders_supplies');
    }
}
