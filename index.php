<?php  
    error_reporting(0);
    session_start();
    if(isset($_POST['origen'])){
        $_SESSION['origen'] = $_POST['origen'];
    }
    $ori = 0;
    if(isset($_SESSION['origen'])){
        $ori = $_SESSION['origen'];
    }
    if(isset($_POST['desti'])){
        $_SESSION['desti'] = $_POST['desti'];
    }
    $dest = 0;
    if(isset($_SESSION['desti'])){
        $dest = $_SESSION['desti'];
    }

  // Array amb les parades d'una línia
  // De cada parada, tenim:
  // - el nom de la parada
  // - El temps que triga el tren fins arribar a la següent parada
  // - Els km que separen l'estació actual i la següent estació
  // - L'adreça on es troba aquesta parada
  // - Estat en que es troba l'estació: oberta o tancada

   $linia1 = [
                  ['nom'=>'Hospital_Bellvitge','minuts'=>2,'km'=>5,'address'=>'Carrer Major,45','estat'=>'oberta'],
                  ['nom'=>'Bellvitge','minuts'=>3,'km'=>2,'address'=>'Carrer Pere IV, 67','estat'=>'oberta'],
                  ['nom'=>'Av.Carrilet','minuts'=>2,'km'=>15,'address'=>'Avinguda Carrilet,78','estat'=>'oberta'],
                  ['nom'=>'Rambla_Just_Oliveras','minuts'=>2,'km'=>20,'address'=>'Rambla Just Oliveras, 18','estat'=>'oberta'],
                  ['nom'=>'Can_Serra','minuts'=>3,'km'=>15,'address'=>'Carrer Mar, 67','estat'=>'oberta'],
                  ['nom'=>'Florida','minuts'=>2,'km'=>22,'address'=>'Carrer Alcalde Maret, 2','estat'=>'tancada'],
                  ['nom'=>'Torrassa','minuts'=>2,'km'=>36,'address'=>'Carrer Pins, 7','estat'=>'oberta'],
                  ['nom'=>'Santa_Eulàlia','minuts'=>3,'km'=>10,'address'=>'Carrer Masponts, 7','estat'=>'oberta'],
                  ['nom'=>'Mercat_Nou','minuts'=>2,'km'=>9,'address'=>'Carrer del Mercat, 25','estat'=>'oberta']
                ];
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
</head>
<body>
    <h1>Parades Línea <?php if(isset($linia1)) echo "Blava";?></h1>
    <?php if(isset($linia1)){    
    foreach($linia1 as $linia){
        echo "<a href=index.php?nom=".$linia['nom'].">".$linia['nom']."</a> - ";
    }
    if(isset($_GET['nom'])){
        $nom = $_GET['nom'];
        echo "<br><br> <p>Nom parada: ".$nom."</p>";
        echo "<br><br> <p>Adreça:";
        foreach($linia1 as $linia){
            if($linia['nom'] == $_GET['nom']){
                echo $linia['address'];
            }
        }
        "</p>";
    }
    }
    ?>

    <form action="index.php" method="POST">
    <p>On vols anar?</p>
    Origen:
    <?php
    
        echo "<select name='origen'>";
        $i=0;
        foreach($linia1 as $nom1){
            echo "<option value='$i'";
            if(isset($ori)){
                if($ori == $i){
                    echo "selected";
                }
            }
            echo ">".$nom1['nom']. "</option>";
            $i++;
        }
        echo "</select>";
    ?>
    Destí: 
    <?php
        echo "<select name='desti'>";
        $j=0;
        foreach($linia1 as $nom1){
            echo "<option value='$j'";
            if(isset($dest)){
                if($dest == $j){
                    echo "selected";
                }
            }
            echo ">" . $nom1['nom']. "</option>";
            $j++;
        }
        echo "</select>";
    ?>


    <input type="submit" value="Enviar" name="boto">
    </form>

    <?php
        if(isset($_POST['origen'])){
            $origen = $_POST['origen'];
            
        }
        if(isset($_POST['desti'])){
            $desti = $_POST['desti'];
        }
        
        echo "<p>Has escollit anar de ".$linia1[$origen]['nom']." a ". $linia1[$desti]['nom'] . ".</p>";
        echo " El preu a pagar per anar entre aquestes dues parades és de ";

        $r = $origen - $desti;
        $r2 = abs($r);
        $o = $r2 * 0.35;
        echo $o . ".";
        

        
        
        
    
    
    ?>

    
</body>
</html>