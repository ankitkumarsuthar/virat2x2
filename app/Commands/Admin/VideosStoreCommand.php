<?php

namespace App\Commands\Admin;

use Illuminate\Console\Command;
use App\DB\User;
use App\DB\Videos;
use Carbon\Carbon;
use Sentinel;

class VideosStoreCommand extends Command
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
            $record1                 = Videos::find(1);
            $record1->video_link   = $this->data['video_link_1'];            
            $record1->save();
            
            $record2                 = Videos::find(2);
            $record2->video_link   = $this->data['video_link_2'];            
            $record2->save();

            $record3                 = Videos::find(3);
            $record3->video_link   = $this->data['video_link_3'];            
            $record3->save();

            $record4                 = Videos::find(4);
            $record4->video_link   = $this->data['video_link_4'];            
            $record4->save();

            $record5                 = Videos::find(5);
            $record5->video_link   = $this->data['video_link_5'];            
            $record5->save();

            $record6                 = Videos::find(6);
            $record6->video_link   = $this->data['video_link_6'];            
            $record6->save();

            $record7                 = Videos::find(7);
            $record7->video_link   = $this->data['video_link_7'];            
            $record7->save();

            $record8                 = Videos::find(8);
            $record8->video_link   = $this->data['video_link_8'];            
            $record8->save();

            $record9                 = Videos::find(9);
            $record9->video_link   = $this->data['video_link_9'];            
            $record9->save();

            $record10                 = Videos::find(10);
            $record10->video_link   = $this->data['video_link_10'];            
            $record10->save();

            return true;

        } else if ($this->operation == 'delete') {            
        }
    }
}
