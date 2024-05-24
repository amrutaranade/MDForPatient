<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportCountriesSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('seeders/countries.csv'); // Adjust the path as needed

        $countries = $this->csvToArray($csvFile);

        DB::table('countries')->insert($countries);
    }

    private function csvToArray($filename)
    {
        $csv = array_map('str_getcsv', file($filename));
        $fields = $csv[0];

        $data = [];
        foreach (array_slice($csv, 1) as $row) {
            $data[] = array_combine($fields, $row);
        }

        return $data;
    }
}
