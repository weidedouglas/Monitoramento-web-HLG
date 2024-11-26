<?php 
$hostid = filter_input(INPUT_POST,'idh',FILTER_SANITIZE_URL);


// mudar esse sanitize ai de cima



$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "8080",
  CURLOPT_URL => "http://localhost:8080/api_jsonrpc.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n           \"jsonrpc\": \"2.0\",\n           \"method\": \"host.delete\",\n           \"params\": {\n               \"hostid\": \"$hostid\"\n           },\n\t\t\t\t\t \"auth\": \"03c37403326e411b72ca815866fb8180\",\n           \"id\": 1\n }",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "User-Agent: insomnia/10.1.1"
  ],
]);

var_dump($hostid);
die();
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
