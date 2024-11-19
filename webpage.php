<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Materialize Tabs Example</title>
  <!-- Materialize CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
  <style>
    body {
      padding: 20px;
    }
    .tabs .tab a {
      color: #ff6f00; /* Tab text color */
    }
    .tabs .tab a.active {
      color: #ffca28; /* Active tab text color */
    }
    .tabs .indicator {
      background-color: #ffca28; /* Active tab indicator color */
    }
  </style>
</head>
<body>

  <!-- Navbar with Tabs -->
  <div class="navbar">
    <nav class="nav-wrapper grey darken-3">
      <a href="#" class="brand-logo center">Host Monitor</a>
    </nav>
    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s4"><a href="#add-host">Adicionar um novo host</a></li>
          <li class="tab col s4"><a href="#monitored-hosts">Hosts Monitorados</a></li>
          <li class="tab col s4"><a href="#about">Sobre</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Tab 1: Adicionar um novo host -->
  <div id="add-host" class="col s12">
    <h5>Adicionar um Novo Host</h5>
	<form action="create.host.php" method="POST">
  <div class="input-field">
    <input id="host" name="host" type="text" class="validate" required>
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

  <!-- Tab 2: Hosts Monitorados -->
  <div id="monitored-hosts" class="col s12">
    <h5>Hosts Monitorados</h5>
    <table class="striped">
      <thead>
        <tr>
          <th>Host</th>
          <th>Nome da Aplicação</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>192.168.1.1</td>
          <td>Servidor Web</td>
          <td>Ativo</td>
        </tr>
        <tr>
          <td>192.168.1.2</td>
          <td>Banco de Dados</td>
          <td>Offline</td>
        </tr>
        <tr>
          <td>192.168.1.3</td>
          <td>API Gateway</td>
          <td>Ativo</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tab 3: Sobre -->
  <div id="about" class="col s12">
    <h5>Sobre</h5>
    <p>Este sistema permite monitorar hosts e suas respectivas aplicações. Foi desenvolvido utilizando o framework Materialize CSS para proporcionar uma interface elegante e responsiva.</p>
  </div>

  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const tabs = document.querySelectorAll('.tabs');
      M.Tabs.init(tabs);
    });
  </script>
</body>
</html>

