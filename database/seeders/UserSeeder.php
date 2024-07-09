<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKey;
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       # User::factory(10)->create([
       #    'name' => 'Test User',
       #     'email' => 'test@example.com',
       #]);
        $this->disableForeignKey(); # disable foregn key checks for truncating
        $this->truncate('users'); # disable repeated migrations during every seeding
        User::factory(10)->create();
        $this->enableForeignKey(); # reanable foregn key checks

    }
}
