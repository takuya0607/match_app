<?php

use Illuminate\Database\Seeder;

class ReactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      DB::table('reactions')->insert([
              // いいねをされた人
        ['to_user_id' => '1',
        'from_user_id' => '2',
        'status' => '0',
        ],
        ['to_user_id' => '1',
        'from_user_id' => '3',
        'status' => '0',
        ],
        ['to_user_id' => '1',
        'from_user_id' => '4',
        'status' => '0',
        ],
        ['to_user_id' => '1',
        'from_user_id' => '5',
        'status' => '0',
        ],
      ]);
    }
}
