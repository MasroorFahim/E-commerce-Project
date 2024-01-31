<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <strong>Product-DashBoard</strong><br/><br>

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>


            <table class="atable">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category ID</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Seller</th>
                    <th>Action</th>
                </tr>

                <?php

                $sql = "SELECT * FROM product";
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $pd_name = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image = $rows['image_name'];
                            $ctg_id = $rows['category_id'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                            $seller = $rows['seller_name'];

                            ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $pd_name; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $price; ?>tk</td>
                            <td><?php 

                            if($image !="")
                            {
                                ?>
                                <img src="<?php echo URL; ?>UP Images/product/<?php echo $image; ?>" width = "100px" alt="Product_pic">
                                <?php
                            }
                            else
                            {
                                echo "<div class ='error'>Image not selected</div>";
                            }
                            ?></td>
                            <td><?php echo $ctg_id; ?></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td><?php echo $seller; ?></td>
                            <td>
                                <a href="<?php echo URL; ?>admin/update-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="UD-btn">Update</a> 
                                <a href = "<?php echo URL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="DLT-btn">Delete</a>
                            </td>
                        </tr>

                            <?php
                        }
                    }
                    else
                    {

                    }
                }

                ?>

            </table>
            
        <br/><a href="<?php echo URL;?>admin/add-product.php" class="btn">Add Product</a><br/>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
    