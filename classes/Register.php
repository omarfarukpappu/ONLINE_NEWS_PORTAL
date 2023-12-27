<?php 

    include_once '../Library/database.php';
    include_once '../helpers/Format.php';

    include_once '../PHPmailer/PHPMailer.php';
    include_once '../PHPmailer/SMTP.php';
    include_once '../PHPmailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Register{

        public $db;
        public $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Format();
        }


        public function AddUser($name,$phone,$email,$password){
            function sendemail_varifi($name, $email, $v_token){
                // $mail = new PHPMailer(true);
                // $mail->isSMTP();
                // $mail->SMTPAuth = true;
               
                // $mail->Host  = 'smtp.gmail.com';                                  
                // $mail->Username = 'faruqpappu666@gmail.com';                     
                // $mail->Password  = 'pappu666';
                
                // $mail->SMTPSecure = 'tls';
                // $mail->Port = 587;
                
                // $mail->setFrom('faruqpappu666@gmail.com', $name);
                // $mail->addAddress($email);
                // $mail->isHTML(true);                                
                // $mail->Subject = 'Email Verification From faruq';
                $phpmailer = new PHPMailer();
                $phpmailer->SMTPDebug = 3;
                $phpmailer->isSMTP();
                $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = '4052bfeac1142e';
                $phpmailer->Password = '10de9f169ff35b';

                $email_template = "
                    <h2>You have register with faruq</h2>
                    <h5>Verify your email address to login please click the link below</h5>
                    <a href='http://localhost/Blog_website/admin/verifi-email.php?token= $v_token'>Click Here</a>
                ";

                $phpmailer->Body = $email_template;
                $a = $phpmailer->send();
                print_r($a);
                 exit;

            }



            $name = $this->fr->validation($name);
            $phone = $this->fr->validation($phone);
            $email = $this->fr->validation($email);
            $password = $this->fr->validation(md5($password));
            $v_token = md5(rand());


            if (empty($name) || empty($phone) || empty($email) || empty($password)) {
                $error = "Filed Must Not Be Empty";
                return $error;
            }else {
                $e_query = "SELECT * FROM user WHERE email='$email'";
                $check_email = $this->db->select($e_query);

                if ($check_email > '0') {
                    $error = "This Email Is Already Exists";
                    return $error;
                    header("location:register.php");
                }else {
                    $insert_query = "INSERT INTO user(username, email, phone, password, v_token) VALUES('$name', '$email', '$phone', '$password', '$v_token')";

                    $insert_row = $this->db->insert($insert_query);
                }
                if ($insert_row) {
                    sendemail_varifi($name, $email, $v_token);
                    $success = "Registration Successful. Please check your email inbox for verify email";
                    return $success;
                }else {
                    $error = "Registration Failed";
                    return $error;
                }
            }

        }

    }
 
?>