<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = filter_input(INPUT_POST,'host',FILTER_SANITIZE_URL);
$name = filter_input(INPUT_POST,'application_name',FILTER_SANITIZE_URL);


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
  CURLOPT_POSTFIELDS => "{\n           \"jsonrpc\": \"2.0\",\n           \"method\": \"host.create\",\n           \"params\": {\n\t\t\t\t\t\t\t\t\"host\": \"$hostname\",\n\t\t\t\t\t\t\t\t\"name\": \"$name\",\n\t\t\t\t\t\t \t\t\"groups\" : [\n\t\t\t\t\t\t\t\t\t{\"groupid\" : \"24\"}\n\t\t\t\t\t\t\t\t],\n\t\t\t\t\t\t \t\t\"templates\" : [\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t \"templateid\" : \"10628\"\n\t\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t\t]\n\t\t\t\t\t },\n\t\t\t\t\t \"auth\": \"03c37403326e411b72ca815866fb8180\",\n           \"id\": 1\n }",
CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "User-Agent: insomnia/10.1.1"
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <style>
        /* Center the preloader on the page */
        .preloader-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="preloader-container">
        <h5>Criando o host, aguarde...</h5>
        <!-- Materialize Preloader -->
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Redirect After 3 Seconds -->
    <script>
        setTimeout(() => {
            window.location.href = "get.host.php"; // Replace with the URL of the target page
        }, 3000); // 3-second delay
    </script>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
