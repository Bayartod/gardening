<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/10b2fd9b1a.js" crossorigin="anonymous"></script>
    <title>Green Thumb Gardening</title>
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php 
        require_once 'db.php';
        if(isset($_SESSION['uid'])){
            $sql = "SELECT COUNT(*) as total from cart WHERE cid=".$_SESSION['uid'];
            $res = mysqli_query($conn,$sql);

            $d = mysqli_fetch_assoc($res);
        }
        
    ?>
    <!-- Navigation Bar -->
    <nav class="primary-nav">
        <div class="nav-logo">
            <h1>Green Thumb Gardening</h1>
        </div>
        <div class="search-bar">
            <form action="#" method="post">
                <input type="text" id="search-input" placeholder="Search...">
            </form>
        </div>
        <div class="nav-buttons">
            <a href="https://twitter.com/"><i class="fab fa-twitter-square" style="font-size: 30px; color: white;"></i></a>
            <a href="https://www.facebook.com//"><i class="fab fa-facebook-square" style="font-size: 30px; color: white;"></i></a>
            <a href="https://www.instagram.com//?hl=en"><i class="fab fa-instagram" style="font-size: 30px; color: white;"></i></a>
        </div>
    </nav>

    <!-- Secondary Navigation Bar -->
    <nav class="secondary-nav">
        <ul>
            <li><a style="color: cornsilk;" href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="shop.php">Products</a></li>
            <li><a href="Blog.php">Blog</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if(isset($_SESSION['uid'])):?>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="cart.php"><i class="fa fa-shopping-basket" style="font-size: 15px; color: white;"></i>(<?php echo $d['total']?>)</a></li>
            <?php else:?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif?>
        </ul>
    </nav>