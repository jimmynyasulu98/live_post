<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    use TruncateTable, DisableForeignKey;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKey(); # disable foregn key checks for truncating
        $this->truncate('comments'); # disable repeated migrations during every seeding
        Comment::factory(4)->create();
        $this->enableForeignKey(); # reanable foregn key checks
    }
}
