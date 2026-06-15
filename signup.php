<?php session_start(); 
if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Sign up</title>
    <?php require_once "includes/links_header.php" ?>
</head>

<body class="bg-body-tertiary">

    <main class="m-auto p-4 border rounded position-absolute top-50 start-50 translate-middle bg-body">

        <form id="signup-form" class="d-flex flex-column needs-validation" action="db_actions/signup-script.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Sign up</h1>

            <div class="form-floating my-1">
                <input type="email" class="form-control" id="email" name="email" placeholder="">
                <label for="email">Email address</label>
            </div>
            <div class="ps-2 text-danger invalid-feedback" id="emailInvalid">
                This is not an email!
            </div>
            <?php if (isset($_SESSION['user_exists'])) : ?>
                <div class="ps-2 text-danger">
                    This email is already signed!
                </div>
            <?php endif; ?>
            <?php unset($_SESSION['user_exists']); ?>

            <div class="form-floating my-1">
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <label for="password">Password</label>
            </div>
            <div class="form-floating my-1">
                <input type="password" class="form-control" id="repetedPassword" placeholder="">
                <label for="repetedPassword">Repeat Password</label>
            </div>
            <div class="ps-2 text-danger invalid-feedback" id="passwordMatchInvalid">
                Passwords must match!
            </div>
            <div class="ps-2 text-danger invalid-feedback" id="passwordLengthInvalid">
                Passwords length must be 8-16 letters!
            </div>

            <button class="btn btn-primary w-100 my-2 py-2" type="submit">Sign up</button>
        </form>
    </main>

    <?php require_once "includes/links_body.php" ?>
    <script src="javascript\signup.js"></script>
</body>

</html>