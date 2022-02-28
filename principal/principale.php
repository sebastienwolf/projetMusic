<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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

                    <form action="" method="GET">
                        <input type="text" placeholder="search" name="pseudo" required>
                        <input type="submit" id='submit' value='search'>
                    </form>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <!-- <section>
            <div>
                <form id="selectTheme" action="./question.php" method="post">
                    <input type="submit" value="rock" name="rock" id="rock" class="theme" data-info="rock">
                    <input type="submit" value="electro" name="electro" id="electro" class="theme" data-info="electro">
                </form>
            </div>
            <div></div>
        </section> -->

        <section>
            <?php
            $search = $_POST['search'];

            $servername = "localhost";
            $username = "sebastien ";
            $password = "sebastien";
            $db = "test";

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "select * from QUESTIONS where qst_txt like '%$search%'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo $row["qst_txt"] . "<br>";
                }
            } else {
                echo "0 records";
            }

            $conn->close();
            ?>
        </section>

    </main>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../script.js"></script>
</body>

</html>