<?php 
  $price_arr = $conn->query("SELECT sum(total_money) as 'sum', date FROM bill WHERE status = 'Hoàn tất' GROUP BY date ORDER BY date")->fetchAll();
  $date_arr = $conn->query("SELECT date FROM bill WHERE status = 'Hoàn tất' GROUP BY date ORDER by date")->fetchAll();


  $user_count = $conn->query("SELECT count(*) as 'quantity' from user")->fetch();
  $bill_count = $conn->query("SELECT count(*) as 'quantity' from bill")->fetch();
  $product_count = $conn->query("SELECT count(*) as 'quantity' from product")->fetch();

  $bill_list = $conn->query('SELECT * FROM bill ORDER BY id DESC LIMIT 4;')->fetchAll();  
  $user_list = $conn->query('SELECT * FROM user ORDER BY id DESC LIMIT 4')->fetchAll();
  
  $product_almost_run_out = $conn->query("SELECT count(*) as 'quantity' FROM product WHERE kho_hang <= 5")->fetch();
 
  $catergory_data =  $conn->query("SELECT count(*) as 'stock', catergory_name from product JOIN catergory ON product.catergory_id = catergory.id GROUP BY catergory_id")->fetchAll();
  $sale_data = $conn->query("SELECT count(*) as 'sale' , catergory_name from bill_detail JOIN product ON bill_detail.product_id = product.id JOIN catergory ON product.catergory_id = catergory.id GROUP BY product.catergory_id")->fetchAll();
  function change_status_background($status){
    if ($status == 'Đang xử lý') {
        return "badge bg-info";
    }
    if ($status == 'Hoàn tất') {
        return "badge bg-success";
    }
    if ($status == 'Đã hủy') {
        return "badge bg-danger";
    }
    if ($status == 'Đang giao hàng') {
        return "badge bg-warning";
    }
  }

  if(!isset($_SESSION['user'])){
    header('location: ../index.php?page=index');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách nhân viên | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="view/css/admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="../model/log_out.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo '../view/img/user/'.$_SESSION['user']['img']?>" width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b><?php echo $_SESSION['user']['user_name']?></b></p>
        <!-- <p class="app-sidebar__user-name"><b></b></p> -->
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item active" href="./index.php?page=index"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item " href="./index.php?page=user&action=list"><i class='app-menu__icon bx bx-id-card'></i> <span
            class="app-menu__label">Quản lý nhân viên</span></a></li>

      <!-- <li><a class="app-menu__item" href="./index.php?page=user&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li> -->

      <li><a class="app-menu__item " href="./index.php?page=post&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span

            class="app-menu__label">Quản lý bài viết</span></a></li>
      <!-- <li><a class="app-menu__item " href="./index.php?page=TA_cmt&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý bình luận</span></a></li>  -->
      
      
      <li><a class="app-menu__item" href="./index.php?page=catergory&action=list"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý danh mục</span></a></li>
      <li><a class="app-menu__item" href="./index.php?page=product&action=list"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item" href="./index.php?page=bill&action=list"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
    </ul>
  </aside>
  <main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><b>Bảng điều khiển</b></a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--Left-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
       <!-- col-6 -->
       <div class="col-md-6">
        <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
          <div class="info">
            <h4>Tổng khách hàng</h4>
            <p><b><?php echo $user_count['quantity']?> khách hàng</b></p>
            <p class="info-tong">Tổng số khách hàng được quản lý.</p>
          </div>
        </div>
      </div>
       <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
              <div class="info">
                <h4>Tổng sản phẩm</h4>
                <p><b><?php echo $product_count['quantity']?> sản phẩm</b></p>
                <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
              </div>
            </div>
          </div>
           <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
              <div class="info">
                <h4>Tổng đơn hàng</h4>
                <p><b><?php echo $bill_count['quantity']?> đơn hàng</b></p>
                <p class="info-tong">Tổng số hóa đơn bán hàng.</p>
              </div>
            </div>
          </div>
           <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
              <div class="info">
                <h4>Sắp hết hàng</h4>
                <p><b><?php echo $product_almost_run_out['quantity']?></b></p>
                <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
              </div>
            </div>
          </div>
           <!-- col-12 -->
           <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Đơn hàng mới nhất</h3>
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID đơn hàng</th>
                      <th>Tên khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach($bill_list as $bill):
                        $class_name = change_status_background($bill['status']);
                    ?>
                        <tr>
                          <td><?php echo $bill['maDH'] ?></td>
                          <td><?php echo $bill['user_name'] ?></td>
                          <td>
                              <?php echo $bill['total_money'] ?> 
                          </td>
                          <td><span class="<?php echo $class_name ?>"><?php echo $bill['status']?></span></td>
                        </tr>
                      <?php endforeach;?>
                </table>
              </div>
              <!-- / div trống-->
            </div>
           </div>
            <!-- / col-12 -->
             <!-- col-12 -->
            <div class="col-md-12">
                <div class="tile">
                  <h3 class="tile-title">Khách hàng mới</h3>
                <div>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach($user_list as $user) :
                      ?>
                        <tr>
                          <td><?php echo $user['id'] ?></td>
                          <td><?php echo $user['user_name'] ?></td>
                          <td><?php echo $user['email'] ?></td>
                          <td><span class="tag tag-success">0921387221</span></td>
                        </tr>
                      <?php endforeach?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
             <!-- / col-12 -->
        </div>
      </div>
      <!--END left-->
      <!--Right-->
      <div class="col-md-12 col-lg-6">
        <input type="date" class="start">
        <input type="date" class="end">
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Thống kê doanh thu theo từng ngày</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Số lượng bán được theo từng doanh mục</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChartDemo2"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!--END right-->
    </div>


    <div class="text-center" style="font-size: 13px">
      <p><b>
          <script type="text/javascript">
            
          </script> 
        </b></p>
    </div>
  </main>
  <script src="../doc/js/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="../doc/js/popper.min.js"></script>
  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
  <!--===============================================================================================-->
  <script src="../doc/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="../doc/js/main.js"></script>
  <!--===============================================================================================-->
  <script src="../doc/js/plugins/pace.min.js"></script>
  <!--===============================================================================================-->
  <!-- <script type="text/javascript" src="../doc/js/plugins/chart.js"></script> -->
  <!--===============================================================================================-->
  <script type="text/javascript">

    let start = '';
    $('.start').change(()=>{
      start = $('.start').val();
    })

    $('.end').change(()=>{
      console.log($('.end').val());
      $.ajax({
        url: '../api/api.php',
        data: {
            action: 'get_chart_data',
            start : start,
            end: $('.end').val()
        },
        type: 'GET',
        dataType: 'json',
        success: function (result){
          myChart.config.data.labels = result.map(bill => bill['date']);
          myChart.config.data.datasets.data = result.map(bill => bill['sum']);
          myChart.update();
        }
    })
    })


    let priceData = <?php echo json_encode($price_arr) ?>;
    let price = priceData.map(price => price['sum']);
    let dateData = <?php echo json_encode($date_arr) ?>;
    let date = dateData.map(date => date['date']);

    let catergoryData = <?php echo json_encode($catergory_data)?>;
    
    let catergoryName = catergoryData.map(catergory => catergory['catergory_name']);
    let stock = catergoryData.map(catergory => catergory['stock']);
    let saleData = <?php echo json_encode($sale_data)?>;
    console.log(saleData);
    let sale = saleData.map(sale => sale['sale']);
    // var data = {
    //   labels: date,
    //   datasets: [{
    //     label: "Dữ liệu đầu tiên",
    //     fillColor: "rgba(255, 213, 59, 0.767), 212, 59)",
    //     strokeColor: "rgb(255, 212, 59)",
    //     pointColor: "rgb(255, 212, 59)",
    //     pointStrokeColor: "rgb(255, 212, 59)",
    //     pointHighlightFill: "rgb(255, 212, 59)",
    //     pointHighlightStroke: "rgb(255, 212, 59)",
    //     data: price
    //   },
    //   // {
    //   //   label: "Dữ liệu kế tiếp",
    //   //   fillColor: "rgba(9, 109, 239, 0.651)  ",
    //   //   pointColor: "rgb(9, 109, 239)",
    //   //   strokeColor: "rgb(9, 109, 239)",
    //   //   pointStrokeColor: "rgb(9, 109, 239)",
    //   //   pointHighlightFill: "rgb(9, 109, 239)",
    //   //   pointHighlightStroke: "rgb(9, 109, 239)",
    //   //   data: [48, 48, 49, 39, 86, 10]
    //   // }
    //   ]
    // };
    const data = {
        labels: date,
        datasets: [{
          label: 'Doanh thu ngày',
          data: price,
          borderWidth: 1
        }]
    }

    const data2 = {
        labels:  ['a', 'b'],
        datasets: [{
          label: 'Số hàng tồn',
          data: [20, 10],
          borderWidth: 1
        }]
    }

    const config2 =  {
      type: 'line',
      data2,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const config =  {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    const ctx = document.getElementById('barChartDemo');
    const myChart = new Chart(ctx, config);

    const ctxb = document.getElementById('barChartDemo2');
    // const myChart2 = new Chart(ctxb, config2);
    
    new Chart(ctxb, {
      type: 'bar',
      data: {
        labels: catergoryName,
        datasets: [{
          label: 'Số lượng bán',
          data: sale,
          borderWidth: 1
        },{
          label: 'Số hàng tồn',
          data: stock,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

  </script>
  <script type="text/javascript">
    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
  </script>
</body>

</html>