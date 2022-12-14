<?php 

require_once "config.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $surname = trim($_POST["surname"]);
    $name = trim[$_POST["name"]]
    $email = trim[$_POST["email"]];
    $sexe = trim[$POST["sexe"]];
    $activity = trim[$POST["activity"]]
    $companycode = trim[$_POST["companycode"]]
    $password = trim[$_POST['password']] ;
    $confirmpassword = trim[$_POST['confirmpassword']];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($query = $db ->prepare("SELECT * FROM users WHERE email = ?")) {
        $error = '';
    

    $query -> bind_param('s', $email);
    $query -> execute()
    $query->store_result();
        if ($query->num_rows > 0) {
            $error .= '<p class="error">The email address is already registered!</p>';
        } else {
            // Validate password
            if (strlen($password ) < 6) {
                $error .= '<p class="error">Password must have atleast 6 characters.</p>';
            }

            // Validate confirm password
            if (empty($confirmpassword)) {
                $error .= '<p class="error">Please enter confirm password.</p>';
            } else {
                if (empty($error) && ($password != $confirmpassword)) {
                    $error .= '<p class="error">Password did not match.</p>';
                }
            }
            if (empty($error) ) {
                $insertQuery = $db->prepare("INSERT INTO users (surname, sexe, activity, name, companycode,  email, password) VALUES (?, ?, ?, ?, ?, ?, ?);");
                $insertQuery->bind_param("sss", $surname, $sexe, $activity, $name, $companycode, $email, $password_hash);
                $result = $insertQuery->execute();
                if ($result) {
                    $error .= '<p class="success">Your registration was successful!</p>';
                } else {
                    $error .= '<p class="error">Something went wrong!</p>';
                }
            }
        }
    }
    $query->close();
    $insertQuery->close();
    // Close DB connection
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="C:\Users\victo\Documents\ChironGroup\AccueilPage\inscriptionUser1.css"/>
    </head>
    <header>
        <div class="header-left">
            <img class="logo" src='./chironGroup.png'/>
            <p class="connexion">Chiron Group</p>
        </div>
        <div class="recherche">
            <input class="input" type='text'/>
        </div>
            <div class="header-right">
                <img class="french-flag" alt="flag" src='https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg'/>
                <img alt="profile" src="./user.png"/>
                <img class="burger-menu" alt="menu" src="./burgerMenu.png"/>
            </div>        
    </header>
    <body class="body-inscription">
       <div class="inscription-box">
        <p id="inscription-entreprise">Inscription</p>
        <?php echo $success; ?>
        <?php echo $error; ?>
        <form action="" method="post"> 
            <div class="inscription-form">
                <div class="inscription-box-element">
                    <label>Nom de Famille</label>
                    <input class="inscription-input"  name='name' type='text'/>
                </div>
                <div class="inscription-box-element">
                    <label>Prénom</label>
                    <input class="inscription-input" name="surname" type="text" />
                </div>
                <div class="inscription-box-element"> 
                    <label>Sexe</label>
                    <input class="inscription-input" name='sexe' type='text'/>
                </div>
                <div class="inscription-box-element">
                    <label>Service d'activité</label>
                    <input class="inscription-input" name='activity' type="text" />
                </div>   
                <div class="inscription-box-element">
                    <label>Code Entreprise</label>
                    <input class="inscription-input" name='companycode' placeholder='code' type='text'/>
                </div>
                <div class="inscription-box-element">
                    <label>Adresse Mail</label>
                    <input class="inscription-input" name='email' placeholder="email" type="text" />
                </div>
                <div class="inscription-box-element"> 
                    <label>Mot de Passe</label>
                    <input class="inscription-input" name='password' placeholder='password' type='password'/>
                </div>
                <div class="inscription-box-element">
                    <label>Confirmer votre mot de passe</label>
                    <input class="inscription-input" name='confirmpassword' placeholder='confirm password' type="password" />
                </div>   
                <input class='inscription-user2' name='submit' type="submit" value="Confirmer"/>
            </div>
        </form>
        
       </div>
    </body>
    <footer>
        <div class="footer">
            <div class="information-legal">
                <p class="information-legal-element" id="information-legal">Informations légales</p>
                <p class="information-legal-element">Données personnelles</p>
                <p class="information-legal-element">Mentions Légales</p>
            </div>
            <div class="a-propos">
                <p class="a-propos-element" id="a-propos">A propos</p>
                <p class="a-propos-element">CGU</p>
                <p class="a-propos-element">FAQ</p>
            </div>
            <div class="clients">
                <p class="clients-element" id="clients">Clients</p>
                <p class="clients-element">Entreprises</p>
                <p class="clients-element">Particuliers</p>
            </div>
        </div>
    </footer>
