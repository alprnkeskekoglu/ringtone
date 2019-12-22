<?php
namespace Dawnstar\Database\seeds;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        \Dawnstar\Models\Category::create([
            'status' => 1,
            'name' => 'Category 1',
            'slug' => 'category-1',
            'detail' => 'Nullam gravida mattis aliquet. Aenean at metus ',
        ]);
        \Dawnstar\Models\Category::create([
            'status' => 1,
            'parent_id' => 1,
            'name' => 'Category 2',
            'slug' => 'category-2',
            'detail' => 'Nullam gravida mattis aliquet. Aenean at metus ',
        ]);
    }
}
