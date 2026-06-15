<?php session_start(); 
if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Log in</title>
    <?php require_once "includes/links_header.php" ?>

</head>

<body class="bg-body-tertiary">

    <main class="m-auto p-4 border rounded position-absolute top-50 start-50 translate-middle bg-body">
        <form id="login-form" class="d-flex flex-column" action="db_actions/login-script.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Log in </h1>

            <div class="form-floating my-1">
                <input type="email" class="form-control" id="email" name="email" placeholder="">
                <label for="email">Email address</label>
            </div>
            <div class="ps-2 text-danger invalid-feedback" id="emailInvalid">
                This is not an email!
            </div>
            <?php if (isset($_SESSION['user_does_not_exist'])) : ?>
                <div class="ps-2 text-danger">
                    There is no such email!
                </div>
            <?php endif; ?>
            <?php unset($_SESSION['user_does_not_exist']); ?>


            <div class="form-floating my-1">
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <label for="password">Password</label>
            </div>
            <div class="ps-2 text-danger invalid-feedback" id="passwordLengthInvalid">
                Passwords length must be 8-16 letters!
            </div>
            <?php if (isset($_SESSION['wrong_password'])) : ?>
                <div class="ps-2 text-danger">
                    Wrong password!
                </div>
            <?php endif; ?>
            <?php unset($_SESSION['wrong_password']); ?>

            <!--
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            -->

            <button class="btn btn-primary w-100 my-2 py-2" type="submit">Log in</button>
        </form>
    </main>

    <?php require_once "includes/links_body.php" ?>
    <script src="javascript/login.js"></script>
</body>

</html>