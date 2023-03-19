<?php 
    include_once '../connect_db.php';
    $action = $_GET['action'];
    switch($action){
        case 'filter_catergory':
            filter_catergory($conn, $_GET['catergory_id']);
            break;
        case 'filter_bill_status':
            filter_bill_status($conn, $_GET['status']);
        default:
            break;
    }
    
    function filter_catergory($conn, $catergory_id){
        $sql = 'SELECT * FROM product WHERE catergory_id = ' . $catergory_id;
        $product_list = $conn->query($sql)->fetchAll();
        echo json_encode($product_list);
    }

    function filter_bill_status($conn, $status){
        if ($status == 'all') {
            $sql = 'SELECT * FROM bill';
            echo json_encode( $conn->query($sql)->fetchAll());
            return;
        }
        $sql = 'SELECT * FROM bill WHERE status = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status]);
        echo json_encode($stmt->fetchAll());
    }

?>