<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dw_fact_sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->foreign('customer_id')->references('id')->on('dw_dim_customers')->onDelete('cascade')->onUpdate("restrict");

            $table->string('channel_id');
            $table->foreign('channel_id')->references('id')->on('dw_dim_channels')->onDelete('cascade')->onUpdate("cascade");

            $table->string('date_id');
            $table->foreign('date_id')->references('id')->on('dw_dim_dates')->onDelete('cascade')
                ->onUpdate("restrict");

            $table->string('product_id');
            $table->foreign('product_id')->references('id')->on('dw_dim_products')->onDelete('cascade')->onUpdate("cascade");


            $table->string('brand_id');
            $table->foreign('brand_id')->references('id')->on('dw_dim_brands')->onDelete('cascade')->onUpdate("cascade");

            $table->integer("price_sale");
            $table->integer("capital_price");
            $table->integer("quantity");
            $table->integer("total_sale");
            $table->integer("capital_total");
            $table->integer("profit");
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
        Schema::dropIfExists('dw_fact_sales');
    }
};
