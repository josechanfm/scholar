<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'key' => 'grades',
            'value' => '[{"value":"P1","label":"P1"},{"value":"P2","label":"P2"},{"value":"P3","label":"P3"}]',
        ]);
        DB::table('configs')->insert([
            'key' => 'student_state',
            'value' => '{"ACT": "Active","RES": "Resigned"}',
        ]);
        DB::table('configs')->insert([
            'key' => 'stream',
            'value' => '{"ART":"Art Stream","SCI":"Science Stream}',
        ]);
        DB::table('configs')->insert([
            'key' => 'year_creation',
            'value' => '{ "kgrade":3, "kklass":3, "kgradeDefault":0, "kklassDefault":0, "pgrade":6, "pklass":5, "pgradeDefault":6, "pklassDefault":4, "sgrade":6, "sklass":5, "sgradeDefault":6, "sklassDefault":4, }',
        ]);
        // DB::table('configs')->insert([
        //     'key' => 'current_year',
        //     'value' => 1,
        // ]);
        DB::table('configs')->insert([
            'key'=>'score_columns',
            'value' =>'[{"REG":"平時分"},{"TST":"測驗分"},{"CLS":"課堂表現"},{"EXM":"考試分"}]'
        ]);
    }
}
