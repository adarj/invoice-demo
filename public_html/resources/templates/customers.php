    <div class="container">
      <div class="row justify-content-center">
        <h1 class="text-center mt-3 mb-5">Customers</h1>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Name</th>
              <th scope="col" width="10%"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($customers as $key=>$value): ?>
            <tr>
              <td><?php echo $value["first_name"] . " " . $value["last_name"]; ?></td>
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
