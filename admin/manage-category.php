<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <strong>Category-DashBoard</strong><br/><br>

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
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Image Name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php

                $sql = "SELECT * FROM category";
                $res = mysqli_query($conn,$sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $ctg_name = $rows['title'];
                            $image =$rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $ctg_name; ?></td>
                            <td><?php 

                            if($image !="")
                            {
                                ?>
                                <img src="<?php echo URL; ?>UP Images/Category/<?php echo $image; ?>" width = "100px" alt="Category_pic">
                                <?php
                            }
                            else
                            {
                                echo "<div class ='error'>Image not selected</div>";
                            }
                            ?></td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href = "<?php echo URL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="UD-btn">Update</a> 
                                <a href = "<?php echo URL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="DLT-btn">Delete</a>
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
            
        <br/><a href="<?php echo URL;?>admin/add-category.php" class="btn">Add Category</a><br/>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
    