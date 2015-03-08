<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RazonSocialUniqueIndex extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE `proveedor` ADD UNIQUE INDEX `razon_social_UNIQUE` (`razon_social` ASC)");
		DB::statement("ALTER TABLE `cliente` ADD UNIQUE INDEX `razon_social_UNIQUE` (`razon_social` ASC)");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
