<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <strong>DashBoard</strong>
            <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        }
        ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>