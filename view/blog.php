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
    <link rel="stylesheet" href="view/css/blog.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/footer.css">
    <title>Bài viết-Blog</title>
</head>

<body>
    <div class="app">

        <?php include_once 'view/components/header.php' ?>
        <div class="container">
        <div class="grid">    
        <div class="image__wrapper">
                    <img src="view/img/shop/Rectangle 2.svg" alt="" class="br">
                    <h2 class="image__title">BÀI VIẾT</h2>
                    <span class="image__breadcrum">Trang chủ / Bài viết</span>
                </div>
        </div>
            </div>
          
            <div class="grid">
            <?php               
                                
                                $post_list = get_post_list();
                                foreach($post_list as $post){
                                $image_path = get_image_path($post['image_path']);
                            ?>
                <div class="article">
                    
                    <span class="article__author">By: admin</span>

                    <h2 class="article__heading"> <?php echo $post['title']?> </h2>
                    <span class="article__subheading"> <?php echo $post['content']?> </span>
                    <a href="index.php?page=blogdetail&id=<?php echo $post['id']?>"><button class="btn" >Đọc thêm</button></a>
                    
                    <div class="post_item-img">
                    <img src="<?php echo  $image_path ?>" alt="">
                    </div>
                </div>
                <?php } ?>
            </div>
            
                                    
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
</html>