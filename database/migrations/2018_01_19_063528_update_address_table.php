<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('sub_district');
            $table->dropColumn('village');
        });
        Schema::table('address', function (Blueprint $table) {

            $table->string('city', 200)->nullable()->after('province');
            $table->string('sub_district', 200)->nullable()->after('city');
            $table->string('village', 200)->nullable()->after('sub_district');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
