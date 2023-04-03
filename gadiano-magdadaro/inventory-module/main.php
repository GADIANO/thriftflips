<h3>Inventory</h3>
<div id="subcontent">
    <table id="data-list">
      <thead>
        <tr>
          <th>Product</th>
          <th>Stock Value</th>
          <th>In stock</th>
          <th>Sold</th>
          <th>Total Income</th>
        </tr>
      </thead>
     <tbody>

        <?php
            include"./order-inventory-classes/db_connection.php";
            $finalTOtal = 0;
            $sqlInventory="SELECT product_id, user_id, sum(total) as total, sum(quantity) as quantity FROM tbl_checkout GROUP BY product_id, user_id";  
            $queryInventoory = $conn->query($sqlInventory); 
            foreach($queryInventoory as $dataInventory) {
              $productId_inventory = $dataInventory['product_id'];
              $totalQuantity = $dataInventory['quantity'];

              $sqlGetProductName = $conn->prepare("SELECT * FROM tbl_product WHERE `prod_id`='$productId_inventory'");
              $sqlGetProductName->execute();
              $rowGetProductName = $sqlGetProductName->fetch(PDO::FETCH_ASSOC);
              $productStock = $rowGetProductName['stock'];
              $productPrice = $rowGetProductName['prod_price'];

              $instock = $productStock - $totalQuantity;

              $income = $totalQuantity * $productPrice;

              $finalTOtal += $income;

              ?>
              <tr>
                <td><?php echo $rowGetProductName['prod_name'] ?></td>
                <td><?php echo $rowGetProductName['stock'] ?></td>
                <td><?php echo $instock; ?></td>
                <td><?php echo $totalQuantity; ?></td>
                <td><?php echo $income; ?></td>
              </tr>
              <?php
            }

        ?>
     </tbody> 

    </table>
    <div>
      <h3 style="float: right;">TOTAL: <?php echo $finalTOtal; ?></h3>
    </div>
</div>  