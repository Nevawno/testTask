<?php require_once __DIR__ . './parsing.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php parser( $url, $start, $arr, $end );?> 
    <script>
    window.onload = function() {
        window.location.href = "./download.php";
    };
    </script>
</body>
</html>