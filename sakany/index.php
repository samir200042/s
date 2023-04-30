<?php
    include "config/connect.php";
    session_start();
    
    
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }else{
        $user_id = '';
    }


        if(isset($_POST['book_now'])){


            $address = $_POST["address"];
            $address = filter_var($address, FILTER_SANITIZE_STRING);

            $price = $_POST["price"];
            $price = filter_var($price, FILTER_SANITIZE_STRING);

            $bads = $_POST["beds"];
            $bads = filter_var($bads, FILTER_SANITIZE_STRING);

            $image = $_POST["image"];
            $image = filter_var($image, FILTER_SANITIZE_STRING);



            $check_email = $conn->prepare("SELECT * FROM `users` WHERE user_id = ?");
            $check_email->execute([$user_id]);
            if($check_email->rowCount() > 0){
                $warning_msg[] = 'please login first!';
            }else{
                $insert_book = $conn->prepare("INSERT INTO `book`(address,price,image, beds) VALUES(?,?,?,?)");
                $insert_book->execute([$address,$price,$image,$bads]);
                $success_msg[] = "booked successfully!";
            }
        }


?>

<!DOCTYPE html>
<html lang="ar" xml:lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
/>
    <title>سكني</title>
</head> 
<body>
    

    <!-- section header start -->
        <header>
            <div class="container">
                <a href="index.php" class="logo"> <img src="images/header.jpg" alt=""></a>
                <nav class="navber">
                    <a href="index.php">الصفحة الرئيسية</a>
                    <a href="components/reports.php">التقارير والبيانات</a>
                    <a href="components/contact.php">تواصل معنا</a>
                    <a href="components/real_estate_market.php">السوق العقاري</a>
                    <a href="auth/register.php">تسجيل دخول</a>
                </nav>
                <div class="profile">
                    <i class="fa fa-user" id="user"></i>
                    <?php
                        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                        $select_profile->execute([$user_id]);
                        if($select_profile->rowCount() > 0) {
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                            ?>
                               <div class="user">
                                    <p>welcome: <span><?= $fetch_profile['name']?></span></p>
                                    <a href="auth/logout.php">logout</a>
                                </div>
                            <?php
                        }else{
                            ?>
                            <div class="user">
                                <p>Please login first.</p>
                                <a href="auth/logn.php" style="background-color:black;">login</a>
                            </div>
                    <?php
                        }
                    ?>
                </div>
                
                <i class="fa-solid fa-bars" id="menu"></i>
            </div>
        </header>


        <section class="hero">
            <div class="swiper hero-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slide">
                        <div class="contact">
                            <span>خصم %40</span>
                            <h3>عمارة</h3>
                            <a href="components/menu.php" class="btn">احجز الان</a>
                        </div>
                        <div class="image">
                            <img src="images/pexels-photo-250659.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide slide">
                        <div class="contact">
                            <span>خصم %40</span>
                            <h3>مجمع سكني</h3>
                            <a href="components/menu.php" class="btn">احجزالان</a>
                        </div>
                        <div class="image">
                            <img src="images/pexels-photo-356809.jpg" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide slide">
                        <div class="contact">
                            <span>خصم %40</span>
                            <h3>شقة</h3>
                            <a href="components/menu.php" class="btn">احجزالان</a>
                        </div>
                        <div class="image">
                            <img src="images/pexels-photo-542403.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    
    
  

    <section class="projects">
        <h1 class="heading">المشاريع الأكثر رواجا</h1>
        <div class="container">
            <?php 
                $select_products = $conn->prepare("SELECT * FROM `property` LIMIT 4");
                $select_products->execute();

                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                        ?>
                           <form action="#" method="post">
                               <input type="hidden" value="<?= $fetch_products['id']?>" name="id">
                               <input type="hidden" value="<?= $fetch_products['address']?>" name="address">
                               <input type="hidden" value="<?= $fetch_products['price']?>" name="price">
                               <input type="hidden" value="<?= $fetch_products['image']?>" name="image">
                                <div class="box-projects">
                                    <img src="admin/uploaded_files/<?= $fetch_products['image']?>" alt="">
                                    <div class="info-project">
                                        <p class="address"><?= $fetch_products['address']?></p>
                                        <p class="price">جنية <?= $fetch_products['price']?></p>
                                        <div class="dropdown">
                                            <input type="number" class="output" placeholder="?كم سرير" name="beds" maxlength="20" min="1" max="10">
                                        </div>
                                        <input type="submit" class="btn" value="احجز الان" name="book_now">
                                    </div>
                                </div>
                            </form>
                        <?php
                    }
                }else{
                    echo '<p class="empty">no product added yet</p>';
                }
            ?>
        </div>
    </section>



    <section class="onsearch">
        <div class="container-onsearch">
            <div class="box">
                <h1>ابحث عن المزيد من المشاريع في السوق</h1>
                <button class="btn">قم بزيارة السوق</button>
            </div>
        </div>
    </section>


    

    <div class="copy">
        <h1>جميع الحقوق محفوظة لشركة سكني © 2023 - تطوير وتشغيل الشركة الوطنية للإسكان</h1>
    </div>


    <!-- js file -->
        <script src="script/script.js"></script>

          <!-- link swiper js -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".hero-slider", {
            loop: true,
            grabCursor: true,
            effect: "flip",
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
          });
    </script>
        <!-- sweetalert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "aleat.php";
    ?>
</body>
</html>




