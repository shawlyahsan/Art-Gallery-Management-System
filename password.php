<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        $_SESSION['source_url'] = 'index.php';
    }
    else
    {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
        <meta charset="UTF-8">
        <meta name="description" content="Art gallery">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    </head>

    <body>

        <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
            <div class="container-xxl">
                <a href="index.php" class="navbar-brand">
                    <img src="images/logo.png" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse align-center" id="main-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="artist.php">Artist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="painting.php">Painting</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Exhibition
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="upcoming_exhibition.php">Upcoming</a></li>
                                <li><a class="dropdown-item" href="archive_exhibition.php">Archive</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>

                <div class="collapse navbar-collapse justify-content-end align-enter" id="main-nav">
                    <ul class="navbar-nav">
                        <?php
                            if(isset($_SESSION['username']))
                            {
                        ?>
                                <li class="nav-item"><a class="nav-link" href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                                <li class="nav-item"><a class="nav-link" href="session_close.php">logout</a></li>
                        <?php
                            }
                            else
                            {
                        ?>
                                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <?php
                            }
                        ?>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="container-xxl mt-3">
            <ul class="nav nav-tabs mb-5">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="password.php">Password</a>
                </li>
            </ul>
        </div>

        <?php 
        
            $db = mysqli_connect("localhost","root","","ip_project");

            $username = $_SESSION['username'];
            $result = mysqli_query($db,"select * from login where username='$username'");
            $row = mysqli_fetch_array($result);
            $cpass = $row['pass'];

        ?>

        <div class="container-xxl">
            <form autocomplete="off" method="POST" action="" style="max-width:480px;">
                <div class="mt-5">
                    <label for="cpass" class="form-label">Current Password</label>
                    <input type="password" id="cpass" name="cpass" class="form-control" required autofocus>   
                </div>
                <div style="margin: 7px;" id="CheckPassword"></div>
                <div class="mt-2">
                    <label for="npass" class="form-label">New Password</label>
                    <input type="password" id="npass" name="npass" class="form-control" required>
                </div>
                <div class="mt-2">
                    <label for="repass" class="form-label">Retype Password</label>
                    <input type="password" id="repass" name="repass" class="form-control" required>
                </div>
                <div style="margin: 7px;" id="CheckPasswordMatch"></div>
                <div class="my-3">
                    <button name="button" class="btn btn-primary btn-block">Update Password</button>
                </div>
            </form>

            <?php
                if(isset($_POST['button']))
                {
                    $cpass     = valid($_POST["cpass"]);
                    $pass     = valid($_POST["npass"]);
                    $repass   = valid($_POST["repass"]);

                    $username = $_SESSION['username'];
                    $result = mysqli_query($db,"select * from login where username='$username'");
                    $row = mysqli_fetch_array($result);

                    $pass = mysqli_real_escape_string($db,$pass);

                    $result = mysqli_query($db,"select * from login where username='$username'");
                    $row = mysqli_fetch_array($result);

                    $result = mysqli_query($db,"UPDATE login SET pass = '$pass' WHERE username = '$username';");

                    if($result){
                        echo "<script type='text/javascript'>
                        alert('Password has been saved');
                        location.href = 'password.php';
                        </script>";
                    } 
                    else
                    {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                    }

                    mysqli_close($db);
                }

                function valid($string)
                {
                    $string = stripcslashes($string);
                    $string = htmlspecialchars($string);
                    return $string;
                }

            ?>

        </div>

        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        
        <script>
            $(document).ready(function () {

                $("#cpass").on('keyup', function(){
                    var cpass = "<?php echo"$cpass"?>";
                    var pass = $("#cpass").val();
                    if (cpass != pass)
                        $("#CheckPassword").html("Incorrect Password").css("color","red");
                    else
                        $("#CheckPassword").html("");
                });

                $("#repass").on('keyup', function(){
                    var password = $("#npass").val();
                    var confirmPassword = $("#repass").val();
                    if (password != confirmPassword)
                        $("#CheckPasswordMatch").html("Password does not match").css("color","red");
                    else
                        $("#CheckPasswordMatch").html("");
                });
            });
        </script>

    </body>

</html>