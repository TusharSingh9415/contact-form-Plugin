<?php
/*
Plugin Name: Contact Form- Validations
Description: Digital Brain Media Lucknow- Wordpress Developer- Tushar Singh
Version: 1.0
Author: Tushar Singh
*/


//plugin start function 
function custom_contact_form() {
    ob_start(); ?>    



<style>
html,
body {
    display: flex;
    justify-content: center;
    font-family: Roboto, Arial, sans-serif;
    font-size: 15px;
}

form {
    border: 5px solid #f1f1f1;
}

input[type=text],
input[type=password] {
    width: 100%;
    padding: 16px 8px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #8ebf42;
    color: white;
    padding: 14px 0;
    margin: 10px 0;
    border: none;
    cursor: grabbing;
    width: 100%;
}

h1 {
    text-align: center;
    fone-size: 18;
}

button:hover {
    opacity: 0.8;
}

.formcontainer {
    text-align: left;
    margin: 24px 50px 12px;
}

.container {
    padding: 16px 0;
    text-align: left;
}

span.psw {
    float: right;
    padding-top: 0;
    padding-right: 15px;
}


/* For screen phone */

@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
}
</style>

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




<script>

window.onload=function(){
   // alert('ok');

render();
}

function render()
{
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
  
}

function phoneAuth()
{
    var phone_number=document.getElementById('phone').value; 

    firebase.auth().signInWithPhoneNumber(phone_number, window.recaptchaVerifier)
    .then(function(confirmationResult) {
      // SMS sent. Prompt user to type the code from the message, then sign the
      // user in with confirmationResult.confirm(code).
      window.confirmationResult = confirmationResult;
coderesult=confirmationResult;
console.log(coderesult);
alert('message sent');
      // ...
    }).catch(function(error) {
      // Error; SMS not sent
      alert(error.message);
    });



    //   alert(phone_number);
}


function verifyNumber()
{
    var code = document.getElementById('verifycode').value;

    coderesult.confirm(code).then(function (result) {
        // User signed in successfully.
        const user = result.user;
        console.log(user);
        alert('Successfully Verified');

        // Access the button and update its properties based on verification
        var verifyButton = document.getElementById('verifyButton');
        var verificationStatusInput = document.getElementById('verificationStatus');

        if (user) {
            // Verification successful
            verifyButton.innerHTML = 'Verification Successful';
            verifyButton.disabled = true;
            // Update the hidden input field
            verificationStatusInput.value = 'verified';
        } else {
            // Verification unsuccessful
            verifyButton.innerHTML = 'Verification Unsuccessful';
            verifyButton.disabled = false;
            // Update the hidden input field
            verificationStatusInput.value = 'unverified';
        }

    }).catch((error) => {
        // User couldn't sign in (bad verification code?)
        alert(error.message);
    });
}

    </script>


<form action="#" method="post">




<hr/>
<div class="container">

<label for="name">Name:</label>
<input type="text" id="name" name="name" required placeholder="Enter Name">
  <label for="uname"><strong>Phone Number</strong></label>
  <input type="text" id="phone" name="phone" placeholder="Enter phone number"  required>

<div id="recaptcha-container"></div>


<button type="button" onclick="phoneAuth();">Send</button>



  <label for="uname"><strong>Verification Number</strong></label>
  <input type="text" id="verifycode" name="verifycode" placeholder="Enter verification code" name="uname" required>

  <!-- Adjusted button ID -->
  <button type="button" id="verifyButton" onclick="verifyNumber();">Verify</button>

  <!-- Hidden input field to store verification status -->
  <input type="hidden" id="verificationStatus" name="verificationStatus" value="unverified">


  <button type="submit" name="send" value="send">Submit</button>
</form>







    <?php
    return ob_get_clean();
}

// ... (more code)


function custom_contact_form_shortcode() {
    return custom_contact_form();
}






add_shortcode('tushar', 'custom_contact_form_shortcode');


?>



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['send']))
{
    $name=$_POST['name'];
$phone=$_POST['phone'];
$verificationStatus=$_POST['verificationStatus'];


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


    $mail->Body = '<!DOCTYPE html>
<html>
<head>
<style>
.my-button { 
    width: 300px;
    height: 50px;
    background-color: rgb(20,31,114);
    color: rgb(255,255,255);
    font-size: 15px;
    border: 1px solid white;
    border-radius: 10px;
    padding: 5px 5px 5px 5px;
    margin-right: 50px;
    margin-left: 50px;
    margin-top: 20px;
    font-family: Arial;
}
.my-head {
    width: 100%; 
    color: rgb(255,255,255);
    background-color: rgb(20,31,114); 
    font-family: Arial; 
    border-bottom: 1px solid white;
}
.tb-elements {
     width: 100%;
     font-size: 15px;
     margin-top: 5px;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 10px;
}
</style>
</head>
<body>

<table class="my-head">
  <th> <h2>Client Details </h2></th>
</table>

<table class="tb-elements">
  <tr>
    <td>Sender name</td>
    <td>&nbsp;' . $name . '</td>
  </tr>
  <tr>
    <td>Phone Number</td>
    <td>&nbsp;' . $phone . '</td>
  </tr>
  <tr>
    <td>Verify</td>
    <td>&nbsp;' . $verificationStatus . '</td>
  </tr>
</table>

<a href="tel:' . $phone . '">
  <button class="my-button"> <b>Call ' . $name . ' </b> </button>
</a>

</body>
</html>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>