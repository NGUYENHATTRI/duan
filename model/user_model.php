<?php
    function get_user($id){
        global $conn;
        $sql = 'SELECT * FROM user WHERE id = ' . $id;
        $user =  $conn->query($sql)->fetch();
        return $user; 
    }


    function update_user($id, $img_path, $email){
        global $conn;
        $img_path = $img_path ?? $_SESSION['user']['img'];
        $sql = 'UPDATE user SET user_name=? , email= ? , img = ?  WHERE id = ' . $id;
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['user_name'], $email, $img_path]);
    }

    function update_user_in_session(){
        $user = get_user($_SESSION['user']['iduser']);
        $_SESSION['user']['user_name'] = $user['user_name'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['img'] = $user['img'];
    }    
    
?>