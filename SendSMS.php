<?php
$ter1=2;
for($pro_id2 = 0; $pro_id2 < (int)$ter1; $pro_id2++) {

$url="https://api.getshoutout.com/coreservice/messages";
$auth_token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxN2RhNDNkMC0wZDAxLTExZWEtODE2MC0xNWRkYTBlYTcwOTEiLCJzdWIiOiJTSE9VVE9VVF9BUElfVVNFUiIsImlhdCI6MTU3NDQxMDg5MywiZXhwIjoxODkwMDMwMDkzLCJzY29wZXMiOnsiYWN0aXZpdGllcyI6WyJyZWFkIiwid3JpdGUiXSwibWVzc2FnZXMiOlsicmVhZCIsIndyaXRlIl0sImNvbnRhY3RzIjpbInJlYWQiLCJ3cml0ZSJdfSwic29fdXNlcl9pZCI6IjM1NjMiLCJzb191c2VyX3JvbGUiOiJ1c2VyIiwic29fcHJvZmlsZSI6ImFsbCIsInNvX3VzZXJfbmFtZSI6IiIsInNvX2FwaWtleSI6Im5vbmUifQ.GKl2yGb27oTgZ1gHBL0_TdCM2lCNX1fMJAjQYuA9pQo";
$mobile="94779252594";
$params = array(

                        'source' => 'CLOUD ARM', // Sender ID
                        'destinations' => array($mobile), // Receiver's mobile numebers
                         'transports'=>array('sms'),
                        'content' => array(
                            'sms'=>'Send via ShoutOUT Lite'
                        ) 

                    );

$body = json_encode($params);

                                

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
                    curl_setopt($ch, CURLOPT_POST, 1);

                    $headers = array();
                    $headers[] = "Content-Type: application/json";
                    $headers[] = "Accept: application/json";
                    $headers[] = "Authorization: Apikey $auth_token";
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    $result = curl_exec($ch);
                    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
           

                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                        return __( 'Failed for  ' , 'GF_SMS' ) . implode( ' , ',curl_error($ch));
                    }
                    

                    curl_close ($ch);  
                    
 }
?>
