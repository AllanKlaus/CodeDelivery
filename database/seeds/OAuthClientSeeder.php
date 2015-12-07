<?php

use \CodeDelivery\Models\OAuth;
use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OAuth::class)->create([
            'client_id' => 'appid01',
            'client_secret' => 'secret',
            'app' => 'Minha App Mobile',
        ])->save();
    }
}
