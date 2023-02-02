<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <!-- mise en page du formulaire en HTML -->
    <form action="#" method="post" name="form" id="form"style='float:left'>
        <label for="nameFirstname">Nom et prénom :</label>
       <input type="text" name="nameFirstname" id="nameFirstname" placeholder="Entrez votre nom et prénom"><br>
       <label for="mail">Adresse email :</label>
       <input type="email" name="mail" id="mail" placeholder="Entrez votre adresse email"><br>
       <label for="message">Message :</label> <br>
       <textarea name="message" id="message" cols="30" rows="10" style="resize: none;" placeholder="Entrez votre message..."></textarea><br>
       <input type="submit" value="Envoyer" name="submit" id="submit">
    </form>

    <?php
        $nameFirstname=$_POST['nameFirstname'];
        $mail =$_POST['mail'];
        $message =$_POST['message'];
        //conexion à la base de données 
        try {
        $connection = new PDO('mysql:host=localhost;dbname=makeo', 'root', '');
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
         }
        //traitement et envoie a la base de données
         $insert ="INSERT INTO infos VALUES ('$nameFirstname','$mail','$message') ";
         $result = $connection->exec($insert);
        // affichage des infos de la base de données
        $select= "SELECT * FROM infos ";
        $result= $connection->query($select);
         
        if ($result->rowCount()>0) {
            echo "<table style='float:right'>";
            echo "<tr>";
            echo "<th>Nom et prénom</th>";
            echo "<th>Adresse email</th>";
            echo "<th>Message</th>";
            echo "</tr>";
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>".$row['nameFirstname']."</td>";
                echo "<td>".$row['mail']."</td>";
                echo "<td>".$row['message']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        //fermeture de la connexion à la base de données
         $connection = null;

        

         
         ?>
    
</body>
</html>