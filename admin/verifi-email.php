<?php 
    include_once '..Library/Session.php';
    Session::init();
    include_once '../Library/Database.php';
    $db = new Database();

    if (isset($_GET['token'])) {
        
        $token = $_GET['token'];
        $query = "SELECT v_token, v_status FROM user WHERE v_token='$token'";
        $result = $db->select($query);

        if ($result != false) {
            
            $row = mysqli_fetch_assoc($result);
            if ($row['v_status'] == 0) {
                
                $click_token = $row['v_token'];
                $update_status = "UPDATE user SET v_status='1' WHERE v_token='$click_token'";

                $update_result = $db->update($update_status);

                if ($update_result) {
                    $_SESSION['status'] = "Your Account Has been verified Successfully";
                    header('location:login.php');
                }else {
                    $_SESSION['status'] = "Verification Filed !";
                    header('location:login.php');
                }

            }else {
                $_SESSION['status'] = "This Email Is Already Verified Please Login";
                header('location:login.php');
            }

        }else {
            $_SESSION['status'] = "This Token Does Not Exist !";
            header('location:login.php');
        }

    }else {
        $_SESSION['status'] = "Not AlloWed";
        header('location:login.php');
    }

?>