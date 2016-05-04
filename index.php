<?php
  // simple GET request
if(isset($_POST['submit'])) {
  $name = $_POST['name'];

  // Resource Address
#  $url="http://localhost/spiel-platz/rest_test/index.php?neme=$name";
  $url="http://localhost/spiel-platz/rest_test/";

  // send GET / PUT / POST request to resourse

  $client=curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
  // curl_setopt($client,CURLOPT_POST,$data);
  // curl_setopt($client,CURLOPT_DELETE,$data);

  // get response from resourse
  $response=curl_exec($client);

  // decode
    echo $response;
    $result=json_decode($response);
    echo $result->data;
}
  //process client request via URL
  // header("Content-Type:application/json");
  include("functions.php");
  if(!empty($_GET['name']))
  {
    // get data
    $name=$_GET['name'];
    $price=get_price($name);

    if(empty($price))
      // book not found
        deliver_response(200,"buch nicht auf lager",NULL);
      // book found
    else
        deliver_response(200,"buch auf lager",$price);

        function getUrlContent($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($httpcode>=200 && $httpcode<300) ? $data : false;
        }
  }
      // wrong request PARAMETERS
  else
  {
    deliver_response(400,"ERROR: REQUIRED PARAMETERS NOT GIVEN!",NULL);
  }

function deliver_response($status,$status_message,$data)
  {
    header("HTTP/1.1 $status $status_message");

    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;

    $json_response=json_encode($response);
    echo $json_response;
  }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8"/>
  <title>test-rest</title>
  </head>
  <body>
    <h2>ENTER BOOK :</h2>
    <form action = "">
    <input type = "text" name = "name">
    <br /><br />
    <button type = "submit">senden</button>
    </form>
</body>
</html>
