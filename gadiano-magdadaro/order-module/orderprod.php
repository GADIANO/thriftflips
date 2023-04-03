<h3>Product Details</h3>
<div class="btn-box">
<a href="processes/process.prod.php?page=settings&subpage=products&action=upload&id=<?php echo $id;?>" class="btn-jsactive"></a> | 
</div>
<br/>
<div id="form-block">
    <form method="POST" action="processes/process.prod.php?action=updateproduct">
    <div id="form-block-half">
    <img src="img/<?php echo $product->get_prod_image($id);?>"/>
    </div>    
    <div id="form-block-half">
            <label for="fname">Product Name</label>
            <input type="text" id="pname" class="input" name="pname" value="<?php echo $product->get_prod_name($id);?>" placeholder="Product name..">

            <label for="lname">Description</label>
            <textarea id="desc" class="input" name="desc" placeholder="Description.."><?php echo $product->get_prod_desc($id);?></textarea>
          
            <input type="hidden" id="prodid" name="prodid" value="<?php echo $id;?>"/>
            <label for="ptype">Type</label>
            <select id="ptype" name="ptype">
              <?php
              if($product->list_types() != false){
                foreach($product->list_types() as $value){
                   extract($value);
              ?>
              <option value="<?php echo $type_id;?>" <?php if($product->get_prod_type($id) == $type_id){ echo "selected";};?>><?php echo $type_name;?></option>
              <?php
                }
              }
              ?>
        </select>
              </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>
</div>
