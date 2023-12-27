<?php 

    include_once '../Library/Session.php';
    Session::loginCheck();

    include_once '../Library/Database.php';
    include_once '../helpers/Format.php';

    class AdminLogin{

        private $db;
        private $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function LoginUser($email, $password){

            $email = $this->fr->validation($email);
            $password = $this->fr->validation($password);

            if (empty($email) || empty($password)) {
                $error = "Filds Must not be empty !";
                return $error;
            }else {
                $select = "SELECT * FROM user WHERE email='$email' AND password = '$password'";
                $result = $this->db->select($select);


                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);

                        if ($row['v_status'] == 1) {

                            Session::set('login', true);
                            Session::set('username', $row['username']);
                            header('location:index.php');
                        } else {
                            $error = "Please first varifi your email";
                            return $error;
                        }
                    } else {
                        $error = "Invalid Email Or Password";
                        return $error;
                    }
                }
                
                
            }

        }

    // }

?>