<?php

use Illuminate\Database\Seeder;
use App\Models\Seed;
use Database\Seeders\ImportCountriesSeeder;
use Database\Seeders\ImportStatesSeeder;

class DatabaseSeeder extends Seeder
{
    protected $seedFiles = [
        ImportCountriesSeeder::class,
        ImportStatesSeeder::class,
    ];

    public function run()
    {
        foreach ($this->seedFiles as $seedFile) {
            // check if this seed exists in table or not
            $exists = Seed::whereName($seedFile)->first();

            if ($exists) {
                $this->command->info("Seed already executed, skipping file: $seedFile");
                continue;
            }

            // execute seed
            $this->call($seedFile);

            // generate record of execution
            Seed::create([
                'name' => $seedFile,
            ]);
        }
    }
}
