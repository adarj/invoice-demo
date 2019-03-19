<?php
session_start();

require_once("../resources/config.php");
require_once(TEMPLATES_PATH . "/header.php");
?>

<body>
  <div class="container">
    <div class="row justify-content-center vertical-center">
      <div class="col-4" id="login-form">
        <div class="container">
          <h2>Register</h2>
          <form>
            <div class="form-group">
              <label for="inputUsername">Username</label>
              <input type="text" class="form-control" id="inputUsername">
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword">
            </div>
            <div class="form-group">
              <label for="inputPasswordConfirm">Confirm Password</label>
              <input type="password" class="form-control" id="inputPasswordConfirm">
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
          </form>
        </div>
        <p class="text-center">Already have an account? Log in <a href="login.php">here</a></p>
      </div>
    </div>
  </div>
</body>

<?php
require_once(TEMPLATES_PATH . "/footer.php");
?>
