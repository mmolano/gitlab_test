<?php 


require_once "../config/Database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset_request_submit']) && !empty($_POST['email'])){


  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "https://dev-molano.com/forgottenpwd/new-password?selector=".$selector."&validator=".bin2hex($token);

  $expires = date("U") + 1800;


  $userEmail = $_POST['email'];



  $db = new Database;
  $sql = "SELECT email FROM user WHERE email =:email";
  $stmt = $db->connect()->prepare($sql);
  $stmt->bindParam(':email', $_POST['email']);
  $stmt->execute();
  
  if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
    if($stmt->rowCount() == 1){
      $db = new Database;
      $sql = "DELETE FROM password_reset WHERE email=:email";
      $stmt = $db->connect()->prepare($sql);
      $stmt->bindParam(':email', $userEmail);
      $execute = $stmt->execute();

      if(!$execute){
        echo "there was an error !";
        exit();
      }

      $db = new Database;
      $sql = "INSERT INTO password_reset (email, selector, token, expires) VALUES (:email, :selector, :token, :expires)";
      $stmt = $db->connect()->prepare($sql);
      $hashedToken = password_hash($token, PASSWORD_ARGON2I, [ 
          'memory_cost' => 2 ** 12,
          'time_cost' => 10,
          'threads' => 20
        ]);
      $stmt->bindParam(':email', $userEmail);
      $stmt->bindParam(':selector', $selector);
      $stmt->bindParam(':token', $hashedToken);
      $stmt->bindParam(':expires', $expires);
      $execute = $stmt->execute();

      if(!$execute){
        echo "there was an error !";
        exit();
      }

      $stmt = null; 

      require '../PHPMailer/src/Exception.php';
      require '../PHPMailer/src/PHPMailer.php';
      require '../PHPMailer/src/SMTP.php';

      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = 0;                                       // Enable verbose debug output
          $mail->isSMTP();                                            // Set mailer to use SMTP
          $mail->Host       = 'SSL0.OVH.NET';  // Specify main and backup SMTP servers
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = '';                     // SMTP username
          $mail->Password   = '';                               // SMTP password
          $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
          $mail->Port       = 465;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('', 'Space_one');
          $mail->addAddress($userEmail, 'User'); 

          // Attachments
          //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $msg = 'Hi there, click on this <a href="'.$url.'">'.$url.'</a> to reset your password on our site';
          $mail->Body = $msg;

        
          $mail->send();     
          
          header("Location: ../reset?reset=success");  
          
      } catch (Exception $e) {
        echo 'error mail could not be sent'.$e->getMessage();
      } 
    }else{
      header("Location: ../reset?reset=email_not_exist");  
    }
  }else{
    header("Location: ../reset?reset=email_failed");  
  }

} else {
  if(empty($_POST['email'])){
    header("Location: ../reset?reset=failed");  
  }else{
    header("Location: ../index");
  }
}


?>