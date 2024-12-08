<?php
// Zabbix API details
$zabbixApiUrl = "http://localhost:8080/api_jsonrpc.php";
$zabbixUser = "Admin";
$zabbixPassword = "zabbix";

// Payload to authenticate and retrieve token
$payload = json_encode([
    "jsonrpc" => "2.0",
    "method" => "user.login",
    "params" => [
        "username" => $zabbixUser,
        "password" => $zabbixPassword
    ],
    "id" => 1,
    "auth" => null
]);

// Initialize CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $zabbixApiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Execute CURL request
$response = curl_exec($ch);

if ($response === false) {
    die("Error: " . curl_error($ch));
}

// Decode the response
$data = json_decode($response, true);

// Check if the token is returned
if (isset($data['result'])) {
    $token = $data['result'];
    echo "Token retrieved: $token\n";

    // Save the token to a file
    $filePath = '/usr/share/zabbix/web/zabbix_token.txt';
    if (file_put_contents($filePath, $token) !== false) {
        echo "Token saved to: $filePath\n";
    } else {
        echo "Error: Unable to save the token to a file.\n";
    }
} else {
    die("Error: Unable to retrieve token. Response: " . $response);
}

curl_close($ch);
?>

