<?php
 
function sendGCM($message, $id, $title) {

                               $title = str_replace("%20", " ", $title);

                               $message = str_replace("%20", " ", $message);

 

 

                               

                               $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

                               $token=$id;

 

                               $notification = [

                                               'title' =>$title,

                                               'body' => $message

                               ];

                               $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

 

                               $fcmNotification = [

            //'registration_ids' => $tokenList, //multple token array

            'to'        => $token, //single token

            'notification' => $notification,

            'data' => $extraNotificationData

        ];

 

        $headers = [

                'Authorization: key=' . 'AAAAP4dTMA0:APA91bEtTPC9yN5prWSsuENDCln_w2A3uAL3ZybFT8Jw_lJUBwKgr72G3FbjJMb67Kqm2f7-QOPeOXKeJPziMCta2LBZzJyijjqFCcz3S9GobBb-PNnSfsj-JgjtA61So6bm_54uhg4M',

                'Content-Type: application/json'

        ];

 

 

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$fcmUrl);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));

        $result = curl_exec($ch);

        curl_close($ch);

 

       // echo $result;

    }

?>
