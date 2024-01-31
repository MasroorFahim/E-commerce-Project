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
                    <th>Qualification</th>
                    <th>Status</th>
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
                            $quali = $rows['qualification'];

                            ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $quali; ?></td>
                            <td><?php  ?></td>
                            <td> 
                                <a href="<?php echo URL; ?>admin/update-vet.php?id=<?php echo $id ?>" class="UD-btn">Chat</a>
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
        </div>
    </div>

    <?php include('partials/footer.php'); ?>