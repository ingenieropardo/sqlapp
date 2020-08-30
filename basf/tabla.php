<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
</head>
<body>
    <style>
        body { font-family: century gothic; }
        td { border-bottom: solid; border-color: #DCDCDC; border-width:1px; padding: 4px; }
        tr:hover { background-color: #00FFFF; }
        td:hover { background-color: #00BFFF; } 
        #head { padding: 10px; margin-top: -10px; margin-left: -10px; text-align: center; background: #FDF6E7 }
        button { border-style: none; margin: 2px; border-radius: 5px; padding: 5px; } button:hover { background-color: #E9DF9B }
    </style>
    <table id='tabla' border=0 cellspacing=0>
    <?php
        echo "<div id='head'><b><font size='4'>TITULO INFORME </font></b><br>";
        echo "<font size='2'>Resultados y/o Parametros</font><br>";
        echo "<button onclick='ShowAll(0)'>Filas</button>";
        echo "<button onclick='ShowAll(1)'>Columnas</button>";
        echo "<button onclick='ShowAll(2)'>Todo</button></div>";
        
        for($fila=1; $fila<=10; $fila++) {
            echo "<tr>";
            if($fila==1)

                for($colu=1; $colu<=10; $colu++) {
                    echo "<th ondblclick='ocultar(1,$colu)'>Columna $colu</th>";
                }
            else
                for($colu=1; $colu<=10; $colu++) {
                    echo "<td ondblclick='ocultar(0,$fila)' >&nbsp;&nbsp;xxx $fila $colu xxxxxx &nbsp;&nbsp;&nbsp;&nbsp;</td>";
                }
            echo "</tr>";
        }
    ?>
    </table>
</body>
</html>

<script>
    function ocultar(tipo,ind){
        var i = 0; var j = 0;
        var filas = document.getElementById('tabla').rows.length;

        if(tipo==0) {
            for(i = 0; i < filas; i++)
                if(i != (ind-1) && i != 0)
                    document.getElementById('tabla').rows[i].style.display = 'none'; }
        else ocultarColumna(ind);
    }

    function ocultarColumna(num) 
        { num=num-1;
          filatabla=document.getElementById('tabla').getElementsByTagName('tr');
          filatabla[0].getElementsByTagName('th')[num].style.display='none'
          for(i=1;i<filatabla.length;i++)
                if (filatabla[i].getElementsByTagName('td')[num].style.display=='none') 
                      filatabla[i].getElementsByTagName('td')[num].style.display='';      
                else  filatabla[i].getElementsByTagName('td')[num].style.display='none'
        }

    function ShowAll(param=0) {
        var i = 0;
        var j = 0;
        var filas = document.getElementById('tabla').rows.length;

        for(i = 0; i < filas; i++) {
            if(param==0 || param==2) document.getElementById('tabla').rows[i].style.display = '';
            if(param==1 || param==2) {
                  filatabla=document.getElementById('tabla').getElementsByTagName('tr');
                  filatabla[0].getElementsByTagName('th')[i].style.display=''
                  
                  for(f=1;f<filatabla.length;f++)
                              filatabla[f].getElementsByTagName('td')[i].style.display='';      
            }
        }
    }
</script>