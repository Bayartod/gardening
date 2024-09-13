<?php
session_start();
require_once 'db.php';

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            $_SESSION['uid'] = $data['uid'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['name'] = $data['name'];

            header('location:../index.php');
        }
        else{
            $_SESSION['error'] = "Username or password invalid !!";
            header('location:../login.php');

        }
    }

    if(isset($_POST['register'])){
        $fname = $_POST['fname'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $query = "SELECT * FROM seller WHERE email = '$email'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 0){
            $query = "INSERT INTO seller(fullName,password,address,email,phone)
                VALUES('$fname','$password','$address','$email','$phone')";
                echo $query;
            $result = mysqli_query($conn,$query);
            if($result){
                $_SESSION['success'] = "Registered Successfully, please login to continue!!";
                header('location:../login.php');
            }
        }
        else{
            $_SESSION['error'] = "Email already taken, please use another email";
            header('location:../registration.php');
        }

    }
    if(isset($_POST['car_post'])){
		$error = false;
		$make = $_POST['make'];
		$model = $_POST['model'];
		$year = $_POST['year'];
		$milage = $_POST['milage'];
        $price = $_POST['price'];
		$location = $_POST['location'];
		$image = $_FILES['image']['name'];
		$target = "../img/".basename($image);
		$id = $_SESSION['seller_id'];

		$query = "INSERT INTO tblcar(make,model,year,milage,price,location,image,posted_by)
				VALUES ('$make','$model','$year','$milage','$price','$location','$image','$id')";
		if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
			mysqli_query($conn,$query);
		}
		else{
			$error = true;
			$_SESSION['error'] = "ERROR";
			header('location:../addCar.php');
		}
		if($error == false){
			$_SESSION['success'] = "Car has been posted";
			header('location:../cars.php');
		}
	}

?>