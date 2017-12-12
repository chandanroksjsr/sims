<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgercards', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');                           
            $table->string('stocknumber');
            $table->foreign('stocknumber')
                    ->references('stocknumber')
                    ->on('supplies')
                    ->onDelete('cascade');
            $table->string('reference',100)->nullable();
            $table->string('receipt')->nullable();             
            $table->integer('receivedquantity')->default(0);
            $table->decimal('receivedunitprice')->default(0);
            $table->integer('issuedquantity')->default(0);
            $table->decimal('issuedunitprice')->default(0);
            $table->decimal('balancequantity',8,0)->default(0); 
            $table->string('daystoconsume',100)->default('N/A');
            $table->string('created_by');
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
        Schema::dropIfExists('ledgercards');
    }
}
