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
