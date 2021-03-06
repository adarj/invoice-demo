    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/">Invoice Demo</a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/customers/">Customers</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/invoices/">Invoices</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown" id="addDropdown">
            <button type="button" class="btn btn-dark dropdown-toggle pl-3 pr-2" id="addDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-plus"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/customers/new/">New Customer</a>
              <a class="dropdown-item" href="/invoices/new/">New Invoice</a>
            </div>
          </li>
          <li class="nav-item dropdown" id="accountDropdown">
            <button type="button" class="btn btn-primary dropdown-toggle pl-3 pr-2 ml-2 mr-2" id="accountDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <p class="dropdown-header">Signed in as <b><?php echo $_SESSION["username"]; ?></b></p>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
