<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>SimplonSong</title>
</head>

<body class="body">
    <header class="header">
        <div>
            <div class="titre">
                <img src="" alt="">
                <h1>SimplonSong</h1>
            </div>
            <div class="slogan">
                <h2>le meilleur de la musique rien que pour vous</h2>
            </div>
            <div class="navBar">
                <nav class="navbar">
                    <div id="content">
                        <a href='principale.php?deconnexion=true'><span>Déconnexion</span></a>
                        <!-- tester si l'utilisateur est connecté -->
                        <?php
                        session_start();
                        if (isset($_GET['deconnexion'])) {
                            if ($_GET['deconnexion'] == true) {
                                session_unset();
                                header("location:../index.php");
                            }
                        } else if (isset($_SESSION['pseudo'])) {
                            $user = $_SESSION['pseudo'];
                            // afficher un message
                            echo "<br>Bonjour $user";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder=" Search" id="search-musique">
                    </div>
                    <!-- <form action="" method="GET">
                        <input type="text" placeholder="search" name="pseudo" required>
                        <input type="submit" id='submit' value='search'>
                    </form> -->
                </nav>
            </div>
        </div>
    </header>

    <main>


        <section>
            <div id="resultat-search">

            </div>
        </section>
        <!-- <section>
            <div>
                <form id="selectTheme" action="./question.php" method="post">
                    <input type="submit" value="rock" name="rock" id="rock" class="theme" data-info="rock">
                    <input type="submit" value="electro" name="electro" id="electro" class="theme" data-info="electro">
                </form>
            </div>
            <div></div>
        </section> -->



    </main>
    <footer>

    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../script.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-musique').keyup(function() {
                $('#result-search').html("")

                var musique = $(this).val();
                console.log("test", musique)

                if (musique != "") {
                    $.ajax({
                        type: 'GET',
                        url: 'recherche.php',
                        data: 'song=' + encodeURIComponent(musique),
                        success: function(data) {
                            if (data != "") {
                                document.getElementById('resultat-search').innerHTML = ""
                                $('#resultat-search').append(data)
                                console.log('musique')
                            } else {
                                document.getElementById('resultat-search').innerHTML = "<div>aucune musique</div>"
                            }
                        }

                    });
                }
            })
        })
    </script>
</body>

</html>