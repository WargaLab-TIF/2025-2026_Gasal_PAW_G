<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
    header("location:admin/menegement.php");
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Form-Login</title>
    </head>
    <body style="background-color: #D7EBF0;">
        <div class="container d-flex justify-content-center flex-column align-items-center">
            <div class="mt-5 bg-white shadow rounded-3" style="width: 360px;">
                
                <div class="p-4 d-flex justify-content-center text-primary">
                    <h1>Login Admin</h1>
                </div>
                <form method="POST">
                    <div class="px-3 py-2">
                        <input type="text" class="form-control" id="inputPassword2" name="username" value="<?= $user_name ??"" ?>" placeholder="Username">
                    </div>
                    <div class="px-3 py-2">
                        <input type="password" class="form-control" id="inputPassword2" name="password" value="<?= $pw ?? '' ?>" placeholder="Password">
                    </div>
                    <div class="px-3 py-2 d-flex flex-row justify-content-center">
                        <button type="submit" class="btn btn-primary mb-3 w-100" name="login">Login</button>
                    </div>
                    <div class="pb-2 d-flex flex-row justify-content-center">
                        <?php require_once __DIR__. "../../data_base/autentikasi/verif_login.php";?>
                        <span class='px-4 mb-2 text-danger text-align-right'><?= $error ??"" ?></span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>