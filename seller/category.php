<?php include('partials/menu.php');?>
<?php

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql= "SELECT * FROM product WHERE category_id=$id AND featured='yes' AND active='yes'";
    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $count= mysqli_num_rows($res);
        if($count>0)
        {
            while($rows= mysqli_fetch_assoc($res))
            {
                $title = $rows['title'];
                $image = $rows['image_name'];

                if($image !="")
                {
                ?>
                    <img src="<?php echo URL;?>UP Images/product/<?php echo $image;?>" alt="Product pic">
                <?php
                }
                else
                {
                    echo "<div class='error'>Image not added</div>";
                }
            }
        }
        else
        {
            echo "<div class='error'>No Products Available</div>";
        }
    }
}

?>
<?php include('partials/footer.php');?>