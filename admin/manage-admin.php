<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <strong>Admin-DashBoard</strong><br/><br>

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
            if(isset($_SESSION['not_matched']))
            {
                echo $_SESSION['not_matched'];
                unset($_SESSION['not_matched']);
            }
            if(isset($_SESSION['pw_not_matched']))
            {
                echo $_SESSION['pw_not_matched'];
                unset($_SESSION['pw_not_matched']);
            }
            if(isset($_SESSION['pw_changed']))
            {
                echo $_SESSION['pw_changed'];
                unset($_SESSION['pw_changed']);
            }
            ?>

            <table class="atable">
                <tr>
                    <th>Admin_ID</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email id</th>
                    <th>Phn no.</th>
                    <th>Action</th>
                </tr>

                <?php

                $sql = "SELECT * FROM admin_table";
                $res = mysqli_query($conn,$sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username =$rows['username'];
                            $email = $rows['email'];
                            $phn_no = $rows['phn_no'];

                            ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phn_no; ?></td>
                            <td>
                                <a href="<?php echo URL; ?>admin/password-admin.php?id=<?php echo $id ?>" class="PW-btn">Change Password</a> 
                                <a href="<?php echo URL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="UD-btn">Update</a> 
                                <a href = "<?php echo URL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="DLT-btn">Delete</a>
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
            
        <br/><a href="<?php echo URL; ?>admin/add-admin.php" class="btn">Add Admin</a><br/>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
    