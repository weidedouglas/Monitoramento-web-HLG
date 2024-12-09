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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-wrapper">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="get.host.php"><i class="material-icons">remove_red_eye</i></a></li>
                <li><a href="webpage.php"><i class="material-icons">add_circle_outline</i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Form Section -->
    <div class="form-container">
        <div class="form-card">
            <h5>Adicionar um Novo Host</h5>
            <form action="create.host-template.php" method="POST">
                <div class="input-field">
                    <input id="host" name="host" type="text" class="validate" placeholder="sem HTTP/HTTPS" required>
                    <label for="host">Host a ser monitorado</label>
                </div>
                <div class="input-field">
                    <input id="application_name" name="application_name" type="text" class="validate" required>
                    <label for="application_name">Nome da aplicação</label>
                </div>
                <button class="btn waves-effect waves-light orange" type="submit">
                    Adicionar
                    <i class="material-icons right">add</i>
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript at end of body for optimized loading -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

