<?php
// the message
$name = $_POST['name'];
$phone = $_POST['phone'];
$customer_mail = $_POST['email'];
$msg = $_POST['msg'];

$subject = 'New request from ' . $name;

$body = nl2br('Telefon: ' . $phone . ' | ' . 'Email: ' . $customer_mail . ';
               Mesaj: ' . $msg);

$headers = array(
  'Authorization: Bearer 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',
  'Content-Type: application/json'
);

// DE STERS DACA VR SA PRIMESTI MAIL PE DECRIT

$data = array(
  "personalizations" => array(
    array(
      "to" => array(
        array(
          "email" => ""
        )
      )
    )
  ),
  "from" => array(
    "email" => ""
  ),
  "subject" => $subject,
  "content" => array(
    array(
      "type" => "text/html",
      "value" => $body
    )
  )
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
