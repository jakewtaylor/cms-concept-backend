<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 possible users
        $users = User::factory(10)->create();

        // Create 5 organizations
        $organizations = Organization::factory(5)->create();

        // Give each organization a random 3 of the 10 users
        $organizations->each(function ($org) use ($users) {
            // Take 3 random users
            $syncIds = $users->random(3)
                // Pluck the ID
                ->pluck('id')
                // Map the pivot data
                ->mapWithKeys(function ($id, $key) {
                    return [$id => [
                        'owner' => $key === 0,
                    ]];
                });

            // Sync everything
            $org->users()->sync($syncIds);
        });
    }
}
