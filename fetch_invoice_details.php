<?php
include 'connection.php';
if (isset($_POST['invoice'])) {
    $sql = "SELECT * FROM invoice WHERE invoice_number = '{$_POST['invoice']}'";
    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            echo "<tr>
                <td>". $data['item_name']. "</td>
                <td>". $data['quatity']. "</td>
                <td>". $data['price']. "</td>
                <td>". $data['subtotal']. "</td>
            </tr>";
        }
    }else{
        echo "<tr>
            <td colspan='4'>No Data Found</td>
        </tr>";
    }
}
?>