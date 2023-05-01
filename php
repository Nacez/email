<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once 'path/to/sendinblue-api/autoload.php'; // Change this to the path of your Sendinblue API library
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Replace these with your own Sendinblue API credentials
  $api_key = 'your-sendinblue-api-key';
  $sender_email = 'your-sender-email';

  $sendinblue = new \SendinBlue\Client\Api\SMTPApi();
  $sendinblue->getApiClient()->setApiKey($api_key);

  $send_smtp_email = new \SendinBlue\Client\Model\SendSmtpEmail();
  $send_smtp_email['subject'] = 'New message from '.$name;
  $send_smtp_email['htmlContent'] = '<p><b>From:</b> '.$name.'</p><p><b>Email:</b> '.$email.'</p><p><b>Message:</b> '.$message.'</p>';
  $send_smtp_email['sender'] = array('name' => $name, 'email' => $sender_email);
  $send_smtp_email['to'] = array(array('email' => 'recipient@example.com'));

  try {
    $result = $sendinblue->sendTransacEmail($send_smtp_email);
    echo 'Message sent successfully!';
  } catch (\Exception $e) {
    echo 'An error occurred. Please try again later.';
  }
}
?>
