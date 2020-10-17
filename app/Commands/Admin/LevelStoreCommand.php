<?php

namespace App\Commands\Admin;

use Illuminate\Console\Command;
use App\DB\User;
use App\DB\Level;
use Carbon\Carbon;
use Sentinel;

class LevelStoreCommand extends Command
{
    public $data;
    public $request;
    public $operation = 'new';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
    public function __construct($data, $request, $operation = 'new')
    {
        $this->data = $data;
        $this->request = $request;
        $this->operation = $operation;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $user = Sentinel::getUser();

        if ($this->operation == 'new') {           


        } else if ($this->operation == 'edit') {
            // dd($this->data);
            $level_array = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,16,18,19,20,21,22,23,24,25,26,27,28,29,30];

            foreach ($level_array as $key => $level) {
                $level_title = 'level_title_'.$level;
                $level_gift = 'level_gift_'.$level;
                $record                 = Level::find($level);
                if(!empty($this->data[$level_title]))
                {
                    $record->level_payment   = $this->data[$level_title];
                } 
                if(!empty($this->data[$level_gift]))
                {                    
                    $record->level_gift      = $this->data[$level_gift];
                } 
                $record->save();
            }
            // dd('save');
            return true;

        } else if ($this->operation == 'delete') {            
        }
    }
}
