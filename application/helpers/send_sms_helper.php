<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('Send_SMS'))
{
  function Send_SMS( $to, $text ) {
  #example $to=”628xxxx,628xxxx”;

  $to = str_replace(' ',"",$to);
  $from = "Dari siapa"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
  $username = "username nya "; //your username
  $password = "password nya"; //your password
  $getUrl = "http://103.81.246.59:20003/sendsms?";
  $ch = curl_init();
  $apiUrl = $getUrl.'account='.$username.'&password_pengguna='.$password.'&numbers='.$to.'&content='.rawurlencode($text);

  curl_setopt( $ch, CURLOPT_URL, $apiUrl);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Accept:application/json'
  )
  );

  $response = curl_exec( $ch );
  $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
  $responseBody = json_decode( $response, true );

  if ($response) {
    echo $response;
  }
    curl_close($ch);
  }
}

function sendNotifWA($nomer,$pesan){
      $token = 'HW7KEEB4f5nDby6tpXcjmF5ef5N1PTJLxb3JfLxb7I40Wqk1nbFOcASgjsYh'; //masukan token disii

      $nomer = str_replace(substr($nomer,0,1),'62',substr($nomer,0,1)).substr($nomer,1);
      $curl = curl_init();
      $pesan    = $pesan;
      $jadwal_kirim = date('Y-m-d H:i:s',strtotime('-2 days'));
      $forms    = 'no_wa='.$nomer."&pesan=".$pesan."&jadwal_kirim=".$jadwal_kirim;

      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $forms );
      curl_setopt($curl, CURLOPT_URL, "https://mediodev.site/public/api/kirim_wa");
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Bearer ".$token
        )
      );
      $result = curl_exec($curl);
      curl_close($curl);
      
      $res = json_decode($result);
      if($res->status == 'berhasil'){
        return true;
      }else{
        return false;
      }
}
