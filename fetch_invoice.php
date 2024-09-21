<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <table class="table table-border table-striped">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="itemTableBody">

        </tbody>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal End -->

<?php include 'header.php'; ?>

<div class="container mt-5">
    
    <a href="newinvoice.php" class="btn btn-primary">Generate Invoice</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>SR#</th>
                <th>Client Name</th>
                <th>Invoice Number</th>
                <th>Invoice Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'connection.php';
                $sql = "SELECT * FROM invoice";
                $query = mysqli_query($conn,$sql);
                if($query && mysqli_num_rows($query) > 0){
                    $sr = 1;
                    while($data = mysqli_fetch_assoc($query)){
                        ?>
                            <tr>
                                <td><?= $sr ?></td>
                                <td><?= $data['client_name']; ?></td>
                                <td><?= $data['invoice_number']; ?></td>
                                <td><?= $data['invoice_date']; ?></td>
                                <td>
                                    <button class="btn btn-outline-success" onclick="view(<?= $data['invoice_number'] ?>)">View</button>
                                </td>
                            </tr>
                        <?php
                        $sr++;
                    }

                }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
     integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
 crossorigin="anonymous"></script>
<script>
    function view(invoice_number) {
        $.ajax({
            url: 'fetch_invoice_details.php',
            type: 'POST',
            data: { invoice : invoice_number},
            success: function(response) {
                $('#exampleModalLabel').text('Invoice Number : ' + invoice_number);
                $('#itemTableBody').html(response);
                $('#exampleModal').modal('show');
            }
        });
    }
</script>