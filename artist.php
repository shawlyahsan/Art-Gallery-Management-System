<?php
    session_start();
    $_SESSION['source_url'] = 'artist.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Artist</title>
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
            <?php
                $db = mysqli_connect("localhost","root","","ip_project");
                $result = mysqli_query($db,"select * from artist");
                while($row = mysqli_fetch_assoc($result))
                {
            ?>
                    <h1 class="h3"><a href="artist_painting.php?ID=<?php echo $row['artist_id'];?>" class="link-secondary">
                        <?php echo $row['a_first_name']." ".$row['a_last_name']; ?>
                    </a></h1>
                    <img src = " <?php echo $row['a_image']; ?>" class="img-fluid my-3">
                    <p class="lead mb-5"><?php echo $row['a_description']; ?></p>
                <?php
                }
                ?> 
            </div>

        </section>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-xxl">
                <div class="align-center" id="footer">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php

                                if(isset($_SESSION['user_id']))
                                {
                            ?>
                                    <a class="nav-link" href="feedback.php">Leave a comment</a>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <a class="nav-link" href="login.php">Leave a comment</a>
                            <?php

                                }

                            ?>
                        </li>

                        <li class="nav-item">
                            <?php

                                if(isset($_SESSION['user_id']))
                                {
                            ?>
                                    <a class="nav-link" href="profile.php">Subscribe to Newsletter</a>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <a class="nav-link" href="login.php">Subscribe to Newsletter</a>
                            <?php

                                }

                            ?>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </body>

</html>