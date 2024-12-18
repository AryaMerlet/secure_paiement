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

        $testuser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@secure.com',
            'password' => 'T&s7U53rt&s7'
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@secure.com',
            'password' => 'P@ssw0rd1337'
        ]);

        Card::factory()->count(30)->create();
        Paiement::factory()->count(50)->create();

        Bouncer::allow('admin')->to('retrieve',Paiement::class);
        Bouncer::allow('admin')->to('refund',Paiement::class);
        Bouncer::allow('admin')->to('retrieve',Card::class);


        Bouncer::assign('admin')->to($admin);

        Bouncer::allow('user')->to('retrieve',Paiement::class);
        Bouncer::allow('user')->to('create',Paiement::class);
        Bouncer::allow('user')->to('retrieve',Card::class);
        Bouncer::allow('user')->to('create',Card::class);
        Bouncer::allow('user')->to('delete',Card::class);
        Bouncer::allow('user')->to('update',Card::class);

        Bouncer::assign('user')->to($testuser);
    }
}
