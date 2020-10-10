<?php

namespace App\DB;

use Mail; 
use Illuminate\Database\Eloquent\Model;

class SendMailModel extends Model
{   
    public static function dispatchMail($type, $params, $email, $extra)
    {            
            $template_data = [];
            
            Mail::send('mail.password_forgotten',[
                'template_data'=>$template_data,                                         
                'params'=>$params,                                         
            ], function ($message) use($email){                
                $message->from('support@vwaearn.com', 'Vwaearn');
                $message->to($email);
                $message->cc('support@vwaearn.com');  
                // $message->bcc('support@vwaearn.com');
                $message->subject('Reset password link');
            });                                    
            return true;   
    } 

    public static function dispatchMail2($type, $params, $email, $extra)
    {            
            $template_data = [];            
            Mail::send('mail.register_mail',[
                'template_data'=>$template_data,                                         
                'params'=>$params,                                         
            ], function ($message) use($email){                
                $message->from('support@vwaearn.com', 'Vwaearn');
                $message->to($email);
                $message->cc('support@vwaearn.com');  
                // $message->bcc('support@vwaearn.com');
                $message->subject('Registered Successfully to Vwaearn');
            });                                    
            return true;      

       
    } 

 

  
    

}
