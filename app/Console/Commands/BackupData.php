<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackupData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BackupData:backupdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::connection('oracle2')->table('users')->delete();
        $data = DB::connection('oracle')->table('users')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('users')->insert($array);
        }

        DB::connection('oracle2')->table('comments')->delete();
        $data = DB::connection('oracle')->table('comments')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('comments')->insert($array);
        }

        DB::connection('oracle2')->table('config')->delete();
        $data = DB::connection('oracle')->table('config')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('config')->insert($array);
        }

        DB::connection('oracle2')->table('events')->delete();
        $data = DB::connection('oracle')->table('events')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('events')->insert($array);
        }

        DB::connection('oracle2')->table('galeries')->delete();
        $data = DB::connection('oracle')->table('galeries')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('galeries')->insert($array);
        }

        DB::connection('oracle2')->table('login_attempts')->delete();
        $data = DB::connection('oracle')->table('login_attempts')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('login_attempts')->insert($array);
        }

        DB::connection('oracle2')->table('migrations')->delete();
        $data = DB::connection('oracle')->table('migrations')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('migrations')->insert($array);
        }

        DB::connection('oracle2')->table('news')->delete();
        $data = DB::connection('oracle')->table('news')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('news')->insert($array);
        }

        DB::connection('oracle2')->table('password_resets')->delete();
        $data = DB::connection('oracle')->table('password_resets')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('password_resets')->insert($array);
        }

        DB::connection('oracle2')->table('publications')->delete();
        $data = DB::connection('oracle')->table('publications')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('publications')->insert($array);
        }

        DB::connection('oracle2')->table('regions')->delete();
        $data = DB::connection('oracle')->table('regions')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('regions')->insert($array);
        }

        DB::connection('oracle2')->table('rules')->delete();
        $data = DB::connection('oracle')->table('rules')->get();
        for ($i=0; $i < count($data); $i++) { 
          $array = (array) $data[$i];
          DB::connection('oracle2')->table('rules')->insert($array);
        }
    }
}
