<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once 'smtp-relay.sendinblue.com'; // Change this to the path of your Sendinblue API library
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Replace these with your own Sendinblue API credentials
  $api_key = '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';
  $sender_email = 'thriveservices@gmail.com';

  $sendinblue = new \SendinBlue\Client\Api\SMTPApi();
  $sendinblue->getApiClient()->setApiKey($api_key);

  $send_smtp_email = new \SendinBlue\Client\Model\SendSmtpEmail();
  $send_smtp_email['subject'] = 'New message from '.$name;
  $send_smtp_email['htmlContent'] = '<p><b>From:</b> '.$name.'</p><p><b>Email:</b> '.$email.'</p><p><b>Message:</b> '.$message.'</p>';
  $send_smtp_email['sender'] = array('name' => $name, 'email' => $sender_email);
  $send_smtp_email['to'] = array(array('email' => 'kyej2005@gmail.com'));

  try {
    $result = $sendinblue->sendTransacEmail($send_smtp_email);
    echo 'Message sent successfully!';
  } catch (\Exception $e) {
    echo 'An error occurred. Please try again later.';
  }
}
?>
