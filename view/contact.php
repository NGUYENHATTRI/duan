<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/base.css">
    <link rel="stylesheet" href="view/css/contact.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/footer.css">

    <title>Liên hệ - Contact</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Trang chủ</title>

</head>

<body>
    
    <div class="contact">
    <?php include_once 'view/components/header.php'?>;
    <div class="container">
            <!-- <div class="slider">
                <div class="gird">
                    <h1 class="slider__title">LIÊN HỆ</h1>
                </div>
            </div> -->
        <div class="grid">
                <div class="image__wrapper">
                    <img src="view/img/shop/Rectangle 2.svg" alt="" class="br">
                    <h2 class="image__title">LIÊN HỆ</h2>
                    <span class="image__breadcrum">Trang chủ / Liên hệ</span>
                </div>
        <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4435923680976!2d106.62563435050585!3d10.853826360689895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bee0b0ef9e5%3A0x5b4da59e47aa97a8!2zQ8O0bmcgVmnDqm4gUGjhuqduIE3hu4FtIFF1YW5nIFRydW5n!5e0!3m2!1svi!2s!4v1679000632490!5m2!1svi!2s"  width="1290" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
        <div class="ourstore">
            <div class="grid">
            <div class="ourstore-title">
                    <H1>CỬA HÀNG CỦA CHÚNG TÔI</H1>
            </div>
            </div>     
         </div>
            <div class="contact_add">
                <!-- item1 -->
                <div class="item">

                    <div class="add_item">
                        <img src="view/img/Group 401.svg" width ="70px" height="70px"alt="">
                    </div>
                    <h3 class="add_heading">
                        ĐỊA CHỈ
                </h3>

                <div class="add_item">
                <img src="view/img/Line 16.png" width="70px" height="5px" alt="">
                </div>


                    <div class="add_subheading">
                        <p>Cơ sở 1: Số 9 Sao Mai, Phường 7, Tân Bình, TPHCM</p>
                    </div>
                </div>
                <!-- item2 -->
                <div class="item2">

                <div class="add_item">
                    <img src="view/img/Group 400.svg" width ="70px" height="70px"alt="">
                </div>
                <h3 style="color:#f5f5f5;" class="add_heading">
                    LIÊN HỆ VỚI CHÚNG TÔI
                </h3>

                <div class="add_item">
                <img src="view/img/Line 16 (1).png" width="70px" height="5px" alt="">
                </div>


                <div style="color:#f5f5f5;" class="add_subheading">
                <p>SĐT :01255645531</p>
                <p>SĐT :0269732881</p>
                </div>
                </div>
                <!-- item3 -->
                <div class="item">

                <div class="add_item">
                    <img src="view/img/Group 402.svg" width ="70px" height="70px"alt="">
                </div>
                <h3 class="add_heading">
                    EMAIL
                </h3>

                <div class="add_item">
                <img src="view/img/Line 16.png" width="70px" height="5px" alt="">
                </div>


                <div class="add_subheading">
                    <p>YGshop@gmail.com</p>
                    <p>YGshopmall@gmail.com</p>
                </div>
                </div>


            </div>

   
            <div class="ourstore">
            <div class="grid">
            <div class="ourstore-title">
                    <H1>LIÊN LẠC</H1>
            </div>
            </div>     
         </div>
        
        <div class="in4">
            <div class="name">
            <input type="text" name="your-name" class="input" value="" placeholder="Tên của bạn">
            </div>
            <div class="name">
                <input type="email" class="input"  placeholder="Địa chỉ email" >
            </div>
            <div class="name">
                <input type="text" class="input" placeholder="Vấn đề của bạn">
            </div>
            <div class="mess">
                <textarea name="your-message" cols="40" rows="10" placeholder="Trả lời của bạn"></textarea>
            </div>
            
            <button>GỬI TIN NHẮN</button>
        </div>
        
        </div>                
        <div class="gird">
                <div class="news">
                    <img src="view/img/Rectangle 178.png" alt="">
                    <img src="view/img/Rectangle 181.png" alt="">
                    <div class="news_email">
                         <div class="news_span">
                            <h2>TÌM HIỂU</h2>
                            <span>Hãy là người đầu tiên biết về hàng mới, giảm giá và khuyến mãi bằng cách gửi email của bạn!</span>
                         </div>
                         <div class="news_button">
                            <input type="text" placeholder="HÃY NHẬP EMAIL CỦA BẠN" class="btn__mail">
                            <button>ĐĂNG KÝ</button>
                         </div>
                    </div>
                </div>
            </div>
        <?php include_once 'view/components/footer.php'?>;
    
    </div>
</body>

</html>