<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="description" content="Art gallery">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    </head>

    <body style="background:#CCC;">
        <div class="container-xxl my-5">
            <form method="POST" autocomplete="off" action="" style="max-width:480px;margin:auto;">
                <div class="pt-5">
                    <h1 class="h2 pt-5">Welcome Back</h1>
                </div>
                <div class="mt-5">
                    <input type="text" id="username" name="username" class="form-control" placeholder="username" required autofocus>    
                </div>
                <div class="mt-2">
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                </div>
                <div class="mt-3">
                    <button name="button" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="mt-2">
                <p>Not Registered? <a href="registration.php">Register</a></p>
                </div>
            </form>

            <?php
                if(isset($_POST['button']))
                {
                    $db = mysqli_connect("localhost","root","","ip_project");

                    $username = valid($_POST["username"]);
                    $password = valid($_POST["password"]);
                    $username = mysqli_real_escape_string($db,$username);
                    $password = mysqli_real_escape_string($db,$password);

                    //echo $username."<br>";
                    //echo $password."<br>";
                    $result = mysqli_query($db,"select * from login where username='$username' and pass='$password'");
                    $row = mysqli_fetch_array($result);
                    //echo $row['username'];
                    if($row['username'] == $username && $row['pass'] == $password)
                    {
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $row['login_id'];
                        if(isset($_SESSION['source_url']))
                        {
                            $url = $_SESSION['source_url'];
                        }  
                        else
                        {
                            $url = 'index.php';
                        }

                        header('Location: '.$url);
                    }
                    else 
                    {
                        echo "<script type='text/javascript'>
                        alert('Wrong Username or Password!!');
                        </script>";
                    }
                }

                function valid($string)
                {
                    $string = stripcslashes($string);
                    $string = htmlspecialchars($string);
                    return $string;
                }

            ?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    </body>

</html>