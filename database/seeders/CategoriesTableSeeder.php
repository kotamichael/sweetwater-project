<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Candy Comments',
            'search_regexp' => '(?i)candy',
                'created_at' => '2025-09-06 04:03:04',
                'updated_at' => '2025-09-06 04:03:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Call-Me Comments',
            'search_regexp' => '(?i)\\b(call me|call me if|no phone call|call if|call when|call tomorrow|please call|please call me|call about|feel free to call|do not call|no calls|no phone calls|have [^ ]+ call|confirmation call)\\b',
                'created_at' => '2025-09-06 04:03:04',
                'updated_at' => '2025-09-06 04:03:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Referral Comments',
            'search_regexp' => '(?i)(referred|referral)',
                'created_at' => '2025-09-06 04:03:04',
                'updated_at' => '2025-09-06 04:03:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Signature Requirement Comments',
            'search_regexp' => '(?i)(signature)',
                'created_at' => '2025-09-06 04:03:04',
                'updated_at' => '2025-09-06 04:03:04',
            ),
        ));
        
        
    }
}