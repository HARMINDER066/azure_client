<?php

namespace App\Common;

use Config;
use Mail;
use App\Models\User;


class MailComponent {


public function SendActive($user) {
   $template_message = "Hi ".$user->name.",<br/><br/>";
        
          $template_message .= "Your Subscription plan has been reactivated. You can continue using your licence.<br/><br/>";
           $subject = "Chatsilo Subscription Reactivated";     
 
          $template_message .= "Thank you<br/>Chatsilo Team";

         $data = array('name'=>$user->name, "template_message"=>$template_message, 'email'=>$user->email, 'subject'=>$subject);
         Mail::send('mail.subscription', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject($data['subject']);
         $message->from('support@chatsilo.com','chatsilo');
      
        });

        }

        public function SendDeactive($user,$paymentFailed = false, $effective_date = false) {

            $template_message = "Hi ".$user->name.",<br/><br/>";
    if($effective_date){
        $template_message .= "You have cancelled your subscription plan. Subscription Cancellation will be effective from ". $effective_date ."<br/><br/>";
    } elseif($paymentFailed){
        $template_message .= "Your Subscription plan has cancelled due to payment failure on paddle.<br/><br/>";
    } else {
        $template_message .= "Your Subscription plan has cancelled. Please contact administrator to reactivate.<br/><br/>";
    }
    $template_message .= "Thanks<br/>Chatsilo Team";
           $subject = "Chatsilo Subscription Cancelled";
         $data = array('name'=>$user->name, "template_message"=>$template_message, 'email'=>$user->email, 'subject'=>$subject);
         Mail::send('mail.subscription', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject($data['subject']);
         $message->from('support@chatsilo.com','chatsilo');
      
        });

        }



    

       public  function SendLicence($user){ 
    $template_message = "Hey,<br/><br/>";
    $template_message .= "Thank you for signing up for Chatsilo!<br/><br/>";
    $template_message .= "It seems you've not been able to receive your license due to one reason or the other.<br/><br/>";
    $template_message .= "Maybe it landed in your spam folder.<br/><br/>";
    $template_message .= "Here is your License Key : <b>". $user->license_key ."</b><br/><br/>";
    
    $template_message .='Please, follow the instructions <a href="https://docs.chatsilo.com/">here</a> to set up your Chatsilo account and get started.<br/><br/>';

    $template_message .= '<a  href="https://docs.chatsilo.com/">https://docs.chatsilo.com/</a><br/><br/>' ;
    
    $template_message .= "If you have any question, just reply to this email and I will be happy to assist you further.<br/><br/>" ;
    
    $template_message .= "Thank you<br/>Chatsilo Team"; 
    $data = array('name'=>$user->name, "template_message"=>$template_message, 'email'=>$user->email);
         Mail::send('mail.subscription', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject('Your Purchased Chatsilo License!');
         $message->from('support@chatsilo.com','chatsilo');
   });

        }


       public  function sendWelcomeMailNew($email, $password, $name = "", $license_key = false){ 
   $template_message = "Hi ".$name.",<br/><br/>";
    $template_message .= "Thanks for signing up with Chatsilo!<br/><br/>";
    
    if($license_key){
        $template_message .= "Here is your License Key : ". $license_key ."<br/><br/>";
    }
    $template_message .= "Please, " .'<a  href="https://docs.chatsilo.com">'. "click here" .'</a>'. " to read step by step instructions on how to <br/>";
    $template_message .= "properly configure Chatsilo and start using it immediately <br/><br/>" ;
    $template_message .= "Thanks<br/>Chatsilo Team";
    $data = array('name'=>$name, "template_message"=>$template_message, 'email'=>$email);
  try {
         Mail::send('mail.subscription', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject('Welcome to Chatsilo!');
         $message->from('support@chatsilo.com','chatsilo');

});
     User::where('email',$data['email'])->update(['is_email_send'=>1]);
     }

     catch (Exception $e) {
          if (count(Mail::failures()) > 0) {
        User::where('email',$data['email'])->update(['is_email_send'=>0]);
    }
    //code to handle the exception
}

}

public function sendUpgradeDowngradeMail($user, $action="upgraded"){  
    $template_message = "Hi ".$user->name.",<br/><br/>";
    $template_message .= "Your Subscription plan has ". $action ." to ".$user->plan->name."<br/><br/>";
    $template_message .= "Thanks<br/>Chatsilo Team";

    $data = array('name'=>$user->name, "template_message"=>$template_message, 'email'=>$user->email);
    Mail::send('mail.subscription', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject('Chatsilo Subscription Changed!');
         $message->from('support@chatsilo.com','chatsilo');

});

}


function sentResetPasswordLink($user){  

    $link = "https://app.chatsilo.com/resetPassword/:".$user->token;
    
    $template_message = "Hi ".$user->name.",<br/><br/>";
    $template_message .= " <a href='".$link."'>Click here to reset password</a><br/><br/>";
    $template_message .= "Thank you<br/>Chatsilo Team";
    $data = array('name'=>$user->name, "template_message"=>$template_message, 'email'=>$user->email);

    Mail::send('mail.subscription', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject('Reset password!');
         $message->from('support@chatsilo.com','chatsilo');

});
 
}


public function sendResetLinkMail($user){  
    $template_message = "Hi ".$user->name.",<br/><br/>";
    $template_message .= "Here is your License Key : ". $user->license_key ."<br/><br/>";
    $template_message .= "Thanks<br/>Chatsilo Team";
    $subject = "Recover Your Chatsilo License";
    $data = array('name'=>$user->name, "template_message"=>$template_message, 'email'=>$user->email);
    Mail::send('mail.subscription', $data, function($message) use ($data, $subject) {
         $message->to($data['email'], $data['name'])->subject($subject);
         $message->from('support@chatsilo.com','chatsilo');

});
 
}


}