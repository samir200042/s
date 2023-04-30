
<?php
    include '../config/connect.php';
    session_start();
  
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }else{
        $user_id = '';
    }

    if(isset($_POST['register'])){
       $name = $_POST['name']; //علشان اعرف الاسم 
       $name = filter_var($name, FILTER_SANITIZE_STRING); //علشان اعرف الاسم 
       $phone = $_POST['phone']; 
       $phone = filter_var($phone, FILTER_SANITIZE_STRING);
       $email = $_POST['email'];
       $email = filter_var($email, FILTER_SANITIZE_STRING);
       $password = $_POST['password']; // (sh1) this is code hidden password in your mysql;
       $password = filter_var($password, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?"); // علشان احدد اليوزرز 
        $select_user->execute([$email]);

        if($select_user->rowCount() > 0){ 
            $warning_msg[] = "your email is created!";
        }else{
            $insert_user = $conn->prepare("INSERT INTO users(name,email, password,phone)VALUES(?,?,?,?)");
            $insert_user->execute([$name,$email,$password,$phone]);
            $success_msg[] = 'your email is create successfully!';
            header("location: logn.php");
        }


    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Sakany || Register</title>
</head> 
<body>
    

    <!-- section header start -->
    <header>
        <div class="container">
            <a href="index.php" class="logo"> <img src="../images/header.jpg" alt=""></a>
            <nav class="navber">
                <a href="../index.php">الصفحة الرئيسية</a>
                <a href="../components/reports.php">التقارير والبيانات</a>
                <a href="../components/real_estate_market.php">سوق العقارات</a>
                <a href="../components/contact.php">تواصل معنا</a>
                <a href="register.php"> تسجيل دخول</a>
            </nav>
            <i class="fa-solid fa-bars" id="menu"></i>
        </div>
    </header>
<!-- section header ends -->

    <!-- section form register start -->
        <section class="form">
            <form action="#" method="post" class="box"> 
                <h3>سجل الان</h3>
                <div class="container-form ">
                    <p>اسمك<span>*</span></p>
                    <input type="text" name="name" placeholder="اسم المستخدم" class="input" required>
                    <p>رقم التلفون<span>*</span></p>
                    <input type="number" name="phone" placeholder=" رقم التلفون" class="input" required>
                    <p>الاميل<span>*</span></p>
                    <input type="email" name="email" placeholder=" الاميل" class="input" required>
                    <p>كملة المرور<span>*</span></p>
                    <input type="password" name="password" placeholder=" كمله المرور" required>
                    <button class="btn" name="register">سجل الان</button>
                    <p class="link"> لديك حساب؟<a href="logn.php" class="login">تسجيل الدخول الآن</a></p>
                </div>
            </form>
        </section>
    <!-- section form register ends -->


    <!-- js file -->
        <script src="../script/script.js"></script>

              <!-- sweetalert -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "../aleat.php";
    ?>
</body>
</html>