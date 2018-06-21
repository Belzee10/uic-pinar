<?php

use Illuminate\Database\Seeder;

class IpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['PCC', 'UJC', 'CDR', 'FMC', 'CTC', 'DC', 'UM', 'MTT', 'BPD', 'ACRC'];

        for ($i=0; $i < 10; $i++) { 
            DB::table('ips')->insert([
                'nombre' => $array[$i]
            ]);
        }
    }
}
