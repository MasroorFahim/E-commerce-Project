<?php 
  include('../config/dbsql.php');
  include('log-chk.php');
  $cusername = $_SESSION['cuser'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../astyle.css">
  <link rel="stylesheet" href="../navbar.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
  <title>Krishi-Sheba</title>
</head>

<body>
  <nav class="navbar">
    <div class="brand-title"><a href="<?php echo URL?>" class="lii">Krishi Sheba</a></div>
    <a href="#" class="toggle-button">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </a>
    <div class="navbar-links">
      <ul>
        <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>

        <li><a href="#" class="cat">Category<i class="fa fa-angle-down"></i></a>
          <div class="sub-menu-1">
            <ul>              
                <?php
                      $sql= "SELECT * FROM category WHERE active='yes' AND featured='yes'";
                      $res= mysqli_query($conn, $sql);

                          $count= mysqli_num_rows($res);
                          if($count>0)
                          {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                              $id= $rows['id'];
                              $title= $rows['title'];
                              ?>
                             <li><a href="category.php?id=<?php echo $id;?>"><?php echo $title; ?></a></li>
                             <?php
                            }
                          }
                ?>                
            </ul>
          </div>
        </li>
        <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
        <li><a href="<?php echo URL;?>logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="search-box">

      <form action="<?php echo URL;?>pd-search.php" method="POST">

      <input type="search" name="search" placeholder="search here" required>
      <input type="submit" name="submit" value="submit" class="fa">

      </form>
    </div>
  </nav>