<?php   
session_start();
$conn = mysqli_connect("localhost", "root", "", "eksamensite");  
if(isset($_POST["add_to_cart"]))  
{  
  //kører if statementet der tilføjer dataen for produktet ned i kurvens skema 
  if(isset($_SESSION["shopping_cart"]))  
  {  
       $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
       if(!in_array($_GET["id"], $item_array_id) && (int)time() < (int)strtotime($_POST["hidden_end_date"]))  
       {  
          $count = count($_SESSION["shopping_cart"]);  
          $item_array = array(  
               'item_id'=>$_GET["id"],  
               'item_name'=>$_POST["hidden_name"],  
               'item_price'=>$_POST["hidden_price"],  
               'item_quantity'=>$_POST["quantity"]  
          );  
          $_SESSION["shopping_cart"][$count] = $item_array;  
       }  
       else  
       {  
        //hvis produktet allerede er der 
          echo '<script>alert("Item already added or not available for preorder anymore")</script>';  
          echo '<script>window.location="shop.php"</script>';  
       }  
  }  
  else  
  {  
   $item_array = array(  
        'item_id'=>$_GET["id"],  
        'item_name'=>$_POST["hidden_name"],  
        'item_price'=>$_POST["hidden_price"],  
        'item_quantity'=>$_POST["quantity"]  
   );  
   $_SESSION["shopping_cart"][0] = $item_array;  
  }  
} 

if(isset($_GET["action"]))  
 {  
  //laver et sale og indsætter købne brugeren har lavet i form af et sale per genstand brugeren har købt og linker det med brugerens id
      if($_GET["action"] == "preorder" && isset($_SESSION["shopping_cart"]) )  {

        if(isset($_POST["preorder"]))  {
          foreach($_SESSION["shopping_cart"] as $keys => $values)  
          { 
            $item_quantity = (int) $values["item_quantity"];
            $item_id       = (int) $values["item_id"];

            for ($x = 1; $x <= $item_quantity; $x++) {

              //den indsætter værdier der stemmer overens med en mange til mange relation
              $query = "INSERT INTO sales (user_id, product_id) VALUES ({$_SESSION['u_id']}, $item_id)"; 
              $result = mysqli_query($conn, $query);  
            } 
                
          }

          delete_order();
        } 
      }

      if($_GET["action"] == "delete")  
      {  
          delete_order();
      }  
} 


function delete_order($id=-1) 
{
  //fjerne dataen fra kurven
  foreach($_SESSION["shopping_cart"] as $keys => $values)  
  {  
    if($values["item_id"] == $id && $id>-1)  
    {  
      unset($_SESSION["shopping_cart"][$keys]);  
      echo '<script>alert("Item Removed")</script>';  
      echo '<script>window.location="shop.php"</script>';  
    }  
    else {
      unset($_SESSION["shopping_cart"][$keys]);  
    }
  }  
}
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Shop</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" type="text/css" href="style.css">

      </head>  
      <body> 
        <?php
          include_once 'header.php'
        ?>
        <section class="main-container">
          <div class="main-wrapper" style="color:black;">   
                <h2 align="center">Shop</h2><br />  
                <?php  
                $query = "SELECT * FROM products ORDER BY id ASC";  
                $result = mysqli_query($conn, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                  //grafisk opsætning for produkterne
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                     <form method="post" action="shop.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-info"><?php echo "Enddate: "; echo $row["end_date"]; ?></h4>  
                               <h4 class="text-danger"> Price: $<?php echo $row["price"]; ?></h4>  
                               <input type="number" name="quantity" class="form-control" value="1" min="1" max="5"/>  
                               <input type="hidden" name="hidden_end_date" value="<?php echo $row["end_date"]; ?>" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="combutton" value="Tilføj" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <h2 style="color:white;">Order Details</h2>  
                <div class="tableshop" style="color:white">  
                     <table>  
                          <tr>  
                            <!-- grafisk opsætning for produkterne i kurven -->
                               <th width="40%">Navn</th>  
                               <th width="10%">Mængde</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  ,
                            <!-- indsætning af data-->
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="shop.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger" style="text-decoration: none; color:black; background-color:white; padding:2px;">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                     <?php
                     if(isset($_SESSION["shopping_cart"])) {
                     ?>
                     <!-- knap til pre-order -->
                     <form method="post" action="shop.php?action=preorder">  
                      <button id='preorderbtn' type='submit' name='preorder'>Pre-order</button>
                     </form>
                     <?php
                      }
                     ?>
                </div>  
           </div>
          </section>   
           <?php
          include_once 'footer.php'
        ?>
      </body>  
 </html>