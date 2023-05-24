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
<html lang="en">
    <head>
        <title>Feedback</title>
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

                <div class="collapse navbar-collapse align-enter" id="main-nav">
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

        <section class="main">

            <div class="container my-5">
                <form method="POST" action="" style="max-width:720px;margin:auto;">
                    <div class="form-group pt-5">
                        <h1 class="h3">Leave a comment</h1>
                        <textarea class="form-control mt-4" id="comment" name="comment" rows="8" required autofocus></textarea>
                    </div>
                    <div class="mt-4">
                        <button name="button" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form> 
            </div>

            <?php
                if(isset($_POST['button']))
                {
                    $db = mysqli_connect("localhost", "root", "", "ip_project");

                    if($db === false){
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    }

                    $comment = mysqli_real_escape_string($db, $_POST['comment']);
                    $userid = $_SESSION['user_id'];
 
                    $sql = "INSERT INTO feedback(feedback_id,f_description,c_id) VALUES(DEFAULT, '$comment', $userid)";
                    if(mysqli_query($db, $sql)){
                        echo "<script type='text/javascript'>
                        alert('Your feedback has been recorded');
                        location.href = 'index.php';
                        </script>";
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                    }

                    mysqli_close($db);
                }

            ?>


        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    
    </body>

</html>