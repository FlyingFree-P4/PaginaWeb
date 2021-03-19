
<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.html");
    exit;
}
 
$con = mysqli_connect("localhost", "root", "", "flyingfree");
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $password = "";
$email_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] === "POST"){
 
    if(empty(trim($_POST["Email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["Email"]);
    }
    
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["Password"]);
    }
    
    if(empty($email_err) && empty($password_err)){
        $sql = "SELECT DNI, Correu, Contrasenya FROM clients WHERE Correu = ? ";
         
        if($stmt = mysqli_prepare($con, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $_POST["Email"]);
            
            $param_email = $email; 

            if(mysqli_stmt_execute($stmt)){                   
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $dni, $email, $password);
                    if(mysqli_stmt_fetch($stmt)){

                      

                        if($password == $_POST["Password"]){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["DNI"] = $dni;
                            $_SESSION["Email"] = $email;                            
                            
                            header("location: index.html");
                        } else{
                            $password_err = "La contrasenya no es correcta.";
                        }
                    }
                } else{
                    $email_err = "Email no valid.";
                }
            } else{
                echo "Oops! Algo ha anat malament. Tornau a prova mes tard.";
            }
            mysqli_stmt_close($stmt);
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
    <title>Login</title>
</head>
<body>
    <header>
    <img src="./img/logo.png" alt="Logo">   
    </header>
    <nav>
       <a class="inici" href="index.html"><img src="./img/inici.png" alt="<-">INICI</a>
        <a class="menu" href="login.html">Login</a>
        
    </nav>
    <section>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post">
           <label for="Email">Email:</label><br>
           <input type="email" name="Email" id="Email"><br>
           <span class="help-block"><?php echo $email_err; ?></span>

           <label for="contrasenya">Contrasenya:</label><br>
           <input type="password" name="Password" id="Password"><br>
           <span class="help-block"><?php echo $password_err?></span>
           <input type="submit" value="Entrar" id="entrar">
           <div class="registre">
            <p>No t'has registrat?</p>
            <a href="registre.php">Registra't</a>
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