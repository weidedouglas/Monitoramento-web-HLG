<?php

$filePath = 'zabbix_token.txt';

if (!file_exists($filePath)) {
    die("Error: File does not exist.");
}

$tokenAPI = file_get_contents($filePath);

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
  CURLOPT_POSTFIELDS => "{\n           \"jsonrpc\": \"2.0\",\n           \"method\": \"hostgroup.create\",\n           \"params\": {\n               \"name\": \"Grupo Teste 1\"\n           },\n\t\t\t\t\t \"auth\": \"$tokenAPI\",\n           \"id\": 1\n }",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
