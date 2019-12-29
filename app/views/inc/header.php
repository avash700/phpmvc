<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>css/style.css">
    <title> <?php echo SITENAME; ?> </title>
</head>
<body>

    <?php if(isset($_SESSION['user_id'])): ?>
        <ul>
        <li><a href="<?php echo URLROOT; ?>users/logout"> logout </a></li>
        </ul>
    <?php else: ?>
    <ul>
        <li><a href="<?php echo URLROOT; ?>users/login"> login </a></li>
        <li><a href="<?php echo URLROOT; ?>users/register"> register  </a></li>
        <li><a href="<?php echo URLROOT; ?>rides/">My rides</a></li>

    </ul>

    <?php endif; ?>