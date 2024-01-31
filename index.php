<?php include('partials-front/menu.php');?>
  <!--<section class="background">
    <img class=" background-image"src="field-4639180_960_720.jpg">
    <div class="first-sec">
      <h3>A New way for dirtributing agri Products</h3>

      <p>Join here to get the most</p>

      <button>Sign Up</button>
    </div>
    </section>
-->
<?php
if(isset($_SESSION['order']))
{
  echo $_SESSION['order'];
  unset($_SESSION['order']);
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
              <a href="<?php echo URL;?>order.php?pd_id=<?php echo $id?>"> Buy Now</a>
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

  <?php include('partials-front/footer.php');?>