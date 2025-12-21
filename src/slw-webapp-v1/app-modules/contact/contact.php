<?php

$to = "jhonattan.rapprecht@gmail.com";
$subject = "Email test";

$message = "
<html>
<head>
<title>Aanmelding voltooien</title>
</head>
<body>
<p>Uw aanmeldings gegevens</p>
<table>
<tr>
<th>Voornaam</th>
<th>Achternaam</th>
</tr>
<tr>
<td>Jhonattan</td>
<td>Rapprecht</td>
</tr>
</table>
</body>
</html>

";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@selectworks.nl>' . "\r\n";

mail($to,$subject,$message,$headers);

?>