    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6" id="newCustomerForm">
          <h1 class="text-center mt-3">New Invoice</h1>
          <div class="container">
            <form method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="invoiceNumberInput">Invoice Number</label>
                  <input type="text" class="form-control" name="invoice-number" id="invoiceNumberInput" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="invoiceDateInput">Invoice Date</label>
                  <input type="date" class="form-control" name="invoice-date" id="invoiceDateInput" required>
                </div>
              </div>
              <div class="form-group">
                <label for="invoiceAmountInput">Amount</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="dollarSignAddon">$</span>
                  </div>
                  <input type="text" class="form-control" name="invoice-amount" id="invoiceAmountInput" required>
                </div>
              </div>
              <div class="form-group">
                <label for="invoiceStatusInput">Status</label>
                <select class="form-control" name="invoice-status" id="invoiceStatusInput" required>
                  <option>Billed</option>
                  <option>Paid</option>
                </select>
              </div>
              <div class="form-group">
                <label for="invoiceUploadFile">Upload File</label>
                <br>
                <input type="file" name="invoice-file" id="invoiceUploadFile">
              </div>
              <button type="submit" class="btn btn-primary">Add Invoice</button>
            </form>
          </div>
        </div>
      </div>
    </div>
