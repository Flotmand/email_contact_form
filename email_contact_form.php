<?php 
function contact_form($recipient_email, $site_url) {
    function test_input($input) {
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
    }

    $nameErr = $emailErr = $commentErr = "";
    $name = $email = $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Remember to type your name";

            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space i valid";
            }
        }
          else {
              $name = test_input($_POST["name"]);
          }

        if (empty($_POST["email"])) {
            $emailErr = "Remember to type your email";
        }
          else {
              $email = test_input($_POST["email"]);

              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format";
              }
          }

        if (empty($_POST["message"])) {
          $messageErr = "You need to write a message";
        }
          else {
              $message = test_input($_POST["message"]);
          }

            // Check if all three fields is filled out and ready to be sent
          if ($name && $email && $message) {
            $finalMsg = "Folowing message has been sent via " . $site_url . ": \r\n\r\n Sender: \r\nName: " . $name . "\r\nEmail: " . $email . "\r\n\r\n\r\nMessage: \r\n\r\n" . $message;
            $headers = 'From: ' . $email . "\r\n";/* .
            'CC: ' . $email;*/
                //CC outcommented because Gmail will not receive the email.
                // Instead send two identical emails'
              mail($recipient_email,"Message via " . $site_url, wordwrap($finalMsg,80), $headers);
              mail($email,"Message " . $site_url, wordwrap($finalMsg,80), $headers);

                // Success message on the screen
              echo '<h4>Success!</h4>
              <p>Your message has been sent and we will get back to you soon.</p>';
          }
            else {
          ?>
              <h4>Contact form</h4>
              <form id="contact_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                  <input type="text" id="name" name="name" placeholder="<?php echo ($nameErr) ? $nameErr : "Your name"; ?>" value="<?php echo ($name) ? $name : ""; ?>">
                  <br>
                  <?php
                      if ($emailErr) {
                        echo '<input type="email" id="email" name="email" placeholder="'. $emailErr . '">';
                      }
                        elseif ($email) {
                            echo '<input type="email" id="email" name="email" value="' . $email . '">';
                        }
                        else {
                            echo '<input type="email" id="email" name="email" placeholder="Your email">';
                        }
                        ?>
                        <br>
                  <?php
                  if ($message) {
                      echo '<textarea rows="6" id="message" name="message">' . $message . '</textarea>';
                  }
                    elseif ($messageErr) {
                        echo '<textarea rows="6" id="message" name="message" placeholder="' . $messageErr . '"></textarea>';
                    }
                    else {
                        echo '<textarea rows="6" id="message" name="message" placeholder="Your message"></textarea>';
                    }
                   ?>
                   <br>
                  <button type="submit" class="form">Send message</button>
              </form>
      <?php
          }
      }
        //If $_POST is not used then...
      else {
      ?>
      <h4>Contact form</h4>
      <form id="contact_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <input type="text" id="name" name="name" placeholder="Your name">

          <input type="email" id="email" name="email" placeholder="Your email">

          <textarea rows="6" id="message" name="message" placeholder="Your message"></textarea>

          <button type="submit" class="form">Send message</button>
      </form>
      <?php
      }
}

// CONTACT FORM
    function contact_form2($recipient_email, $site_url) {
        /*
        TODO
         * Tag højde for at folk kan finde på at refreshe siden efter mail er afsendt
        */

        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $nameErr = $emailErr = $commentErr = "";
        $name = $email = $message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Husk at indtaste dit navn";

                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Kun bogstaver og mellemrum er tilladt";
                }
            }
              else {
                  $name = test_input($_POST["name"]);
              }

            if (empty($_POST["email"])) {
                $emailErr = "Husk at indtaste din email, så vi kan besvare din henvendelse";
            }
              else {
                  $email = test_input($_POST["email"]);

                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $emailErr = "Ugyldigt email format";
                  }
              }

            if (empty($_POST["message"])) {
              $messageErr = "Der skal skrives en besked før kontaktformularen virker";
            }
              else {
                  $message = test_input($_POST["message"]);
              }

                // Check if all three fields is filled and ready to be sent
              if ($name && $email && $message) {
                $finalMsg = "Følgende besked er sendt via kontaktformularen på " . $site_url . ": \r\n\r\n Afsender: \r\nNavn: " . $name . "\r\nEmail: " . $email . "\r\n\r\n\r\nBesked: \r\n\r\n" . $message;
                $headers = 'From: ' . $email . "\r\n";/* .
                'CC: ' . $email;*/
                    //CC outcommented because Gmail will not receive the email.
                    // Instead send two identical emails'
                  mail($recipient_email,"Besked via " . $site_url, wordwrap($finalMsg,80), $headers);
                  mail($email,"Besked via " . $site_url, wordwrap($finalMsg,80), $headers);

                  echo '<h4>Tak for din besked!</h4>
                  <div class="title_border widget"></div>
                  <p>Din besked er nu afsendt og vi vil besvare den hurtigst muligt.</p>
                  <br>';
                    // NOTE Jonas syntes ikke beskeden skulle vises, men i stedet skal afsender med som cc.
                  //echo "<p>Navn: " . $name . "<br>Email: " . $email . "<br>Besked: " . $message . "</p>";
              }
                else {
              ?>
                  <h4>Skriv til bestyrelsen</h4>
                  <div class="title_border widget"></div>
                  <form id="contact_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."#contact";?>">
                      <div class="form-group">
                          <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo ($nameErr) ? $nameErr : "Skriv dit navn"; ?>" value="<?php echo ($name) ? $name : ""; ?>">
                      </div>
                      <div class="form-group">
                          <?php
                              if ($emailErr) {
                                echo '<input type="email" class="form-control" id="email" name="email" placeholder="'. $emailErr . '">';
                              }
                                elseif ($email) {
                                    echo '<input type="email" class="form-control" id="email" name="email" value="' . $email . '">';
                                }
                                else {
                                    echo '<input type="email" class="form-control" id="email" name="email" placeholder="Skriv din e-mail">';
                                }
                           ?>
                      </div>
                      <div class="form-group">
                          <?php
                          if ($message) {
                              echo '<textarea class="form-control" rows="6" id="message" name="message">' . $message . '</textarea>';
                          }
                            elseif ($messageErr) {
                                echo '<textarea class="form-control" rows="6" id="message" name="message" placeholder="' . $messageErr . '"></textarea>';
                            }
                            else {
                                echo '<textarea class="form-control" rows="6" id="message" name="message" placeholder="Skriv din besked"></textarea>';
                            }
                           ?>
                      </div>
                      <button type="submit" class="form">Send besked</button>
                  </form>
          <?php
              }
          }
            //If $_POST is not used then...
          else {
          ?>
          <h4>Skriv til bestyrelsen</h4>
          <div class="title_border widget"></div>
          <form id="contact_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."#contact";?>">
              <div class="form-group">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Skriv dit navn">
              </div>
              <div class="form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Skriv din e-mail">
              </div>
              <div class="form-group">
                  <textarea class="form-control" rows="6" id="message" name="message" placeholder="Skriv din besked"></textarea>
              </div>
              <button type="submit" class="form">Send besked</button>
          </form>
          <?php
          }
    }
  ?>
