<?php
session_start();

require_once("config.php");
require_once("templates/header.php");
?>

<body>
  <div class="container">
    <div class="row justify-content-center vertical-center">
      <div class="col-4" id="login-form">
        <h1 class="text-center">Invoice Demo</h1>
        <div class="container">
          <form>
            <div class="form-group">
              <label for="inputUsername">Username</label>
              <input type="text" class="form-control" id="inputUsername">
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <p class="text-center">Need an account? Register <a href="register.php">here</a></p>
      </div>
    </div>
  </div>
</body>

<?php
require_once("templates/footer.php");
?>
