<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $query = <<<EOT
        CREATE PROCEDURE insertLog(IN user_id INT, IN status varchar(20))
        BEGIN
            INSERT INTO logs (`user_id`,`status`, `created_at`, `updated_at`) VALUES (user_id, status, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP); 
        END
        EOT;

        DB::unprepared($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $query = 'DROP PROCEDURE IF EXISTS insertLog';
        DB::unprepared($query);
    }
};
