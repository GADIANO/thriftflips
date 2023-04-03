<?php 
include"db_connection.php";
$user = $_SESSION['user_email'];

$sql="SELECT * FROM tbl_product";  
$query = $conn->query($sql); 
?>
<div class="main-wrapper-ordering">
    <?php
    foreach ($query as $data) { 
        ?>
            <div class="product-main wrapper">
                <div class="product-image wrapper">
                        <img src="./order-inventory-classes/product-images/<?php echo $data['img'] ?>" alt="">
                </div>
                <div class="product-details wrapper">
                    <div class="product-name">
                        <span><b>Product:</b> <?php echo $data['prod_name'] ?></span>
                    </div>
                    <div class="product-description">
                        <span><b>Description:</b> <?php echo $data['prod_description'] ?></span>
                    </div>  
                    <div class="product-price">
                        <span><b>Price:</b> <?php echo $data['prod_price'] ?></span>
                    </div>  
                    <div class="product-stock">
                        <?php 
                            if($data['stock'] == 0) {
                                ?>  
                                    <span><b>Stock: </b>Out of stock</span>
                                <?php
                            } else {
                                ?>
                                    <span><b>Stock: </b>InStock</span>
                                <?php
                            }
                        ?>
                        
                    </div>  
                    <div class="product-action">
                        <div class="action-wrapper">
                        <?php 
                            if($data['stock'] == 0) {
                        
                            } else {
                                ?>
                                    <form method="POST" action="">
                                        <input type="number" name="quantity" placeholder="Quantity">
                                        <button value="<?php echo $data['prod_id'] ?>" type="submit" name="addtocart">Add to cart</button>
                                    </form>
                                <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
                
            </div>
        <?php
    }
    ?>
</div>
<?php
if(isset($_POST["addtocart"]))
{
    include"db_connection.php";
    $product_id = $_REQUEST['addtocart'];
    $quantity = $_REQUEST['quantity'];
    try 
    {	
        $sqlGetUser = $conn->prepare("SELECT * FROM tbl_users WHERE `user_email`='$user'");
        $sqlGetUser->execute();
        $rowGetUser = $sqlGetUser->fetch(PDO::FETCH_ASSOC);
        $userId = $rowGetUser['user_id'];
        
        $st = $conn->prepare("SELECT * FROM tbl_addtocart WHERE `product_id`='$product_id' AND `status`='1' AND `user_id`='$userId'");
        $st->execute();

        if ($st->rowCount() > 0) {
            $sql_getQuantity = $conn->prepare("SELECT * FROM tbl_addtocart WHERE `product_id`='$product_id' AND `status`='1' AND `user_id`='$userId'");
            $sql_getQuantity->execute();
            $row_getQuantity = $sql_getQuantity->fetch(PDO::FETCH_ASSOC);

            $getQuantity = $row_getQuantity['quantity'];
            $finalQuantity = $getQuantity + $quantity;

            $sqlUpdate = "UPDATE tbl_addtocart SET quantity='$finalQuantity' WHERE `product_id`='$product_id' AND `status`='1' AND `user_id`='$userId'";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->execute();
            ?>
                <script>
                    alert('Product added to cart successfully');
            </script>
            <?php
            echo "<meta http-equiv='refresh' content='0'>";

        } else  {

            $sqls = "INSERT INTO `tbl_addtocart` (`id`, `product_id`, `quantity`, `status`,`user_id`) VALUES (NULL, '$product_id', '$quantity', '1','$userId')";
            $conn->exec($sqls);
            ?>
            <script>
                    alert('Product added to cart successfully');
            </script>
            <?php
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

    $dbCon = null;
    
}
?>
<style>
    .main-wrapper-ordering {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1.25rem;
    }
    .product-main.wrapper {
        width: 100%;
        --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 1rem;
        padding-bottom: 1rem;
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity));
    }
    .product-details.wrapper .product-name span {
        float: left;
    }
    .product-details.wrapper {
        display: grid;
    }
    .product-details.wrapper .product-description span {
        float: left;
    }
    .product-details.wrapper .product-price span {
        float: left;
    }
    .product-action .action-wrapper form{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
