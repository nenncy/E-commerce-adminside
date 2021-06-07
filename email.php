<?php
$from_name = "testing";
$from_email = "nencyvpatel3010@gmail.com";
$headers = "From: $from_name <$from_email>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "From:nencyvpatel3010@gmail.com\r\nReply-To: nencyvpatel3010@gmail.com";
$body = "Hi,\nThis is a test mail from $from_name <$from_email>.";
$subject = "Test mail from test";
$to = "nencyvpatel3010@gmail.com";

if (mail($to, $subject, $body, $headers)) {
  echo "success!";
} else {
  echo "fail…";
}
?>