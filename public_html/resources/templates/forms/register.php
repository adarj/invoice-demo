<body>
  <div class="container">
    <div class="row justify-content-center vertical-center">
      <div class="col-4" id="registerForm">
        <div class="container">
          <h2>Register</h2>
          <form method="post">
            <div class="form-group">
              <label for="usernameInput">Username</label>
              <input type="text" class="form-control" name="username" id="usernameInput" required>
            </div>
            <div class="form-group">
              <label for="passwordInput">Password</label>
              <input type="password" class="form-control" name="password" id="passwordInput" required>
            </div>
            <div class="form-group">
              <label for="confirmPasswordInput">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPasswordInput" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
          </form>
        </div>
        <p class="text-center">Already have an account? Log in <a href="/">here</a></p>
      </div>
    </div>
  </div>
</body>
