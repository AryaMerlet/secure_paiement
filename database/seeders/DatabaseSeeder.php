<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Paiement;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        for ($i = 0; $i < 10; $i++){
            $user = User::factory()->create();
            Bouncer::assign('user')->to($user);
        }
        Card::factory()->count(20)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@secure.com',
            'password' => 'T&s7U53rt&s7'
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@secure.com',
            'password' => 'P@ssw0rd1337'
        ]);

        Bouncer::allow('admin')->to('retrieve',Paiement::class);
        Bouncer::allow('admin')->to('update',Paiement::class);
        Bouncer::allow('admin')->to('delete',Paiement::class);

        Bouncer::assign('admin')->to($admin);

        Bouncer::allow('user')->to('retrieve',Paiement::class);
        Bouncer::allow('user')->to('create',Paiement::class);
        Bouncer::allow('user')->to('update',Paiement::class);

        Bouncer::assign('user')->to($user);
    }
}
