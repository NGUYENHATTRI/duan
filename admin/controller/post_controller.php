<?php
    include_once '../model/connect_db.php';
    // GET hiển thị UI
    if (isset($_GET['action'])){
        switch($_GET['action']){
            case 'list':
                include_once '../model/post_model.php';
                include_once 'view/post/list.php';
                break;
            case 'add':
                include_once '../model/post_model.php';
                include_once 'view/post/add.php';
                break;
            case 'edit':
                include_once '../model/post_model.php';
                include_once 'view/post/edit.php';
                break;
          
        }
    }



    //POST thực hiện insert, update, detele
    if (isset($_POST['action'])){
        // include_once '../model/product_model.php';
        switch($_POST['action']){
            case 'add':
                add_post();
                break;
            case 'edit':
                update_post();
                break;
            case 'delete':
                delete_post($_POST['id']);
                break;
        }
    }

    function add_post(){
        global $conn;
        $sql = "INSERT INTO post (title , content)  VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt ->execute([$_POST['title'], $_POST['content']]);
        
        header ('location: ../index.php?page=post&action=list');
        } 

    function update_post(){
        global $conn;
        $sql = 'UPDATE post SET id = ?,title = ?,content = ? WHERE id = '. $_POST['title'];
        $stmt = $conn->prepare($sql);
        $stmt ->execute([$_POST['id'], $_POST['title'], $_POST['content']]);
        header ('location: ../index.php?page=post&action=list');
    }

    function delete_post($id){
        global $conn;
        $stmt = $conn->prepare('DELETE FROM post WHERE id = ?');
        $stmt->execute([$id]);
        header ('location: ../index.php?page=post&action=list');
    }
?>