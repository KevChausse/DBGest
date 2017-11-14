<?php

    include_once('../_header.php');

?>
    <div class="container">

        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <h1>Fichier de logs</h1>
            </div>
        </div>    


        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
<?php

    echo nl2br(htmlentities(file_get_contents('../files/logs.txt')));

?>
                </p>
            </div>
        </div>

<?php

        


    include_once('../_footer.php');

?>