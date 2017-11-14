<?php

    include_once('../_header.php');
    include_once('../class/dbaccess.class.php');

    //fichier de saisie des paramètres (connexion à la bdd)
    $dbaccess = new DBAccess();
    
    $dbuser = $dbaccess->tab['user'];
    $dbpassword = $dbaccess->tab['password'];
    $dbport = $dbaccess->tab['port'];
    $dbhost = $dbaccess->tab['host'];
    $dbname = $dbaccess->tab['name'];

?>

<div class="container">
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <h1><center>Paramètres d'accès à la base de données</center></h1>
        </div>
    </div>&nbsp;


    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <form method="post" action="_params.php">
                <fieldset>

                    <div class="form-group">
                        <label for="hostname">Hôte</label><br/>
                        <input type="text" value="<?php echo $dbhost; ?>" name="hostname" placeholder="Nom de l'hôte" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="port">Port</label><br/>
                        <input type="text" value="<?php if($dbport!="") echo $dbport; else echo "3306"; ?>" name="port" placeholder="Numéro de port" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label><br/>
                        <input type="text" value="<?php echo $dbuser; ?>" name="username" placeholder="Nom de l'utilisateur" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe:</label><br/>
                        <input type="password" value="<?php echo $dbpassword; ?>" name="password" placeholder="Mot de passe" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="dbname">Nom de la base:</label><br/>
                        <input type="text" value="<?php echo $dbname; ?>" name="dbname" placeholder="Nom de la base de données" class="form-control">
                    </div>


                    <div class="form-group">
                        <input type="submit" id="submit" value="Envoyer" class="form-control btn btn-primary">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


<?php

    include_once('../_footer.php');

?>