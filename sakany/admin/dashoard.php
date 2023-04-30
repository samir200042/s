<?php
    include "../config/connect.php";
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!$admin_id){
        header("location:../auth/logn.php");
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

    <title>صفحة التحكم</title>
</head>
<body>
            <!-- section header start -->
            <header>
            <div class="container">
                <a href="#" class="logo"> <img src="../images/header.jpg" alt=""></a>
                <nav class="navber">
                    <a href="dashoard.php">الصفحة الرئيسية</a>
                    <a href="messages.php">الرسايل</a>
                    <a href="add_property.php">ضيف عقاري</a>
                </nav>
                <div class="profile">
                    <i class="fa fa-user" id="user"></i>
                    <?php
                        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                        $select_profile->execute([$admin_id]);
                        if($select_profile->rowCount() > 0) {
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                            ?>
                               <div class="user">
                                    <p>admin: <span><?= $fetch_profile['name']?></span></p>
                                    <a href="../auth/logout.php">logout</a>
                                </div>
                            <?php
                        }else{
                        }
                    ?>
                </div>
                
                <i class="fa-solid fa-bars" id="menu"></i>
            </div>
        </header>





            <section>
                <div class="container">
                    <div class="box">
                        admins 1
                    </div>
                    <div class="box">
                        users 2
                    </div>
                    <div class="box">
                       messages 0
                    </div>
                    <div class="box">
                       add property 0
                    </div>
                </div>
            </section>









        <script src="../script/script.js"></script>
</body>
</html>
