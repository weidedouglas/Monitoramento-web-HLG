
<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "8080",
  CURLOPT_URL => "http://localhost:8080/api_jsonrpc.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{\n           \"jsonrpc\": \"2.0\",\n           \"method\": \"host.get\",\n           \"params\": {\n               \"output\": [\"name\", \"host\", \"status\"]\n           },\n\t\t\t\t\t \"auth\": \"03c37403326e411b72ca815866fb8180\",\n           \"id\": 1\n }",
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
	$hosts = json_decode($response);
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Import materialize.css -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection" />
    <!-- Let browser know website is optimized for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Host Monitor</title>
    <style>
        /* Centralize the form and apply dark theme */
        body {
            background: #121212; /* Dark background */
            color: #f5f5f5;     /* Light text color */
            margin: 0;
        }
        nav {
            background-color: #1e1e1e; /* Dark navbar */
        }
        nav .brand-logo {
            margin-left: 20px;
            color: #f5f5f5; /* Light logo text */
        }
        nav ul a {
            color: #bdbdbd; /* Light gray for menu items */
        }
        nav ul a:hover {
            color: #ffffff; /* White on hover */
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-card {
            background: #1e1e1e; /* Dark form background */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4); /* Dark shadow */
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .form-card h5 {
            margin-bottom: 2rem;
            color: #ff9800; /* Accent color for headings */
            font-weight: bold;
        }
        .input-field input {
            color: #f5f5f5; /* Light input text */
        }
        .input-field input:focus + label {
            color: #ff9800; /* Accent color for focused labels */
        }
        .input-field input:focus {
            border-bottom: 1px solid #ff9800; /* Accent border on focus */
            box-shadow: 0 1px 0 0 #ff9800;
        }
        .btn.orange {
            width: 100%;
            background-color: #ff9800; /* Accent button color */
            border-radius: 8px;
        }
        .btn.orange:hover {
            background-color: #e68a00; /* Slightly darker on hover */
        }
        .table-container {
            margin: 2rem auto;
            max-width: 800px;
            background: #1e1e1e; /* Dark table background */
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4); /* Dark shadow */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            text-align: left;
            padding: 12px;
        }
        table th {
            background: #333333; /* Darker header background */
            color: #ff9800; /* Accent color for headers */
            font-weight: bold;
        }
        table tr:nth-child(odd) {
            background: #2a2a2a; /* Slightly lighter for odd rows */
        }
        table tr:nth-child(even) {
            background: #1e1e1e; /* Matches card background */
        }
        table td {
            color: #f5f5f5; /* Light text */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-wrapper">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="get.host.php">Hosts Monitorados</a></li>
                <li><a href="webpage.php">Adicionar Host</a></li>
            </ul>
        </div>
    </nav>

    <!-- Table Section -->
    <div class="table-container">
        <h5 style="text-align: center;">Hosts Monitorados</h5>

<?php
if (isset($hosts->result) && is_array($hosts->result)) {
  echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Host ID</th>";
  echo "<th>Name</th>";
  echo "<th>Host</th>";
  echo "<th>Status</th>";
  echo "<th>Grafana</th>";
  echo "<th>Excluir</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";

  // Iterate over the result array
  foreach ($hosts->result as $entry) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($entry->hostid) . "</td>";
      echo "<td>" . htmlspecialchars($entry->name) . "</td>";
      echo "<td>" . htmlspecialchars($entry->host) . "</td>";
      echo "<td>" . htmlspecialchars($entry->status) . "</td>";
      echo "<td>" . "Grafana Link" . "</td>";
      echo "<td>  <a href='host.delete.php?idh=" . htmlspecialchars($entry->hostid) . "'>Deletar</a> </td>";
      echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
} else {
  echo "No data found in 'result'.";
}
?>	    

</tbody>
        </table>
    </div>

    <!-- JavaScript at end of body for optimized loading -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

