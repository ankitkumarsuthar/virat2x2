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

            $record1                 = Level::find(1);
            $record1->level_payment   = $this->data['level_title_0'];
            $record1->level_gift      = $this->data['level_gift_0'];
            $record1->save();
            
            $record2                 = Level::find(2);
            $record2->level_payment   = $this->data['level_title_1'];
            $record2->level_gift      = $this->data['level_gift_1'];
            $record2->save();

            $record3                 = Level::find(3);
            $record3->level_payment   = $this->data['level_title_2'];
            $record3->level_gift      = $this->data['level_gift_2'];
            $record3->save();

            $record4                 = Level::find(4);
            $record4->level_payment   = $this->data['level_title_3'];
            $record4->level_gift      = $this->data['level_gift_3'];
            $record4->save();

            $record5                 = Level::find(5);
            $record5->level_payment   = $this->data['level_title_4'];
            $record5->level_gift      = $this->data['level_gift_4'];
            $record5->save();

            $record6                 = Level::find(6);
            $record6->level_payment   = $this->data['level_title_5'];
            $record6->level_gift      = $this->data['level_gift_5'];
            $record6->save();

            $record7                 = Level::find(7);
            $record7->level_payment   = $this->data['level_title_6'];
            $record7->level_gift      = $this->data['level_gift_6'];
            $record7->save();

            $record8                 = Level::find(8);
            $record8->level_payment   = $this->data['level_title_7'];
            $record8->level_gift      = $this->data['level_gift_7'];
            $record8->save();

            $record9                 = Level::find(9);
            $record9->level_payment   = $this->data['level_title_8'];
            $record9->level_gift      = $this->data['level_gift_8'];
            $record9->save();

            $record10                 = Level::find(10);
            $record10->level_payment   = $this->data['level_title_9'];
            $record10->level_gift      = $this->data['level_gift_9'];
            $record10->save();

            return true;

        } else if ($this->operation == 'delete') {            
        }
    }
}
