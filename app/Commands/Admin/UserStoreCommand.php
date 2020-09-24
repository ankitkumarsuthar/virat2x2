<?php

namespace App\Commands\Admin;

use Illuminate\Console\Command;
use App\DB\User;
use App\DB\UserMaster;
use Carbon\Carbon;
use Sentinel;

class UserStoreCommand extends Command
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
            // dd($this->data);

            try {
                
                

                 // dd($sponser_all_child_list);

                 // dd($sponser_child_llist);

                 // $sponser_detail = UserMaster::updateSponserLevel($this->data);
                 // dd('dead', $sponser_detail);
            
                \DB::transaction(function() {

                    if(!empty($this->data['user_sponser_id']))
                    {
                        // $sponser_detail = UserMaster::updateSponserLevel($this->data); 
                        $spnser_d = [];
                        $spnser_all = [];

                        $sponser_all_child_list = User::getUserChildList($this->data['user_sponser_id'],$spnser_d);
                        
                        // dd(count($sponser_all_child_list));

                        if(count($sponser_all_child_list) == 0)
                        {
                            $sponser_detail = UserMaster::where('self_sponsor_key', $this->data['user_sponser_id'])->first(); 
                            $sponser_detail['sponser_for_current_insert'] =  UserMaster::where('id', $sponser_detail['id'])->first(); 
                            $sponser_detail['result_data'] = $sponser_detail['id'];
                            $sponser_detail['left_insert'] = 1;
                            $sponser_detail['right_insert'] = NULL;

                        } elseif (count($sponser_all_child_list) == 1) {

                            $sponser_detail = UserMaster::where('self_sponsor_key', $this->data['user_sponser_id'])->first(); 
                            $sponser_detail['sponser_for_current_insert'] =  UserMaster::where('id', $sponser_detail['id'])->first(); 
                            $sponser_detail['result_data'] = $sponser_detail['id'];
                            $sponser_detail['left_insert'] = NULL;
                            $sponser_detail['right_insert'] = 1;

                        } else {
                             $sponser_detail = User::getAllChildFullDetail($sponser_all_child_list);
                        }

                        // if(!empty($sponser_all_child_list))
                        // {
                        //     $sponser_detail = User::getAllChildFullDetail($sponser_all_child_list);
                        //     dd($sponser_detail);  

                        // } else {                             
                        //     $sponser_detail = UserMaster::where('self_sponsor_key', $this->data['user_sponser_id'])->first(); 
                        //     $sponser_detail['sponser_for_current_insert'] =  UserMaster::where('id', $sponser_detail['id'])->first(); 
                        //     $sponser_detail['result_data'] = $sponser_detail['id'];
                        //     $sponser_detail['left_insert'] = 1;
                        //     $sponser_detail['right_insert'] = NULL;

                        // }

                    } else {
                        $sponser_detail = NULL;
                    }

                    // dd($sponser_detail, 'FINAL');

                    $result1 = Sentinel::registerAndActivate(array(
                        'email'         => $this->data['user_email'],
                        'password'      => $this->data['user_password'],
                        'first_name'    => $this->data['user_name'],
                        'last_name'     => $this->data['user_name'],
                    ));

                    $user_record = Sentinel::findByCredentials( [ 'email' => $this->data['user_email'] ] );
                    $role = Sentinel::findRoleById('3');    
                    // $role = Sentinel::findRoleById('1');
                    $role->users()->attach($user_record);

                    // $user_record->create_by     = '1';
                    // $user_record->status        = isset($this->data['status'])?($this->data['status']):'0';
                    


                    
                    $record                     = new UserMaster();
                    $record->create_by          = $user_record->id;

                    // if(!empty($this->data['user_sponser_id']))
                    // {                
                    //     // $record->sponsor_id        = $user_record->id; 
                    //     // $record->has_sponsor       = 0;
                    // }                       

                    $record->name               = $this->data['user_name'];
                    $record->email              = $this->data['user_email'];
                    $record->mobile             = $this->data['user_mobile'];
                    $record->address            = $this->data['user_address'];
                    $record->self_sponsor_key   = rand();
                    $record->account_status     = 1;

                    if(!empty($sponser_detail['sponser_for_current_insert']))
                    {
                        if(!empty($this->data['user_sponser_id']))
                        {
                            $record->has_sponsor = 1;                            
                        } else {
                             $record->has_sponsor = 0;
                        }

                        if(!empty($sponser_detail['left_insert']))
                        {
                            $record->mlm_side           = 'L';
                        } else {
                            $record->mlm_side           = 'R';
                        }

                        // $record->mlm_side           = $sponser_detail['right_insert'];
                        $record->sponser_unique_id  = $sponser_detail['sponser_for_current_insert']['self_sponsor_key'];
                        $record->sponser_mobile     = $sponser_detail['sponser_for_current_insert']['mobile'];
                        $record->sponsor_id         = $sponser_detail['sponser_for_current_insert']['id'];
                    }

                    


                    $result                     = $record->save();

                    $user_record->user_master_id     = $record->id;
                    $user_result                = $user_record->save();
                    
                    

                });
            } catch (Exception $e) {
                 return false;
            }

            return true;


        } else if ($this->operation == 'edit') {

            $record                 = User::find($this->data['id']);
            $record->update_by      = $user->id;
            
            if(!empty($this->data['mobile_number']))
            {
                $record->mobile_number  = $this->data['mobile_number'];
            }

            $record->first_name     = $this->data['first_name'];
            $record->last_name      = $this->data['last_name'];
            $record->email          = $this->data['email'];

            if ($this->data['password'] != '' || $this->data['password'] != null) {
                $record->password = \Hash::make($this->data['password']);
            }

            $record->company_name              = $this->data['company_name'];
            $record->chamber_commerce_number   = $this->data['chamber_commerce_number'];  
            $record->payment_by_invoice        = isset($this->data['payment_by_invoice']) ? ($this->data['payment_by_invoice']) : '0';

            $record->status         = isset($this->data['status']) ? ($this->data['status']) : '0';
            $result = $record->save();

            return $result;

        } else if ($this->operation == 'delete') {

            $record = User::find($this->data['id']);
            $record->delete_by = $user->id;
            $record->save();

            $result = $record->delete();
            return $result;
        }
    }
}
