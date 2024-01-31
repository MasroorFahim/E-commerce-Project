<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <strong>Order-DashBoard</strong><br/><br>

            <table class="atable">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order-Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer email</th>
                    <th>Customer address</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql= "SELECT * FROM order_table";
                    $res= mysqli_query($conn, $sql);
                    if($res==true)
                    {
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id= $rows['id'];
                                $pd_name= $rows['product'];
                                $price= $rows['price'];
                                $qty= $rows['qnty'];
                                $total= $rows['total'];
                                $date= $rows['order_date'];
                                $status= $rows['status'];
                                $cname= $rows['customer_name'];
                                $contact= $rows['customer_contact'];
                                $email= $rows['customer_email'];
                                $address= $rows['customer_address'];
                                ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $pd_name; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $cname; ?></td>
                                    <td><?php echo $contact; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $address; ?></td>
                                    <td>
                                        <a href = "<?php echo URL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="UD-btn">Update</a> 
                                        <a href = "<?php echo URL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="DLT-btn">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                ?>
            </table>
</div>
    </div>

<?php include('partials/footer.php'); ?>