<h3>Provide the Required Information</h3>
<div id="form-block">
    <!-- <form method="POST" action="processes/process.product.php?action=newproduct" enctype="multipart/form-data"> -->
    <form method="POST" action="" enctype="multipart/form-data">
        <div id="form-block-center">
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <label for="fname">Product Name</label>
            <input type="text" id="pname" class="input" name="pname" placeholder="Product name..">

            <label for="fname">Product Stock</label>
            <input type="text" id="stock" class="input" name="stock" placeholder="Product Stock..">

            <label for="lname">Description</label>
            <textarea id="desc" class="input" name="desc" placeholder="Description.."></textarea>
            
            <label for="fname">Product Retail Price</label>
            <input type="text" id="price" class="input" name="price" placeholder="Product price..">

            <label for="ptype">Type</label>
            <select id="ptype" name="ptype">
              <?php
              if($product->list_types() != false){
                foreach($product->list_types() as $value){
                   extract($value);
              ?>
              <option value="<?php echo $type_id;?>"><?php echo $type_name;?></option>
              <?php
                }
              }
              ?>
        </select>
              </div>
        <div id="button-block">
        <input type="submit" name="addProduct" value="Save">
        </div>
  </form>
</div>

<?php
include"./order-inventory-classes/db_connection.php";

$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
$NOW = $NOW->format('Y-m-d H:i:s');

if(isset($_REQUEST['addProduct'])) {

  $pname= $_REQUEST['pname'];
  $desc= $_REQUEST['desc'];
  $price= $_REQUEST['price'];
  $type= $_REQUEST['ptype'];
  $stock = $_REQUEST['stock'];

  $target_dir = "./order-inventory-classes/product-images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error

  $imageName = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  $sqlAddProduct = "INSERT INTO `tbl_product` VALUES (NULL, '$pname', '$desc', '$NOW','$NOW','None','None','0','$type','$price','$imageName','$stock')";
  $conn->exec($sqlAddProduct);
  ?>
  <script>
    alert('Product added successfully');
  </script>
  <?php
}
?>