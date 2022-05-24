<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container-sm">


<?php
require_once dirname(__FILE__) . './bootstrap.php';
$me = [];
//$fake = new \Nick\PhpSse\BlogFactory();
//$fake->initGenerate();
$dbConn = new \Nick\PhpSse\DbConn();
$entityManager = $dbConn->entityManager;
$uid = (int) $_GET["me"];
var_dump($uid);
var_dump($uid);
var_dump($uid);
var_dump($uid);
$qb = $entityManager->createQueryBuilder();
$user = $qb->select('u.id', 'u.email', 'u.username')
    ->from(\Nick\PhpSse\Entity\User::class, 'u')
    ->where('u.id = :uid')
    //->orderBy('u.name', 'ASC')
    ->setParameter('uid', $uid)
    ->getQuery()
    ->getResult();

var_dump($user);
var_dump(htmlspecialchars($_GET["me"]));
die();

if (empty($me)) {
    header("Location: /login.php");
    exit();
    var_dump($_POST);
    ?>


<?php
}

if (!empty($me)){
    ?>
    <h1> Username:  <?php  echo($me['username']);?></h1>
    <?php
    readfile("chat.html");

}


?>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>