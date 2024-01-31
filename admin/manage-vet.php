<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <strong>Vet-DashBoard</strong><br/><br>

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
                    <th>Vet_ID</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email id</th>
                    <th>Phn no.</th>
                    <th>Qualification</th>
                    <th>Action</th>
                </tr>

                <?php

                $sql = "SELECT * FROM vet_table";
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
                            $quali = $rows['qualification'];

                            ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phn_no; ?></td>
                            <td><?php echo $quali; ?></td>
                            <td> 
                                <a href="<?php echo URL; ?>admin/update-vet.php?id=<?php echo $id ?>" class="UD-btn">Update</a> 
                                <a href = "<?php echo URL; ?>admin/delete-vet.php?id=<?php echo $id; ?>" class="DLT-btn">Delete</a>
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
            
        <br/><a href="<?php echo URL; ?>admin/add-vet.php" class="btn">Add Vet</a><br/>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>