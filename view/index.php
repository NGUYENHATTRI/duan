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
    <link rel="stylesheet" href="view/css/style.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Trang chủ</title>
</head>

<body>
    <div class="app">

        <?php include_once 'view/components/header.php'?>;
        <div class="container">
            <div class="slider">
                <div class="content">
                    <h1 class="slider__title">SẢN PHẨM KẾT TINH TỪ
                        <br>SỰ TÂM HUYẾT
                    </h1>
                    <h3 class="slider__subtitle"><img class="mr-vector" src="view/img/Vector 1.svg" alt="">Một bộ 3 sản phẩm
                        với các kích thước khác nhau nằm chung tạo nên 1 bộ sản phẩm<br>nội thất hoàn hảo.</h3>
                    <a href="./index.php?page=shop"><button class="btn">XEM THÊM</button></a>
                </div>
            </div>

            <div class="category">
                <div class="grid">
                    <div class="category__item" style="background-image: url(view/img/obc-gift-set-410x260\ 1-1.svg);">
                        <a href="./index.php?page=shop" class="category__link">
                            <h2 class="category__title">Đèn<br>Lòng</h2>
                            <h3 class="category__subtitle"><img src="view/img/Line 19.svg" alt="" class="mr-vector">Gifset
                            </h3>
                            <span class="category-item--hover">Xem thêm</span>
                        </a>
                    </div>
                    <div class="category__item" style="background-image: url(view/img/obc-gift-set-410x260\ 1.svg);">
                        <a href="./index.php?page=shop" class="category__link">
                            <h2 class="category__title">Cốc<br>Trang Trí</h2>
                            <h3 class="category__subtitle"><img src="view/img/Line 19.svg" alt="" class="mr-vector">Gifset
                            </h3>
                            <span class="category-item--hover">Xem thêm</span>
                        </a>
                    </div>
                    <div class="category__item" style="background-image: url(view/img/obc-table-deco-410x260\ 1.svg);">
                        <a href="./index.php?page=shop" class="category__link">
                            <h2 class="category__title">Chậu<br>trồng cây</h2>
                            <h3 class="category__subtitle"><img src="view/img/Line 19.svg" alt="" class="mr-vector">Table
                                decor</h3>
                            <span class="category-item--hover">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="workshop">
                    <img class="workshop__img" src="view/img/Frame 12.svg">
                    <div class="workshop__content-wrapper">
                        <h2 class="category__title workshop__title">WORKSHOP IN OUR<br>CERAMIC STUDIO</h2>
                        <h3 class="category__subtitle workshop__subtitle"><img src="view/img/Line 19.svg" alt=""
                                class="mr-vector">Sản phẩm được sản xuất từ YG shop luôn đảm bảo chất lượng,<br>niềm vui
                            của quý khách là hạnh phuc của chúng tôi</h3>
                        <a href="./index.php?page=shop"><button class="btn">Xem thêm</button></a>
                    </div>
                </div>
            </div>

            <div class="new-product">
                <div class="grid">
                    <h2 class="product__title">SẢN PHẨM MỚI</h2>
                <?php
                $product_list = $conn->query('SELECT * FROM product where kho_hang >= 0 limit 7')->fetchAll();
                $i = 0;
                foreach($product_list as $product){
                    $image_path = "view/img/shop/" . $product['image_path'];
                    if ($i == 0 ){?>
                        <div class="product__wrapper product__wrapper--huge">
                            <a href="index.php?page=detail&id=<?php echo $product['id'] ?>"><img src="<?php echo $image_path ?>" alt="" class="product__img" style="height: 308px"></a>
                            <span class="product__name"><?php echo $product['product_name']?></span>
                            <span class="product__price"><?php echo $product['product_price']?></span>
                        </div>
                    <?php $i++;}else {?>
                    <div class="product__wrapper">
                    <a href="index.php?page=detail&id=<?php echo $product['id'] ?>"><img src="<?php echo $image_path ?>" alt="" class="product__img" style="height: 308px"></a>
                            <span class="product__name"><?php echo $product['product_name']?></span>
                            <span class="product__price"><?php echo $product['product_price']?></span>
                    </div>
                    <?php }}?>
                </div>
            </div>

            <div class="grid">
                <div class="voucher" style="background-image: url('view/img/image\ 16.svg');">
                    <h2 class="voucher__title">THỜI HẠN GIẢM<br>GIÁ CÒN</h2>
                    <div class="voucher__content-wrapper">
                        <img src="view/img/Line 21.svg" alt="" class="voucher__vector">
                        <div class="voucher__content">
                            <span class="voucher__time">12 : 24</span>
                            <h3 class="voucher__sale">Sale 30%</h3>
                        </div>
                    </div>
                    <a href="./index.php?page=shop"><button class="btn">Xem thêm</button></a>
                </div>
            </div>

            <div class="hot-product">
                <div class="grid">
                <h2 class="product__title">SẢN PHẨM HOT</h2>
                <?php
                $product_list = $conn->query('SELECT * FROM product  where kho_hang >= 1  ORDER BY id DESC limit 8 ')->fetchAll();
                foreach($product_list as $product){
                    $image_path = "view/img/shop/" . $product['image_path'];
                ?>
                    <div class="product__wrapper">
                    <a href="index.php?page=detail&id=<?php echo $product['id'] ?>"><img src="<?php echo $image_path ?>" alt="" class="product__img" style="height: 308px"></a>
                        <span class="product__name"><?php echo $product['product_name']?></span>
                        <span class="product__price"><?php echo $product['product_price']?>
                        </div>
                <?php }?>
                </div>
            </div>

            <div class="grid">
                <h2 class="article__h2">
                    Tin tức
                </h2>
                <div class="article" style="background-image: url('view/img/Group\ 393.svg');">
                    <span class="article__author">By: admin</span>
                    <h2 class="article__heading">THE KEY IS VICTORY WAS<br>CREATING ROUTINES</h2>
                    <span class="article__subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</span>
                    <a href="index.php?page=blog"><button class="btn">Đọc thêm</button></a>
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
        </div>

        <?php include_once 'view/components/footer.php'?>;
    </div>
</body>

</html>
</html>