<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportStatesSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('seeders/states.csv'); // Adjust the path as needed

        $states = $this->csvToArray($csvFile);

        DB::table('states')->insert($states);
    }

    private function csvToArray($filename)
    {
        $csv = array_map('str_getcsv', file($filename));
        $fields = $csv[0];

        $data = [];
        foreach (array_slice($csv, 1) as $row) {
            // Skip rows where country_id is empty or not a valid integer
            $countryIdKey = array_search('country_id', $fields);
            if ($countryIdKey !== false && (!is_numeric($row[$countryIdKey]) || empty($row[$countryIdKey]))) {
                continue;
            }

            // Ensure row has the same number of elements as fields
            if (count($row) == count($fields)) {
                $data[] = array_combine($fields, $row);
            }
        }

        return $data;
    }
}
