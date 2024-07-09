<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKey{
    protected function disableForeignKey(){
        DB::statement('SET FOREIGN_KEY_CHECKS=0'); # disable foregn key checks for truncating
    }

    protected function enableForeignKey(){
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); # reanable foregn key checks
    }
}