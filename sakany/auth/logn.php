<?php
    include '../config/connect.php';
    session_start();
  
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }else{
        $user_id = '';
    }

    if(isset($_POST['login'])){
         $email = $_POST['email'];
         $email = filter_var($email, FILTER_SANITIZE_STRING);
         $password = $_POST['password']; // sh1() this is code hidden password in your mysql;
         $password = filter_var($password, FILTER_SANITIZE_STRING);


        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?"); // علشان احدد اليوزرز 
        $select_user->execute([$email, $password]);


       if($select_user->rowCount() > 0){ 
           $fetch = $select_user->fetch(PDO::FETCH_ASSOC);

            if($fetch['type_user'] == 'student'){
                $_SESSION['user_id'] = $fetch['id'];
                header("location:../index.php");

            }elseif($fetch['type_user'] == 'admin'){
                $_SESSION['admin_id'] = $fetch['id'];
                header('location: ../admin/dashoard.php');
            }
        }else{
            $warning_msg[] = "password or email is wrong!";
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
    <title>سكني || تسجيل الدخول</title>
</head> 
<body>
    

    <!-- section header start -->
        <header>
            <div class="container">
                <a href="../index.php" class="logo"> <img src="../images/header.jpg" alt=""></a>
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
                <h3>تسجيل الدخول الآن</h3>
                <div class="container-form ">
                    <p>الاميل<span>*</span></p>
                    <input type="email" name="email" placeholder="اميلك" class="input" required>
                    <p>كلمة المرور<span>*</span></p>
                    <input type="password" name="password" placeholder="كملة المرور" required>
                    <button class="btn" name="login">Login</button>
                    <p class="link">ليس لديك حساب؟ <a href="register.php" class="login">سجل الان</a></p>
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