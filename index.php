<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require 'routes.php';
exit();

use chillerlan\QRCode\QRCode;
use Controllers\Web;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>QR skaner</h1>
    <form action="" method="POST">
    <input type="text" placeholder ="Enter link or text" name="text">
    <button type="submit">Send</button><br>
    <?php
        $text = $_POST['text'];
        $web = new Web();
        $web->createQRCode($text);
        echo '<img src="'.(new QRCode)->render($text).'" alt="QR Code" width ="200" height=200"/>';

    ?>
    </form>
    <h2>Read QRCode</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="read">
        <button type="submit">Send</button><br>
        <?php
        $result=(new QRCode())->readFromFile('qr.jpg');
        $content = $result->data;
        $web = new Web();
        $web->readQRCode($content);
        echo ($content);
        ?>
    </form>
</body>
</html>
