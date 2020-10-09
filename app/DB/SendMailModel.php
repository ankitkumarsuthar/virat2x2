<?php

namespace App\DB;

use Mail; 
use Illuminate\Database\Eloquent\Model;

class SendMailModel extends Model
{
   
    public static function sendMail($type, $params, $company_id, $to_email, $extra = [], $attachment = '')
    {
        $master_settings    = Setting::whereNull('company_id')->first();
        $settings           = Setting::where('company_id', '=', $company_id)->first();

        $mail_template      = MailTemplate::where('type', $type)->where('company_id', $company_id)->first();

        $mail_body  = $mail_template->body;
        if(count($params) > 0) {
            foreach($params AS $key => $value) {
                $mail_body = str_replace($key, $value, $mail_body);
            }
        }

        $encryption = NULL;
        if($master_settings->mail_encryption_type == 1) {
            $encryption = NULL;
        } else if($master_settings->mail_encryption_type == 2) {
            $encryption = 'SSL';
        } else if($master_settings->mail_encryption_type == 3) {
            $encryption = 'TLS';
        } else if($master_settings->mail_encryption_type == 4) {
            $encryption = 'STARTTLS';
        }

        $from_email     = 'webinar@moosandspike.tv';
        $from_name      = 'Bijeenkomst +++ online';
        if($settings->from_email != '' && $settings->from_email != NULL) {
            $from_email = $settings->from_email;
        }
        if($settings->from_name != '' && $settings->from_name != NULL) {
            $from_name = $settings->from_name;
        }

        $view = \View::make('mail.mail_template', [ 'body' => $mail_body ]);
        $message = $view->render();
        $send_message_content = $view->render();

        $transport = (new \Swift_SmtpTransport($master_settings->mail_host, $master_settings->mail_port, $encryption))
                        ->setUsername($master_settings->mail_user_name)
                        ->setPassword($master_settings->mail_password);

        $mailer = new \Swift_Mailer($transport);

        $message    = (new \Swift_Message())
                        ->setSubject($mail_template->subject)
                        ->setFrom([ $from_email => $from_name ])
                        ->setTo([ $to_email ])
                        ->setBody($message);

        $message->setContentType('text/html');
        
        if($attachment != '') {
            $message_attachment = \Swift_Attachment::fromPath($attachment, 'application/pdf');
            $message->attach($message_attachment);
        }

        $result = $mailer->send($message);

        if(isset($extra['webinar_id'])) {
            $mail_log       = MailLog::createNewLog($company_id, $extra['webinar_id'], $extra['user_id'], $extra['company_name'], $mail_template->subject, $to_email, $send_message_content);
        } elseif(isset($extra['event_id'])) {
            $mail_log       = MailLog::createEventMailLog($company_id, $extra['event_id'], $extra['user_id'], $extra['company_name'], $mail_template->subject, $to_email, $send_message_content);
        } else {
            $mail_log       = MailLog::createGeneralMailLog($company_id, $extra['user_id'], $extra['company_name'], $mail_template->subject, $to_email, $send_message_content);
        }

        return true;
    }

    public static function dispatchMail($type, $params, $email)
    {
        $settings       = Setting::first();
        $mail_template  = MailTemplate::where('mail_template_name', $type)->first();

        if(!empty($mail_template)){
            
            $template_data = [];

            //$email = 'mehul@codingowls.in';
            
            Mail::send('admin.master-partials.mail_template',[
                'template_data'=>$template_data,                                         
            ], function ($message)  use ($email, $mail_template, $settings){

                $from_mail_address = 'leo.intex@gmail.com';

                $message->from($from_mail_address, 'Vwaearn MLM 2x2');
                $message->to('leo.intex@gmail.com');
                $message->cc('leo.intex@gmail.com');  
                $message->bcc('leo.intex@gmail.com');
                           

                $message->subject($mail_template['subject']);
            });                        

            return true;   

        } else {
            return false;
        }
    } 

 

  
    

}
