<?php
    session_start();
    $_SESSION['source_url'] = 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="description" content="Art gallery">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

        <style>

            .carousel-item{
                height: 90vh;
                position: relative;
                background-color: black;
            }

            .overlay-image{
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                top: 0;
                background-position: center;
                background-size: cover;
                background-color: black;
                opacity: 0.5;
            }

        </style>
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

        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active data-bs-interval='5000'">
                <div class="overlay-image" style="background-image:url(Add/DB/Home/pic1.jpg);"></div>
                <div class="carousel-caption mb-3">
                    <h5>Explore Galleries of Bangladesh</h5>
                    <a class="btn btn-success" href="gallery.php" role="button">Click Here</a>
                </div>
                </div>
                <div class="carousel-item data-bs-interval='2000'">
                <div class="overlay-image" style="background-image:url(Add/DB/Home/pic2.jpg);"></div>
                <div class="carousel-caption mb-3">
                    <h5>View a vast collection of artwork</h5>
                    <a class="btn btn-success" href="painting.php" role="button">Click Here</a>
                </div>
                </div>
                <div class="carousel-item data-bs-interval='2000'">
                <div class="overlay-image" style="background-image:url(Add/DB/Home/pic5.jpg);"></div>
                <div class="carousel-caption mb-3">
                    <h5>Find Artworks of Famous Artists</h5>
                    <a class="btn btn-success" href="artist.php" role="button">Click Here</a>
                </div>
                </div>
                <div class="carousel-item data-bs-interval='2000'">
                <div class="overlay-image" style="background-image:url(Add/DB/Home/pic3.jpg);"></div>
                <div class="carousel-caption mb-3">
                    <h5>Find Exiting New Exhibitions</h5>
                    <a class="btn btn-success" href="upcoming_exhibition.php" role="button">Click Here</a>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

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