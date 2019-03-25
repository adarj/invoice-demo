<body>
  <div class="container">
    <div class="row justify-content-center vertical-center">
      <div class="col-4" id="login-form">
        <div class="container">
          <h2>Register</h2>
          <form method="post">
            <div class="form-group">
              <label for="username-input">Username</label>
              <input type="text" class="form-control" name="username" id="username-input" required>
            </div>
            <div class="form-group">
              <label for="password-input">Password</label>
              <input type="password" class="form-control" name="password" id="password-input" required>
            </div>
            <div class="form-group">
              <label for="password-confirm-input">Confirm Password</label>
              <input type="password" class="form-control" id="password-confirm-input" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
          </form>
        </div>
        <p class="text-center">Already have an account? Log in <a href="/">here</a></p>
      </div>
    </div>
  </div>
</body>
