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
    <link rel="stylesheet" href="view/css/shop.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Shop</title>
</head>

<body>
    <div class="app">
        <?php include_once 'view/components/header.php'?>;
        <div class="container">
        <div class="grid">
                <div class="image__wrapper">
                    <img src="view/img/shop/Rectangle 2.svg" alt="" class="br">
                    <h2 class="image__title">CỬA HÀNG</h2>
                    <span class="image__breadcrum">Trang chủ / Cửa hàng</span>
                </div>
            <div class="grid">
                <!-- <div clas./detail.html="image__wrapper">
                    <img src="view/img/shop/Rectangle 2.svg" alt="" class="br">
                    <h2 class="image__title">SHOP</h2>
                    <span class="image__breadcrum">Home / Shop</span>
                </div> -->

                <div class="content spw">
                    <sidebar class="sidebar__filter-wrapper">
                        <div class="sidebar__filter">
                            <h2 class="sidebar__heading">Lọc theo giá</h2>
                            <div class="range-slider-container">
                                <input type="range" class="range-slider" />
                                <span id="range-value-bar"></span>
                                <span id="range-value">0</span>
                            </div>
                            <div class="spw">
                                <span class="sidebar__span">Giá: $7 - $56</span>
                                <button class="btn">TÌM</button>
                            </div>
                        </div>

                        <ul class="sidebar__category">
                            <h2 class="sidebar__heading">Danh mục sản phẩm</h2>
                            <?php 
                                $catergory_list = get_catergory_list();
                                foreach($catergory_list as $catergory) {
                                    $quantity = get_product_quantity_in_each_catergory($catergory['id']);
                            ?>
                                <li class="sidebar__category-item">
                                    <div class="sidebar__category-link" onclick="filter(this)" value=<?php echo $catergory['id']?> >
                                        <?php echo $catergory['catergory_name'] ?>
                                        <?php echo '(' .$quantity[0]. ')'?>
                                    </div>
                                </li>
                            <?php ; }?>
                        </ul>

                        <ul class="sidebar__tags">
                            <h2 class="sidebar__heading">Thẻ</h2>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Bình thường</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Cổ điển</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Sáng tạo</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Đồ gốm</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Thẩm mỹ</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Hằng ngày</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Sành điệu</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Trang trí</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Kiểu mới</a></li>
                            <li class="sidebar__tag-item"><a href="" class="sidebar__tag-link">Thời thượng</a></li>
                        </ul>
                    </sidebar>

                    <div class="products">
                        <div class="products__heading spw">
                            <div class="products__heading-left">
                                <a href="" class="products__heading-left-item"><img src="view/img/shop/Group.svg" alt="" class="products__heading-left-img"></a>
                                <a href="" class="products__heading-left-item"><img src="view/img/shop/🦆 icon _list_.svg" alt="" class="products__heading-left-img"></a>
                            </div>
                            <div class="products__heading-right">
                                <select name="" id="" class="products__heading-right-select">
                                    <option value="" class="products__heading-right-option">12</option>
                                </select>

                                <select name="" id="" class="products__heading-right-select">
                                    <option value="" class="products__heading-right-option">Default sorting</option>
                                </select>
                            </div>
                        </div>

                        <ul class="products__warpper">
                            <?php 
                            $pro =  isset($_GET['pro']) ? $_GET['pro'] : 1;
                            $offset = ((int)$pro -1) * 12;
                                $product_list =$conn->query("select * from product limit 12 offset " . $offset);
                                foreach( $product_list as $product){
                                $image_path = get_image_path($product['image_path']);
                            ?>
                                <li class="products__item">
                                    <a href="index.php?page=detail&id=<?php echo $product['id'] ?>">
                                        <img src=<?php echo $image_path ?> alt="" class="products__item-img">
                                        <span class="products__item-name">
                                            <?php echo $product['product_name']?>    
                                        </span>
                                        <span class="products__item-price">
                                            <?php echo $product['product_price']?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                        <ul class="products__pagenation">
                            <?php
                        $stmt = $conn->query("select * from product");
                        for ($i = 1; $i < ceil( $stmt->rowCount() / 11); $i++){
                        // echo '<a id="linkNum" href="?page=' . $i . '">' . $i . '</a>';
                        echo '<li class="products__pagenation-item"><a class="products__pagination-link" href="./index.php?page=shop&pro=' . $i . '">' . $i . '</a></li>';
                        }
                        ?>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
        
    </div>
    <?php include_once 'view/components/footer.php'?>;

    <script>
        let wrapper = $('.products__warpper'); 
        function filter(e){
            $.ajax({
                url: './api/api.php',
                data: {action: 'filter_catergory', catergory_id: e.getAttribute('value')},
                dataType: 'JSON',
                type: 'GET',
                success: function(result){
                    let html = '';
                    result.forEach(product => {
                        let image_path = "view/img/shop/" + product['image_path'];
                        html += `
                                    <li class="products__item">
                                        <a href="index.php?page=detail&id= ${product['id']}">
                                            <img src=${image_path} class="products__item-img">
                                            <span class="products__item-name">
                                                ${product['product_name']}
                                            </span>
                                            <span class="products__item-price">
                                                ${product['product_price']}
                                            </span>
                                        </a>
                                    </li>
                                `;    
                    });
                    wrapper.html(html);
                    html = '';
                }
            })
        }
        $('.sidebar__category-link').click(()=> {
        })
    </script>
    <script>
        const rangeSlider = document.querySelector('.range-slider');
        const rangeValueBar = document.querySelector('#range-value-bar');
        const rangeValue = document.querySelector('#range-value');

        let isDown = false;

        function dragHandler() {
        isDown = !isDown;
        if (!isDown) {
            rangeValue.style.setProperty('opacity', '0');
        } else {
            // rangeValue.style.setProperty('opacity', '1');
        }
        }

        function dragOn(e) {
        if (!isDown) return;
        rangeValueHandler();
        }

        function rangeValueHandler() {
        rangeValueBar.style.setProperty('width', `${rangeSlider.value}%`);
        rangeValue.style.setProperty('transform', `translateX(-${this.value}%)`);
        rangeValue.innerHTML = `${rangeSlider.value}%`;
        rangeValue.style.setProperty('left', `${rangeSlider.value}%`);
        }

        rangeValueHandler();
        rangeSlider.addEventListener('mousedown', dragHandler);
        rangeSlider.addEventListener('mousemove', dragOn);
        rangeSlider.addEventListener('mouseup', dragHandler);
        rangeSlider.addEventListener('click', rangeValueHandler);
    </script>

</body>

</html>
