<?php 
$currentUser = $_SESSION['user_email'];
include"./order-inventory-classes/db_connection.php"; 
?>

<div class="shopping-cart main-wrapper">
    <?php 
        $sqlAddToCart_getUser = $conn->prepare("SELECT * FROM tbl_users WHERE `user_email`='$currentUser'");
        $sqlAddToCart_getUser->execute();
        $rowAddToCart_getUser = $sqlAddToCart_getUser->fetch(PDO::FETCH_ASSOC);

        $userChecker = $rowAddToCart_getUser['user_id'];

        $sqlMainChecker = $conn->prepare("SELECT * FROM tbl_addtocart WHERE `user_id`='$userChecker' AND `status`='1'");
        $sqlMainChecker->execute();

        if ($sqlMainChecker->rowCount() > 0) {
    ?>
    <h2>Shopping Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Sub total</th>
            </tr>
        </thead>
        <tbody>
            <?php      

                $sqlAddtoCart="SELECT * FROM tbl_addtocart WHERE `status`='1' AND `user_id`='$userChecker'";  
                $query = $conn->query($sqlAddtoCart); 
                foreach($query as $data) {
                    $productId = $data['product_id'];
                    $user = $data['user_id'];
                    $quantity = $data['quantity'];

                    $sqlProduct = $conn->prepare("SELECT * FROM tbl_product WHERE `prod_id`='$productId'");
                    $sqlProduct->execute();
                    $rowProduct = $sqlProduct->fetch(PDO::FETCH_ASSOC);
                    $price = $rowProduct['prod_price'];

                    $total = $quantity * $price;
                    ?>
                        <tr>
                            <td><?php echo $rowProduct['prod_name']?></td>
                            <td><?php echo $rowProduct['prod_price'] ?></td>
                            <td>
                                <div class="cart-quantity">
                                <form METHOD="POST" action="">
                                     <button type="submit" name="minusQuantity" value="<?php echo $data['id']; ?>"> - </button>
                                </form>
                                <?php echo $data['quantity'] ?>
                                <form METHOD="POST" action="">
                                     <button type="submit" name="addQuantity" value="<?php echo $data['id']; ?>"> + </button>
                                </form>
                                </div>

                            </td>
                            <td><?php echo $total ?></td>
                        </tr>
                    <?php
                }

            ?>
            
        </tbody>
    </table>
    <?php
        } else {
            ?>
                <div class="empty cart">
                        <h1>Shopping cart is empty!!! </h1>  
                </div>
            <?php
        }
    ?>
    <div class="shopping-cart total">
        <?php
            $sqlTotal="SELECT * FROM tbl_addtocart WHERE `user_id`='$userChecker' AND `status`='1'";  
            $queryTotal = $conn->query($sqlTotal); 
            $finalTOtal = 0;
            foreach($queryTotal as $dataTotal) {
                    $productId_total = $dataTotal['product_id'];
                    $quantity = $dataTotal['quantity'];

                    $sqlProduct_total = $conn->prepare("SELECT * FROM tbl_product WHERE `prod_id`='$productId_total'");
                    $sqlProduct_total->execute();
                    $rowProduct_total = $sqlProduct_total->fetch(PDO::FETCH_ASSOC);
                    $productPrice_total = $rowProduct_total['prod_price'];
                    $subsubTotal = $productPrice_total * $quantity;
                    $finalTOtal += $subsubTotal;
                    


            }
            echo"<h3>TOTAL: ". $finalTOtal. "</h3>";

            $sqlGetUserId_checkout = $conn->prepare("SELECT * FROM tbl_users WHERE `user_email`='$currentUser'");
            $sqlGetUserId_checkout->execute();
            $rowGetUserId_checkout = $sqlGetUserId_checkout->fetch(PDO::FETCH_ASSOC);
            $userId_checkout = $rowGetUserId_checkout['user_id'];

            ?>
            <form method="POST"action="">
                <button type="submit" name="checkout" value="<?php echo $userId_checkout; ?>">Checkout</button>
            </form>
            <?php



            
        ?>
    </div>
</div>
<?php 
    if (isset($_REQUEST['minusQuantity'])) {
        $id = $_REQUEST['minusQuantity'];

        $sqlGetQuantity_minus = $conn->prepare("SELECT * FROM tbl_addtocart WHERE `id`='$id'");
        $sqlGetQuantity_minus->execute();
        $rowGetQuantity_minus = $sqlGetQuantity_minus->fetch(PDO::FETCH_ASSOC);
        $quantity_minus = $rowGetQuantity_minus['quantity'];

        if($quantity_minus == 1) {

            $sqlDelete = "DELETE FROM tbl_addtocart WHERE `id`='$id'";
            $conn->exec($sqlDelete);
            echo "<meta http-equiv='refresh' content='0'>";

        } else if($quantity_minus > 1) {
            $quantity_minus_total = $quantity_minus - 1;

            $sqlUpdate_minus = "UPDATE tbl_addtocart SET quantity='$quantity_minus_total' WHERE `id`='$id'";
            $stmtUpdate_minus = $conn->prepare($sqlUpdate_minus);
            $stmtUpdate_minus->execute();
            echo "<meta http-equiv='refresh' content='0'>";
        }
        
    }

    if (isset($_REQUEST['addQuantity'])) {
        $id = $_REQUEST['addQuantity'];

        $sqlGetQuantity_add = $conn->prepare("SELECT * FROM tbl_addtocart WHERE `id`='$id'");
        $sqlGetQuantity_add->execute();
        $rowGetQuantity_add = $sqlGetQuantity_add->fetch(PDO::FETCH_ASSOC);
        $quantity_add = $rowGetQuantity_add['quantity'];

        $quantity_add_total = $quantity_add + 1;

        $sqlUpdate_minus = "UPDATE tbl_addtocart SET quantity='$quantity_add_total' WHERE `id`='$id'";
        $stmtUpdate_minus = $conn->prepare($sqlUpdate_minus);
        $stmtUpdate_minus->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if (isset($_REQUEST['checkout'])) {
        $usersCheckouts = $_REQUEST['checkout'];

        $sqlGetCheckout="SELECT * FROM tbl_addtocart WHERE `user_id`='$usersCheckouts' AND `status`='1'";  
        $queryGetCheckout = $conn->query($sqlGetCheckout); 
        foreach($queryGetCheckout as $dataCheckout) {
            $productId_checkout = $dataCheckout['product_id'];
            $quantityCheckout = $dataCheckout['quantity'];
            $addTocartTable_ids = $dataCheckout['id'];

            $sqlGetProductPrice_checkout = $conn->prepare("SELECT * FROM tbl_product WHERE `prod_id`='$productId_checkout'");
            $sqlGetProductPrice_checkout->execute();
            $rowGetProductPrice_checkout = $sqlGetProductPrice_checkout->fetch(PDO::FETCH_ASSOC);
            $priceFor_checkout = $rowGetProductPrice_checkout['prod_price'];

            $totalFor_checkout = $priceFor_checkout * $quantityCheckout;

            $sqlCheckout = "INSERT INTO `tbl_checkout` (`id`, `product_id`, `user_id`, `quantity`, `total`) VALUES (NULL, '$productId_checkout', '$usersCheckouts', '$quantityCheckout','$totalFor_checkout')";
            $conn->exec($sqlCheckout);

            $sqlCheckout_update = "UPDATE tbl_addtocart SET `status`='0' WHERE `id`='$addTocartTable_ids'";
            $stmtCheckout_update = $conn->prepare($sqlCheckout_update);
            $stmtCheckout_update->execute();
            
        }
        ?>
        <script>
            alert('Product added to cart successfully');
        </script>
            <?php
        echo "<meta http-equiv='refresh' content='0'>";

    }
?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.cart-quantity {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.shopping-cart.total {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.empty.cart {
    text-align: center;
}
</style>