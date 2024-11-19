<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zabbix API Table</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h4>Zabbix Hosts</h4>
        <!-- Table -->
        <table class="highlight">
            <thead>
                <tr>
                    <th>Host</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody id="host-table">
                <!-- Data will be inserted here dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Materialize JS and Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // Fetch data from the Zabbix API
        async function fetchZabbixData() {
            const url = "http://localhost:8080/api_jsonrpc.php"; // Replace with your Zabbix API URL
            const token = "03c37403326e411b72ca815866fb8180"; // Replace with your Zabbix API auth token
            
            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        jsonrpc: "2.0",
                        method: "host.get",
                        params: {
                            output: ["host", "name"] // Request only host and name fields
                        },
                        auth: token,
                        id: 1
                    })
                });
                const data = await response.json();

                // Extract host and name fields
                const hosts = data.result.map(item => ({
                    host: item.host,
                    name: item.name
                }));

                // Populate the table
                populateTable(hosts);
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        // Populate the Materialize table
        function populateTable(hosts) {
            const tableBody = document.getElementById("host-table");
            tableBody.innerHTML = ""; // Clear existing rows

            hosts.forEach(({ host, name }) => {
                const row = `
                    <tr>
                        <td>${host}</td>
                        <td>${name}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Fetch and display data on page load
        document.addEventListener("DOMContentLoaded", fetchZabbixData);
    </script>
</body>
</html>

