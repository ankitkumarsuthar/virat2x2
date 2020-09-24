<?php

namespace App\Commands\User;

use Illuminate\Console\Command;
use App\DB\User;
use App\DB\UserMaster;
use Carbon\Carbon;
use Sentinel;

class UserAccountStoreCommand extends Command
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
    public function __construct($data, $request, $operation = 'new') {
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

        if($this->operation == 'new') {    

            
        } else if($this->operation == 'update_bank_detail') {

            $user = Sentinel::getUser();            

            $record                             = UserMaster::find($user['user_master_id']);
            $record->update_by                  = $user->id;
            $record->bank_beneficiary_name      = $this->data['bank_beneficiary_name'];
            $record->account_mumber             = $this->data['account_mumber'];
            $record->ifsc_code                  = $this->data['ifsc_code'];            
            $result                             = $record->save();

            return $result;

        } else if($this->operation == 'save_upi') {

            $user = Sentinel::getUser();            

            $record                             = UserMaster::find($user['user_master_id']);
            $record->update_by                  = $user->id;
            $record->upi_id                   = $this->data['upi_id'];          
            $result                             = $record->save();

            return $result;

        }  else if($this->operation == 'save_paytm') {

            $user = Sentinel::getUser();   

            // dd($this->data);         

            $record                             = UserMaster::find($user['user_master_id']);            
            $record->update_by                  = $user->id;
            $record->paytm_phone                = $this->data['paytm_phone']; 

            // dd($record);

            $result                             = $record->save();

            return $result;

        } else if($this->operation == 'delete') {
            $user = Sentinel::getUser();
            $record                     = User::find($this->data['id']);
            $record->delete_by          = $user->id;
            $record->save();

            $result = $record->delete();
            return $result;
        }
    }
}
