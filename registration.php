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
        <title>Registration</title>
        <meta charset="UTF-8">
        <meta name="description" content="Art gallery">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    </head>

    <body style="background:#CCC;">
        <div class="container-xxl my-5">

            <form autocomplete="off" method="POST" action="" style="max-width:480px;margin:auto;">
                <div class="pt-5">
                    <h1 class="h2 pt-5">Register</h1>
                </div>
                <div class="mt-5">
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required autofocus>    
                </div>
                <div class="mt-2">
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="mt-2">
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required>
                </div>
                <div class="mt-2">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mt-2">
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                </div>
                <div class="mt-2">
                    <input type="password" id="repass" name="repass" class="form-control" placeholder="Retype Password" required>
                </div>
                <div style="margin: 7px;" id="CheckPasswordMatch"></div>
                <div class="mt-3">
                    <button name="button" class="btn btn-primary btn-block">Register</button>
                </div>
                <div class="mt-2">
                    <p>Already Registered? <a href="login.php">Login</a></p>
                </div>
            </form>

            <?php
                if(isset($_POST['button']))
                {
                    $db = mysqli_connect("localhost","root","","ip_project");

                    $fname    = valid($_POST["fname"]);
                    $lname    = valid($_POST["lname"]);
                    $email    = valid($_POST["email"]);
                    $username = valid($_POST["username"]);
                    $pass     = valid($_POST["pass"]);
                    $repass   = valid($_POST["repass"]);

                    if($pass == $repass)
                    {
                        //echo "success";
                        $fname = mysqli_real_escape_string($db,$fname);
                        $lname = mysqli_real_escape_string($db,$lname);
                        $email = mysqli_real_escape_string($db,$email);
                        $username = mysqli_real_escape_string($db,$username);
                        $pass = mysqli_real_escape_string($db,$pass);

                        $result = mysqli_query($db,"select * from login where username='$username'");
                        $row = mysqli_fetch_array($result);

                        if($row)
                        {
                            echo "<script type='text/javascript'>
                            alert('Username already taken');
                            </script>";
                        }
                        else
                        {
                            $result = mysqli_query($db,"select * from customer where email='$email'");
                            $row = mysqli_fetch_array($result);
                            if($row)
                            {
                                echo "<script type='text/javascript'>
                                alert('This email already exists');
                                </script>";
                            }
                            else
                            {
                                $result = mysqli_query($db,"INSERT INTO customer(customer_id,first_name,last_name,email,username)
                                VALUES(DEFAULT,'$fname','$lname','$email','$username')");

                                if($result)
                                {
                                    $result = mysqli_query($db,"INSERT INTO login(login_id,username,pass)
                                    VALUES(DEFAULT,'$username','$pass')");
                                    if($result) 
                                    {
                                        echo "<script type='text/javascript'>
                                        alert('Registration Completed');
                                        </script>";

                                    }
                                    else 
                                    {
                                        echo "<script type='text/javascript'>
                                        alert('Error!!');
                                        </script>";
                                    }
                                }
                                else
                                {
                                    echo "<script type='text/javascript'>
                                    alert('Error!!');
                                    </script>";
                                }
                            }
                        
                        }
                    }
                    else
                    {
                        echo "<script type='text/javascript'>
                        alert('Password does not match!!');
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

        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {

                $("#repass").on('keyup', function(){
                    var password = $("#pass").val();
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