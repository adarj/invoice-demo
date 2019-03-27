    <div class="container">
      <div class="row justify-content-center">
        <h1 class="text-center mt-3 mb-5">Invoices</h1>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col" width="15%">#</th>
              <th scope="col">Customer</th>
              <th scope="col">Date</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>
              <th scope="col" width="10%"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($invoices as $key=>$value): ?>
            <tr>
              <th scope="row"><?php echo $value["number"]; ?></th>
              <td><?php echo getCustomer($value["customer_id"])["first_name"] . " " . getCustomer($value["customer_id"])["last_name"]; ?></td>
              <td><?php echo $value["date"]; ?></td>
              <td>$<?php echo $value["amount"]; ?></td>
              <td><?php echo $value["status"]; ?></td>
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
