<?php
    include "../config/connect.php";
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!$admin_id){
        header("location:../auth/logn.php");
    }

    if(isset($_POST['add'])){
        
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);


        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_files/'.$image;


        if(!empty($image)){
            if($image_size > 20000000){
                $warning_msg[] = "image size is too large!";
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }



        $select_product = $conn->prepare("SELECT * FROM `property` WHERE address = ?");
        $select_product->execute([$address]);

        if($select_product->rowCount() > 0){
            $warning_msg[] = "product already added!";
        }else{
            $insert_product = $conn->prepare("INSERT INTO `property`(price,address,image) VALUES(?,?,?)");
            $insert_product->execute([$price, $address, $image]);
            $success_msg[] = 'product successfully!';
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

    <title>  ضيف عقاري || صفحة التحكم</title>
</head>
<body>
            <!-- section header start -->
            <header>
            <div class="container">
                <a href="#" class="logo"> <img src="../images/header.jpg" alt=""></a>
                <nav class="navber">
                    <a href="dashoard.php">الصفحة الرئيسية</a>
                    <a href="messages.php">الرسائل</a>
                    <a href="add_property.php">إضافة عقار</a>
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


                <section class="add">
                    <form action="#" method="post" enctype="multipart/form-data">
                            <h1> إضافة عقار</h1>
                        <input type="text" placeholder=" العنوان" name="address" required>
                        <input type="number" placeholder="السعر" name="price" required>
                        <input type="file" name="image" action="images/*" required>
                        <input type="submit" value="إضافة عقار" name="add">
                        </form>
                </section>


        <script src="../script/script.js"></script>
        
              <!-- sweetalert -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "../aleat.php";
    ?>
</body>
</html>
