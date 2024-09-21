 <?php include('header.php')?>
 <div class="container-fluid">
 <div class="row">
        <div class="col">
            <div class="card"> 
                  <div class="card-body">
                  <div class="card-title bg-info p-2 d-flex">
                  <h2 class="col-md-10">Invoice Generator</h2>
                  <button type="button" class="btn btn-warning">            
                    <a href="fetch_invoice.php" >View Add Data Invoices</a>
                </button>
        </div>
        <?php
  session_start();
if(isset($_SESSION['msg'])){

  ?>
  <div class="alert alert-info">
    <?=$_SESSION['msg']?>
</div>
<?php
unset($_SESSION['msg']);
}
?>
 <form method="post" action="invoice.php" id="saveInvoice">
<table id="invoiceTable">
<tr>
<th>Sr. No.</th>
<th>Customer Name</th>
<th>Item Name</th>
<th>Quantity</th>
<th>Price</th>
<th>Subtotal</th>
<th>Date</th>
<th>Action</th>
</tr>
<tr>
<td>1</td>
<td><input type="text" name="name[]"></td>
<td><input type="text" name="item_name[]"></td>
<td><input type="number" name="quantity[]" onchange="calculateSubtotal(this)"></td>
<td><input type="number" name="price[]" onchange="calculateSubtotal(this)"></td>
<td><input type="text" name="subtotal[]" readonly></td>
<td><input type="date" name="date[]"></td>
<td><button type="button" class="btn btn-danger">Delete</button></td>
</tr>
</table>
<button type="button" onclick="addRow()" id="addRow">Add Row</button>
<br>
<p><b>Grand Total:</b> <span id="grandTotal">0</span></p>
<input type="submit" id="saveInvoice" class="btn btn-primary" name="submit" value="Save Invoice">
 </form>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
     integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
 crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#saveInvoice').on('submit',function(e){
e.preventDefault();
var name=$('input[name="item_name"]').val();
var quantity=$('input[name="quantity[]"]').val();
var price=$('input[name="price[]"]').val();
var subtotal=$('input[name="subtotal[]"]').val();
var date=$('input[name="date"]').val();
 if(name=='' || name==null){
$('input[name="item_name"]').toggleClass('is-invalid');
return false;
}
if(quantity==null || quantity==''){
$('input[name="quantity[]"]').toggleClass('is-invalid');
return false;
}
if(price==null || price==''){
$('input[name="price[]"]').toggleClass('is-invalid');
return false;
}
if(subtotal==null || subtotal==''){
$('input[name="subtotal[]"]').toggleClass('is-invalid');
return false;
}
if(date==null || date==''){
$('input[name="date"]').toggleClass('is-invalid');
return false;
}
    });
    function calculateSubtotal(element) {
        var row = $(element).closest('tr');
        var quantity = row.find('input[name="quantity[]"]').val();
        var price = row.find('input[name="price[]"]').val();
        var subtotal = quantity * price;
        row.find('input[name="subtotal[]"]').val(subtotal);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $('input[name="subtotal[]"]').each(function() {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $('#grandTotal').text(grandTotal);
    }

    $('#addRow').on('click', function() {
        var table = $('#invoiceTable tbody');
        var rowCount = table.find('tr').length;
        var newRow = `
            <tr>
                <td>${rowCount + 1}</td>
                <td><input type="text" name="name[]"></td>
                <td><input type="text" name="item_name[]"></td>
                <td><input type="number" name="quantity[]" onchange="calculateSubtotal(this)"></td>
                <td><input type="number" name="price[]" onchange="calculateSubtotal(this)"></td>
                <td><input type="text" name="subtotal[]" readonly></td>
                <td><input type="date" name="date[]"></td>
                <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
        `;
        table.append(newRow);
    });

    $(document).on('click', '.btn-danger', function() {
        $(this).closest('tr').remove();
        calculateGrandTotal();
    });

    window.calculateSubtotal = calculateSubtotal;
    window.removeRow = function(element) {
        $(element).closest('tr').remove();
        calculateGrandTotal();
    };
    $.ajax({
        
    })

});
</script>
 <?php include('footer.php')?>