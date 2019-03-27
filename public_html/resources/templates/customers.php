    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6" id="customers">
          <h1 class="text-center mt-3">Customers</h1>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" width="15%">ID #</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col" width="10%"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($customers as $key=>$value): ?>
              <tr>
                <th scope="row"><?php echo $value["id"]; ?></th>
                <td><?php echo $value["first_name"]; ?></td>
                <td><?php echo $value["last_name"]; ?></td>
                <td>
                  <form method="post">
                    <button type="submit" class="btn btn-danger" name="delete" value="<?php echo $value["id"]; ?>">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
