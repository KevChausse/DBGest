<?php

    include_once('../_header.php');

?>

<div class="container">
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Recherche de noms de colonnes</h3>
            </div>
            <div class="panel-body">
                <form onsubmit="load_col(); return false;">
                    <input type="text" class="form-control" id="col-filter" data-action="filter" data-filters="#col" placeholder="Filter Column" />
                </form>
            </div>
            <table class="table table-hover" id="col">
                <thead>
                    <tr>
                        <th>Nom colonne</th>
                        <th>Table</th>
                    </tr>
                </thead>
                <tbody id="results-col">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6" id="show-table">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" id="table-name">Recherche de table</h3>
                <div class="pull-right">
                </div>
            </div>
            <div class="panel-body">
                <form onsubmit="load_table(); return false;">
                    <input type="text" class="form-control" id="table-filter" data-action="filter" data-filters="#table" placeholder="Filter Table" />
                </form>
            </div>
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th>Colonne</th>
                        <th>Table</th>
                    </tr>
                </thead>
                <tbody id="results-table">
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

    function load_col(){
        $.ajax({
            url : '_search.php', 
            type : 'POST' ,
            data : 'col='+$("#col-filter").val(),
            dataType: 'html',
            success : function(code_html, statut){ 
                $("#results-col").html(code_html)
            }
        });
    }

    function load_table(id=""){
        if(id==""){
            id=$("#table-filter").val()
        }
        else
        {
            $("#table-filter").val("");
        }
        $.ajax({
            url : '_search.php', 
            type : 'POST' ,
            data : 'table='+id,
            dataType: 'html',
            success : function(code_html, statut){ 
                $("#results-table").html(code_html)
            }
        });
        if(id!="")
            $("#table-name").html("Table: <i>"+id+"</i>");
        else
            $("#table-name").html("Recherche de table");
    }

    
</script>

<?

    include_once('../_footer.php');

?>