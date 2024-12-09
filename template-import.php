<?php
// Zabbix API URL and credentials
$zabbixApiUrl = 'http://localhost:8080/api_jsonrpc.php'; 
$zabbixUser = 'Admin'; 
$zabbixPassword = 'zabbix'; 

// Template file path
$templateFile = '/usr/share/zabbix/web/template.xml'; 

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

// Step 2: Read the template XML file
$templateXml = file_get_contents($templateFile);
if ($templateXml === false) {
    die("Failed to read template file: $templateFile\n");
}

// Step 3: Import the template using configuration.import
$importData = [
    "jsonrpc" => "2.0",
    "method" => "configuration.import",
    "params" => [
        "format" => "xml",
        "rules" => [
            "templates" => [
                "createMissing" => true,
                "updateExisting" => true
	    ],
	    "httptests" => [
        	"createMissing" => true,
        	"updateExisting" => true
    	    ]
        ],
        "source" => $templateXml
    ],
    "auth" => $authToken,
    "id" => 2
];
$importResponse = zabbixApiRequest($zabbixApiUrl, $importData);

if (isset($importResponse['error'])) {
    die("Error importing template: " . json_encode($importResponse['error']));
}

echo "Template imported successfully.\n";
