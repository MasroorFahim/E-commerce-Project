<?php include('partials/menu.php');?>
<?php

$id = $_GET['pd_id'];

$sql= "SELECT * FROM product WHERE id=$id";
$res= mysqli_query($conn, $sql);
if($res==true)
{
    $count= mysqli_num_rows($res);
    if($count>0)
    {
        while($rows= mysqli_fetch_assoc($res))
        {
            $id = $rows['id'];
            $title = $rows['title'];
            $desc = $rows['description'];
            $image = $rows['image_name'];
            $price = $rows['price'];
            ?>
            <div class="login">
                <form action="" method="POST">
                    <h1 class="text-center">ORDER</h1>
                    <?php
                    if($image !="")
                    {?>
                        <img src="<?php echo URL; ?>UP Images/product/<?php echo $image; ?>" width = "100px" height="100px" alt="Product pic">
                    <?php
                    }
                    else
                    {
                        echo "<div class='error'>No Image Found</div>";
                    }
                    ?><br>
                    Product-Name: <?php echo $title;?><br>
                    Price: <?php echo $price;?>tk <br>
                    Description: <?php echo $desc;?><br>
                    <input type="hidden" id="price" value="<?php echo $price;?>">    

                        Quantity: <input type="number" name="qty" id="qty" value="1" required><br>
                        Total: <input type="text" id="total">
                        <button class="bttn" onclick="calculate()">Go</button><br>
                            <script>
                                function calculate() {
                                    var price = document.getElementById("price").value;
                                    var quantity = document.getElementById("qty").value;
                                    var total = parseFloat(price) * parseFloat(quantity);
                                    if (!isNaN(total)) {
                                        document.getElementById("total").value = total+" tk";
                                    }
                                }
                            </script>
                        <?php
                        $sql= "SELECT * FROM customer_info WHERE username='$cusername'";
                        $res= mysqli_query($conn, $sql);
                        
                            $count= mysqli_num_rows($res);
                            if($count>0)
                            {
                                while($rows= mysqli_fetch_assoc($res))
                                {
                                    $name = $rows['full_name'];
                                    $email = $rows['email'];
                                    $phn = $rows['phn_no'];
                                    $location = $rows['location'];
                                }
                            }
                        ?>
                        Name: <?php echo $name;?><br>
                        Phone no.: <?php echo $phn;?><br>
                        Location: <?php echo $location;?><br>
                        email: <?php echo $email;?><br><br>

                    

                    <input type="submit" name="submit" value="submit">

                </form>
            </div>
            <?php
            if(isset($_POST['submit']))
            {
                $qty= $_POST['qty'];
                $total = $qty*$price;
                $order_date = date("Y-m-d h:i:sa");
                $status = "ordered";
                
                $sql2 = "INSERT INTO order_table SET
                product= '$title',
                price= '$price',
                qnty= '$qty',
                total= '$total',
                order_date= '$order_date',
                status= '$status',
                customer_name= '$name',
                customer_contact= '$phn',
                customer_email= '$email',
                customer_address= '$location'
                
                ";
                $res2 = mysqli_query($conn, $sql2);
                if($res2==true)
                {
                    $_SESSION['order']="<div class='success'>Product ordered successfully</div>";
                    header('location:'.URL.'index.php');
                }
                else
                {
                    $_SESSION['order']="<div class='error'>ORDER DENIED</div>";
                    header('location:'.URL.'index.php');
                }
            }
        }
    }
}

include('partials/footer.php');?>