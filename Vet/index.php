<?php include('partials/menu.php');?>
<?php
    if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        }
?>

<div class="gallery">
    <div class="nav">

    <?php
      $sql= "SELECT * FROM product WHERE active='yes' AND featured='yes'";
      $res= mysqli_query($conn, $sql);

          $count= mysqli_num_rows($res);
          if($count>0)
          {
            while($rows=mysqli_fetch_assoc($res))
            {
              $id= $rows['id'];
              $title= $rows['title'];
              $image= $rows['image_name'];
              $price= $rows['price'];

              if($image=="")
              {
                echo "<div class='error'>Image not added_a</div>";
              }
              else
              {
              ?>
              <img src="<?php echo URL;?>UP Images/product/<?php echo $image;?>" alt="Product pic">
              <a href="<?php echo URL;?>Vet/order.php?pd_id=<?php echo $id?>"> Buy Now</a>
              <?php
              }
            }
          }
          else
          {
            echo "<div class='error'>No Product is Available</div>";
          }
      ?>
  </div>
  </div>
<?php include('partials/footer.php');?>