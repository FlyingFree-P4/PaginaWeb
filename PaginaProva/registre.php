<?php

$con = mysqli_connect("localhost", "root", "", "flyingfree");
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$dni = $contrasenya = $rcontrasenya = "";
$dni_err = $contrasenya_err = $rcontrasenya_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty(trim($_POST["DNI"]))) {
    $dni_err = "Si us plau, insereix un DNI.";
  } else {
    $sql = "SELECT DNI FROM clients WHERE DNI = ?";
  
    if ($stmt = mysqli_prepare($con, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_dni);

      $param_dni = trim($_POST["DNI"]);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $dni_err = "Aquest DNI ja existeix en el sistema.";
        }else{
          $dni = trim($_POST["DNI"]);
        }
      }else{
        echo "Ups! Hi ha hagut un error, torna a intentar més tard.";
      }
        mysqli_stmt_close($stmt);
    }
  }

  if (empty(trim($_POST["Password"]))) {
    $contrasenya_err = "Si us plau insereix una contrasenya.";
  } elseif (strlen(trim($_POST["Password"])) < 6) {
    $contrasenya_err = "La contrasenya ha de tenir com a mínim 6 caràcters.";
  } else{
    $contrasenya = trim($_POST["Password"]);
  }

  if (empty(trim($_POST["rcontrasenya"]))) {
    $rcontrasenya_err = "Si us plau confirmeu la contrasenya.";
  } else{
    $rcontrasenya = trim($_POST["rcontrasenya"]);
      if (empty($contrasenya_err) && ($contrasenya != $rcontrasenya)) {
        $rcontrasenya_err = "Les contrasenyes no coincideixen.";
      }
  }

  if (empty($dni_err) && empty($contrasenya_err) && empty($rcontrasenya_err)) {
    
   if(isset($_POST['save'])){

        $dni = $_POST['DNI'];
        $Nom = $_POST['nom'];
        $Cognom = $_POST['cognom'];
        $Email = $_POST['Email'];
        $contrasenya = $_POST['Password'];
        $sql = "INSERT INTO clients (DNI,nom,cognom,correu,Contrasenya) VALUES ('$dni','$Nom','$Cognom','$Email','$contrasenya')";
            if (mysqli_query($con,$sql)){
                echo "<script> alert('Benvingut');window.location= 'index.html' </script>";
            }else{
                echo "Error: " . $sql;
            }
    }
  }
mysqli_close($con);
}


?>

<!DOCTYPE html>
<html lang="ca">
<head>
   <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <title>Registre</title>
</head>
<body>
    <header>
    <img src="./img/logo.png" alt="Logo">   
    </header>
    <nav>
        <a class="inici" href="index.html"><img src="./img/inici.png" alt="<-">INICI</a>
        <a class="menu" href="registre.html">Registre</a>
    </nav>
    <section>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <label for="DNI">DNI:</label><br>
           <input type="text" name="DNI" id="DNI"><br>
           
           <label for="nom">Nom:</label><br>
           <input type="text" name="nom" id="nom"><br>
           <label for="cognom">Cognom:</label><br>
           <input type="text" name="cognom" id="cognom"><br>
           <label for="email">Email:</label><br>
           <input type="email" name="Email" id="Email"><br>
           <label for="contrasenya">Contrasenya:</label><br>
           <input type="password" name="Password" id="Password"><br>
           <label for="rcontrasenya">Repeteix contrasenya:</label><br>
           <input type="password" name="rcontrasenya" id="rcontrasenya"><br>
           <input type="submit" name="save" value="submit" id="entrar">
           <div class="registre">
            <p>Ja tens compte?</p>
            <a href="login.php">Logueja't</a>
        </div> 
        </form>
           
    </section>
    <footer>
        <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-youtube"></a>
    </footer>
</body>
</html>