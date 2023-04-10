<header class="header">
    <div class="grid">
        <div class="header__logo">
            <a href="./index.php?page=index"><img src="view/img/Group 294.svg" alt="" class="img"></a>
            <!-- <img src="img/Group 294.svg" alt="" class="img"> -->
        </div>
        <ul class="header__nav">
            <li class="header__nav-item"><a href="./index.php?page=index" class="header__nav-link">TRANG CHỦ
                        <path
                            d="M0.8225 0.619141L3.5 3.5624L6.1775 0.619141L7 1.52525L3.5 5.38105L0 1.52525L0.8225 0.619141Z"
                            fill="#303030"/>
                    </svg></a></li>
            <li class="header__nav-item"><a href="index.php?page=blog" class="header__nav-link">BÀI VIẾT 
                        <path
                            d="M0.8225 0.619141L3.5 3.5624L6.1775 0.619141L7 1.52525L3.5 5.38105L0 1.52525L0.8225 0.619141Z"
                            fill="#303030" />
                    </svg></a></li>
            <li class="header__nav-item"><a href="./index.php?page=shop" class="header__nav-link">CỬA HÀNG</a></li>
            <li class="header__nav-item"><a href="" class="header__nav-link">VỀ CHÚNG TÔI</a></li>
            <li class="header__nav-item"><a href="./index.php?page=contact" class="header__nav-link">LIÊN HỆ</a></li>
            <?php 
            if(isset($_SESSION['user']['user_name'])){
                echo '<li style="color: #F598A4;text-transform:uppercase;font-weight: 600;font-size: 14px;" 
                class="header__nav-item "><a href="./index.php?page=user" style="color: #F598A4;">'.'XIN CHÀO '.$_SESSION['user']['user_name'].'</a></li>';
                // echo '<a href="./tranguser.php"><img class="imguser" src="../'.$_SESSION['img'].'"></a>';
            }
            else {
                // echo '<li class="header__nav-item"><a href="./index.php?page=login" class="header__nav-link">ADMIN</a></li>';
            }
            ?>

        </ul>
        <div class="header__action">
            <input type="text" class="input" id='input' style='margin-right:50px;'>
            <div class="search__result"></div>
            <a href="" class="header__action-item"><img src="view/img/search_icon.svg" alt=""></a>
            <?php 
                if (!isset($_SESSION['user'])): ?>
                <a href="./index.php?page=login" class="header__action-item"><img src="view/img/icon_user.svg" alt=""></a>
            <?php endif?>
            <a href="./index.php?page=cart" class="header__action-item"><img src="view/img/cart_icon.svg" alt=""></a>
            <a href="" class="header__action-item"><img src="view/img/hamburger menu.svg" alt=""></a>
            <?php 
                if (isset($_SESSION['cart'])): ?>
                <div class="bubble">
                    <span><?php echo count($_SESSION['cart'])?></span>
                </div>
            <?php endif?>
        </div>
    </div>
</header>

<script>
    $('.input').keyup(()=>{
        $.ajax({
            url: '../duan/api/api.php',
            data: {
                action: 'search',
                key_word:  $('.input').val()
            },
            type: 'GET',
            dataType: 'json',
            success: function (result){
                let html = '';
                if (result.length == 0 ){
                    html += '<a class="search__item">Không tìm thấy sản phẩm</a>';
                    $('.search__result').html(html);
                    return;
                }
                result.forEach(product => {
                    html += `
                        <a href="index.php?page=detail&id=${product.id}" class="search__item">
                            <img src="view/img/shop/${product.image_path}">
                            ${product.product_name}
                        </a>
                        `
                });
                $('.search__result').html(html);
            }
        })
    })
</script>
