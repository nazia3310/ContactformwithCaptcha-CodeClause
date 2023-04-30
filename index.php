<html>
    <head>
        <title> Contact Form </title>
        <link rel="stylesheet" href="style.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
  <body>
    <div class="contact-form">
    <h2> CONTACT US</h2>
    <form method="post" action="">
       <input type="text" name="name" placeholder="Your name" required>
       <input type="text" name="phone" placeholder="Phone No" required>
       <input type="email" name="email" placeholder="Your Email" required>
       <textarea  name="message" placeholder="Your message" required></textarea>

       <div class="g-recaptcha" data-sitekey="6LfBG70lAAAAAGCRIVnOmLiHljS-tnq_zoeYKnkN"></div>
       
       <input type="submit" name="submit" value="Send Message">  
       
    </form>
    <div class="status">
      <?php
        if(isset($_POST['submit']))
        {
            $User_name = $_POST['name'];
            $phone = $_POST['phone'];
            $User_email = $_POST['email'];
            $User_message = $_POST['message'];


            $email_from = 'noreply@project.com';
            $email_subject = "New Form Submission";
            $email_body = "Name: $User_name.\n".
                          "Phone No: $phone.\n".
                          "Email Id: $User_message.\n";
            $to_email = "sheikh29867@gmail.com";
            $headers = "From: $email_from\r\n";
            $headers .= "Reply-To: $User_email \r\n";
            
            $secretKey = "6LfBG70lAAAAACgvAtMg0tHwdsvFZW8kejy5jrBB";
            $responseKey = $_POST['g-recaptcha-response'];
            $UserIp = $_SERVER['REMOTE_ADDR'];
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIp";
            $response = file_get_contents($url);
            $response = json_decode($response);

            if($response -> success)
            {
              mail( $to_email, $email_subject,$email_body, $headers );
              echo "Message sent Successfully";
            }
            else
            {
              echo "<span>Invalid Captcha, Please Try Again</span>";
            }
        }
        ?>
    </div>


    </div>
  </body>
</html>
