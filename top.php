<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
$pathParts = pathinfo($phpSelf);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>River Valley Stone Works</title>
        <meta name="author" content="Nicholas Gibson">
        <meta name="description" content=" ">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 648px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 500px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">
    </head>

    <?php
    print '<body class="flexbox-layout" id="' . $pathParts['filename'] . '"> ';
    include 'connect-DB.php';
    include 'header.php';
    include 'nav.php';
    ?>

