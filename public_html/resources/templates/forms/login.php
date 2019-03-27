    <div class="container">
      <div class="row justify-content-center vertical-center">
        <div class="col-4" id="loginForm">
          <h1 class="text-center">Invoice Demo</h1>
          <div class="container">
            <form method="post" class="needs-validation" novalidate>
              <div class="form-group">
                <label for="usernameInput">Username</label>
                <input type="text" class="form-control" name="username" id="usernameInput" required>
                <div class="invalid-feedback">
                  Please enter a username.
                </div>
              </div>
              <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" name="password" id="passwordInput" required>
                <div class="invalid-feedback">
                  Please enter a password.
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
          <br>
          <p class="text-center">Need an account? Register <a href="register.php">here</a></p>
        </div>
      </div>
    </div>

<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
