<!DOCTYPE html>
<html>
  <head>
    <title>Firebase Phone Verification</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="main.css" rel="stylesheet">

  </head>
  <body>

<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyBjwGLMpzlzjZ4TlEDU_GcdJa4ozwSuzEc",
    authDomain: "fir-otp-9c767.firebaseapp.com",
    projectId: "fir-otp-9c767",
    storageBucket: "fir-otp-9c767.appspot.com",
    messagingSenderId: "139740180421",
    appId: "1:139740180421:web:c4a6c5ed8c8f19744525ac"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
</script>


<form action="#" method="post">


      <h1>Firebase Phone verification In PHP</h1>

      <hr/>
      <div class="container">

  <label for="name">Name:</label>
    <input type="text" id="name" name="name" required placeholder="Enter Name">
        <label for="uname"><strong>Phone Number</strong></label>
        <input type="text" id="phone" name="phone" placeholder="Enter phone number"  required>
      
      <div id="recaptcha-container"></div>


      <button type="button" onclick="phoneAuth();">Send</button>
    
  
   
        <label for="uname"><strong>Verification Number</strong></label>
        <input type="text" id="verifycode" placeholder="Enter verification code" name="uname" required>
      
    

      <button type="button" onclick="verifyNumber();">Verify</button>
        <button type="submit" name="send" value="send">Submit</button>
    </form>




















    <script src="firebase.js" type="text/javascript"></script>

 

    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
  apiKey: "AIzaSyDaT-lH2umd1Ri7w714HxPDbY_T7f6tBy0",
  authDomain: "otp-9415.firebaseapp.com",
  projectId: "otp-9415",
  storageBucket: "otp-9415.appspot.com",
  messagingSenderId: "482760846241",
  appId: "1:482760846241:web:7d436aad4196861c0139e0",
  measurementId: "G-E427BHZJ6Y"
};

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
     firebase.analytics();
</script>
   <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['send']))
{
    $name=$_POST['name'];
$phone=$_POST['phone'];



//Load Composer's autoloader
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dbm.wordpressdeveloper05@gmail.com';                     //SMTP username
    $mail->Password   = 'zdaletqnpcnefxzz';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dbm.wordpressdeveloper05@gmail.com', 'Contact Form');
    $mail->addAddress('tusharsingh02032001@gmail.com', 'Tushar');     //Add a recipient
 

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Testing form';
    $mail->Body    = "Sender name - $name <br> Phone Number-$phone";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>
  </body>
</html>