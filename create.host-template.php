<?php
// Zabbix API URL and credentials
$zabbixApiUrl = 'http://localhost:8080/api_jsonrpc.php'; 
$zabbixUser = 'Admin'; 
$zabbixPassword = 'zabbix';
$templateName = "Teste web"; 
$hostname = filter_input(INPUT_POST,'host',FILTER_SANITIZE_URL);
$name = filter_input(INPUT_POST,'application_name',FILTER_SANITIZE_SPECIAL_CHARS);
$hostGroupId = "2";

// Function to send API requests
function zabbixApiRequest($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);
    return json_decode($response, true);
}

// Step 1: Authenticate and get the API token
$authData = [
    "jsonrpc" => "2.0",
    "method" => "user.login",
    "params" => [
        "username" => $zabbixUser,
        "password" => $zabbixPassword
    ],
    "id" => 1
];
$authResponse = zabbixApiRequest($zabbixApiUrl, $authData);

if (!isset($authResponse['result'])) {
    die('Authentication failed: ' . json_encode($authResponse));
}

$authToken = $authResponse['result'];
echo "Authentication successful. Token: $authToken\n";

// Step 2: Retrieve the template ID by name
$templateGetData = [
    "jsonrpc" => "2.0",
    "method" => "template.get",
    "params" => [
        "output" => ["templateid", "host"],
        "filter" => [
            "host" => [$templateName]
        ]
    ],
    "auth" => $authToken,
    "id" => 2
];
$templateGetResponse = zabbixApiRequest($zabbixApiUrl, $templateGetData);

if (isset($templateGetResponse['error'])) {
    die("Error retrieving template ID: " . json_encode($templateGetResponse['error']));
}

if (empty($templateGetResponse['result'])) {
    die("No template found with the name: $templateName\n");
}

$templateId = $templateGetResponse['result'][0]['templateid'];
echo "Template ID for '$templateName': $templateId\n";

// Step 3: Create a host and link it to the template
$hostCreateData = [
    "jsonrpc" => "2.0",
    "method" => "host.create",
    "params" => [
	"host" => $hostname,
	"name" => $name,
        "groups" => [
            ["groupid" => $hostGroupId]
        ],
        "templates" => [
            ["templateid" => $templateId]
        ],
    ],
    "auth" => $authToken,
    "id" => 3
];

$hostCreateResponse = zabbixApiRequest($zabbixApiUrl, $hostCreateData);

if (isset($hostCreateResponse['error'])) {
    die("Error creating host: " . json_encode($hostCreateResponse['error']));
}

$hostId = $hostCreateResponse['result']['hostids'][0];
echo "Host created successfully with ID: $hostId\n";

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

