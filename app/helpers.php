<?php

use App\Models\{
    Guru,
    Kelas,
    Pengguna,
    Log
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('insertLog')) {
    function insertLog($status)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'status' => $status
        ];

        Log::create($data);
    }
}

if (!function_exists('crudLog')) {
    function crudLog($tableName, $parameterValue)
    {
        $sql = <<<SQL
            CREATE TRIGGER your_trigger_name BEFORE INSERT ON $tableName
            FOR EACH ROW
            BEGIN
                -- Trigger logic here
                -- You can use the session variable as a parameter
                -- ...

                SET @your_parameter = "$parameterValue";
                -- Use the @your_parameter session variable in the trigger logic
                -- ...
            END
        SQL;

        return dd($sql);
        DB::statement($sql);

    }
}
