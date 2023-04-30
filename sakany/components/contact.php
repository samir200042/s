<?php
    include "../config/connect.php";


    if(isset($POST['send_message'])) {
        $success_msg[] = "ok";
        echo "ok";
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
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
        />
    <title>سكني || تواصل </title>
</head>

<body>


    <!-- section header start -->
    <header>
        <div class="container">
            <a href="index.php" class="logo"> <img src="../images/header.jpg" alt=""></a>
            <nav class="navber">
                <a href="../index.php">الصفحة الرئيسية</a>
                <a href="reports.php">التقارير والبيانات</a>
                <a href="contact.php">تواصل معنا</a>
                <a href="real_estate_market.php">السوق العقاري</a>
                <a href="../auth/register.php">تسجيل دخول</a>
            </nav>


            <i class="fa-solid fa-bars" id="menu"></i>
        </div>
    </header>
<!-- section header ends -->

    <section class="email_us">
        <h1 class="heading">ارسل لنا عبر البريد الإلكتروني</h1>
        <p class="email">يرجى ملء النموذج ، حتى نتمكن من خدمتك بشكل أفضل</p>
        <div class="form-container">
            <form action="#" class="box" method="post">
                <p>نوع الاستفسار <span>*</span></p>
                <input type="text" placeholder="نوع الاستفسار" name="inpuiry" required class="input">
                <p>أسم المستفيد<span>*</span></p>
                <input type="text" name="name" id="" placeholder="أسم المستفيد" required>
                <p>رقم التليفون <span>*</span></p>
                <input type="number" name="phone" id="" placeholder="رقم التليفون " required>
                <p>الاميل</p>
                <input type="email" name="email" id="" placeholder="الاميل" required>
                <p>منطقة <span>*</span></p>
                <input type="text" name="region" id="" placeholder="منطقة">
                <p>مدينة <span>*</span></p>
                <input type="text" name="city" id="" placeholder="مدينة">
                <p>رسالة <span>*</span></p>
                <textarea name="message" id="" cols="30" rows="10" placeholder="رسالة"></textarea>
                <input type="submit" value="send message" class="btn" name="send_message">
            </form>
        </div>
    </section>


 

    <div class="copy">
        <h1>جميع الحقوق محفوظة لشركة سكني © 2023 - تطوير وتشغيل الشركة الوطنية للإسكان</h1>
    </div>


    <!-- js file -->
    <script src="../script/script.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
       include "../aleat.php";
    ?>

    
</body>

</html>