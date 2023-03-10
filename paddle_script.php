<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once 'config/connection.php';
$dbHandle = new DBConnection();

$curl = curl_init();

// call first 1 for now

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://vendors.paddle.com/api/2.0/subscription/users',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'vendor_id=50133&vendor_auth_code=2298b2ee5b19c2bd14b8301f271d1f0c0672cc84a513a8c21e&state=active',
  CURLOPT_HTTPHEADER => array(
    'vendor_id: 50133',
    'vendor_auth_code: 1c500985063eaf1a0ba3b231d4949786',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: paddle_session_vendor=eyJpdiI6Ik52T0Y2K2txd3d4dmRkcXNjWm5pckE9PSIsInZhbHVlIjoiZndvMEFwcHBaOTd4V0lIT0R3U2JDT1JoTHhBODBFdER6N0JFZG9nSm9SMUY0ZGhqSFdRNmEyRmtBc3ZPbkJCS0pSdzVqWC8vYklPZnlSR2M5MzRlRVBsTEl0NDI3ZkU4N21FTFRhcWxFSWxrU1BPZ0VVRW9ZTjVXcGhuR1RHdC8iLCJtYWMiOiI0YmI3OGFhYTFjZTk2YjVlMGFmNDYzMTM2NGFkZmUxNjJkYmU3MjI4MDYwYmUyZmM2ODgyZjY0NGQ1NTg5N2RmIiwidGFnIjoiIn0%3D'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$json_data =  json_decode($response);
$decode_response = $json_data->response;

$i = 0; 
$subscribed_users = array();
foreach ($decode_response as $key => $value) {
    // code...
    // $existing_emails = $value->user_email;
    // if($value->state == "active" || $value->state == "trialing" ) {
    //     array_push($subscribed_users, $existing_emails);
    //     echo $value->state;
    // }
    //updateDBFormPaddleScript($value, $dbHandle);

    $existing_emails = $value->user_email;
    $sql = "SELECT id FROM users WHERE email = '".$existing_emails."'";
    $sth = $dbHandle->prepare($sql);      
    $sth->execute();  
    $user  = $sth->fetch(PDO::FETCH_ASSOC);
    if(empty($user)) {  
        //$subscribed_users[] = $subscribed_users;
        array_push($subscribed_users, $existing_emails); 
        //updateDBFormPaddleScript($value);
        $i++;
    } 
    //$i++;

}

echo "<pre>";
print_r($subscribed_users);
echo "unique array --------------------";
//print_r(array_unique($subscribed_users));

die;

//echo "Total Number of UnSubscribed  ".$i;
// function updateDBFormPaddleScript($data, $dbHandle) {


//     //echo "Total Number of UnSubscribed  ".$i;
//    // echo "<pre>";
//    // print_r($data);
//     //die;

//     $sql = "SELECT p.*,f.fb_accounts  FROM `plans` p INNER JOIN plan_features f ON p.id = f.plan_id WHERE paddle_plan_id =".$data->plan_id;
//     $sth = $dbHandle->prepare($sql);
//     $sth->execute();  
//     $plan  = $sth->fetch(PDO::FETCH_ASSOC);
//     //print_r($plan);
//     if (count($plan)>0){
//         $plan_id = $plan['id'];  
//         $getresponse_list_name = $plan['getresponse_list_name'];
//         $trial = $plan['is_trial'];
//         if($data->state == "trialing"){
//             if(isset($data->subscription_id)){
//                 $license_key = generateRandomString(16);          
//                 if($plan['plan_type'] == "lifetime"){
//                     $next_bill_date = null;
//                     $expired_column = "expired_on = null,";
//                 }else{
//                     //$next_bill_date = $data["next_bill_date"];
//                     $next_payment = $data->next_payment;
//                     $next_bill_date = $next_payment->date;
//                     $expired_column = "expired_on = '".$next_bill_date."',";
//                 }
//                 //$next_payment = $data->next_payment;
//                 //echo $next_bill_date;

//                 $sql = "SELECT id,paddle_subscription_id FROM users WHERE email = '".$data->user_email."'";
//                 $sth = $dbHandle->prepare($sql);      
//                 $sth->execute();  
//                 $user  = $sth->fetch(PDO::FETCH_ASSOC);
//                 //echo $user['paddle_subscription_id'];
//                 if( $user) {
//                     if($user['paddle_subscription_id'] != '' || $user['paddle_subscription_id'] != null) {
//                         $sql = "UPDATE users SET status=1, plan_id = $plan_id, fb_accounts = ".$plan['fb_accounts'].", trial = $trial, ".$expired_column." cancellation_effective_date = null,  updatedDate='".date('Y-m-d h:i:s')."', paddle_subscription_id = '". $data->subscription_id."' WHERE id=".$user["id"];
//                         $statement = $dbHandle->prepare($sql);
//                         $statement->execute();
//                         //echo "data updated";
//                         echo "1 ".$data->user_email;
//                         echo "<br>";
//                     }
//                 } else {  
//                     $userPassword = generateRandomString(5);
//                     $statement = $dbHandle->prepare('INSERT INTO users (email, password, is_email_send,  license_key, plan_id, fb_accounts, trial , started_on, expired_on, paddle_subscription_id, createdDate, updatedDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');    
//                     $statement->execute([$data->user_email, md5($userPassword), 0, $license_key, $plan_id, $plan['fb_accounts'], $trial , date('Y-m-d' ), $next_bill_date , $data->subscription_id, date('Y-m-d h:i:s'), date('Y-m-d h:i:s')]);
//                     echo "0 ".$data->user_email;
//                     echo "<br>";
//                     //echo "data inserted";
//                 }
//             }
//         } 
//         else {
//             json_encode(array('error'=>'Invalid Paddle Plan Id'));
//         }
//     }
// }


// function generateRandomString($length = 10) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }
?>