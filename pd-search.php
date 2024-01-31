<?php include('partials-front/menu.php');?>
<div class="gallery">
<?php

$search = $_POST['search'];
if(isset($search))
{
    $sql= "SELECT * FROM product WHERE title LIKE '%$search%' OR description LIKE '%$search%' AND active= 'yes' AND featured= 'yes'";
    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $count= mysqli_num_rows($res);
        if($count>0)
        {
            while($rows= mysqli_fetch_assoc($res))
            {
                $id = $rows['id'];
                $price = $rows['price'];
                $title = $rows['title'];
                $description = $rows['description'];
                $image = $rows['image_name'];
                
                if($image=="")
                {
                    echo "<div class='error'>Image not added_a</div>";
                }
                else
                {
                ?>
                <img src="<?php echo URL;?>UP Images/product/<?php echo $image;?>" alt="Product pic">
                <?php
                }
            }
        }
        else
        {
            echo "<div class='error'>No Product found</div>";
        }
    }
}

?>
</div>
<?php include('partials-front/footer.php');?>