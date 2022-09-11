<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SnailLog;
use Carbon\Carbon;

class SnailLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds. This method is for testing the database connection.
     * It populates the database with mock data. Note that this method also resets
     * the table every time it is called, deleting all the data. 
     *
     * @return void
     */
    public function run()
    {
        //This resets the table, deletes all data
        SnailLog::truncate();

        //Creation of rows with mock data
        DB::table('snail_logs')->insert([
            'DATE' => Carbon::now(),
            'H' => 6,
            'U' => 3,
            'D' => 1,
            'F' => 10,
            'result' => 'success on day 3',
        ]);
        DB::table('snail_logs')->insert([
            'DATE' => Carbon::now(),
            'H' => 10,
            'U' => 2,
            'D' => 1,
            'F' => 50,
            'result' => 'failure on day 4',
        ]);
    
    }
}
