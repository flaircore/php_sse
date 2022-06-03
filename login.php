<?php
/**
 * @login route, which creates a user and redirects
 * to home, with the just created user as the $me
 * variable in index.php.
 *
 */
require_once dirname(__FILE__) . '/bootstrap.php';

if (isset($_POST['submit'])) {
    $user = new \Nick\PhpSse\Entity\User();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user->setUserName($username);
    $user->setEmail($email);
    $dbConn = new \Nick\PhpSse\DbConn();
    $entityManager = $dbConn->entityManager;
    $entityManager->persist($user);
    $entityManager->flush();

    $url = "/index?me=" .$user->getId();

    header("Location: $url");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Chat with SSE! Login</title>
</head>
<body>
<div class="container-sm">
<form action="" method="POST">
        <div class="mb-3">
            <label for="emailInput" class="form-label">Email address</label>
            <input
                type="email"
                class="form-control"
                id="emailInput"
                aria-describedby="email"
                name="email"
                value="">
            <div id="email" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="usernameInput" class="form-label">UserName</label>
            <input
                type="text"
                class="form-control"
                id="usernameInput"
                aria-describedby="username"
                name="username"
                value="">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </form>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>