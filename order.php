<?php include('partials-front/menu.php');?>
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
                        Name: <input type="text" name="cus_name" placeholder= "Enter your full-name" required><br>
                        Phone no.: <input type="tel" name="contact" placeholder= "Enter your contact no." required><br>
                        Location: <input type="text" name="location" placeholder= "Enter your Location" required><br>
                        email: <input type="email" name="email" placeholder= "Enter your email" required><br><br>

                    

                    <input type="submit" name="submit" value="submit">

                </form>
            </div>
            <?php
            if(isset($_POST['submit']))
            {
                $qty= $_POST['qty'];
                $total = $qty*$price;
                $order_date = date("Y-m-d h:i:sa");
                $c_name= $_POST['cus_name'];
                $contact= $_POST['contact'];
                $address= $_POST['location'];
                $email = $_POST['email'];
                $status = "ordered";
                
                $sql2 = "INSERT INTO order_table SET
                product= '$title',
                price= '$price',
                qnty= '$qty',
                total= '$total',
                order_date= '$order_date',
                status= '$status',
                customer_name= '$c_name',
                customer_contact= '$contact',
                customer_email= '$email',
                customer_address= '$address'
                
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

include('partials-front/footer.php');?>