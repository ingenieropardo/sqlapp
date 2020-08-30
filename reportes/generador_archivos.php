<?php 
 $tmp = ""; 
    $nr=0;
    $res =  mysql_query($sql);
    $fila = "<tr>";
    $txt = "";
    if($tipo=="XLS" || $tipo=="TXT" || $tipo=="HTML") {
        if(!empty($res)) {
            $tmp = ""; 
            $nr = mysql_num_rows($res);
            $titulo = "Dim - Reporte de Tributos por DIM ";
            $registros = "(No. Registros $nr)";
            $nf = mysql_num_fields($res);
            for($j=0; $j<$nf; $j++) {
                $fila .= "<th>".mysql_field_name($res, $j)."</th>";
                $txt .= mysql_field_name($res, $j)." ";
            }
            $txt .=PHP_EOL;
            $fila .= "</tr>";
            $rawdata = array(); $i=0;
            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;
                $i++;
                for($j=0; $j<$nf; $j++) {
                    $fila .= "<td>".$reg[$j]."</td>";
                    switch ($j) {
                        case 2:  $txt .= esp($reg[$j],3)." ";  break;
                        case 5:  $txt .= esp($reg[$j],33)." ";  break;
                        default: $txt .= $reg[$j]." "; break;
                    }
                }
                $txt  .= PHP_EOL;
                $fila .= "</tr>";
            }
        }  
        $tabla = "<table border='1' cellpadding='2' cellspacing='0'>$fila</table>";
    }
    

    switch ($tipo) {            
        case 'XLS':
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=tributospordim.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>Reporte de Tributos DIM</title>
                <link rel='icon' type='image/jpg' href='/img/logo-hubemar.png' /> 
            </head>
            <style> 
                body { font-family: Arial; } 
                body { font-family: century gothic; }
                td { border-bottom: solid; border-color: #DCDCDC; border-width:1px; padding: 4px; }
                tr:hover { background-color: #00FFFF; }
                td:hover { background-color: #00BFFF; } 
                #head { padding: 10px; margin-top: -10px; margin-left: -10px; text-align: center; background: #FDF6E7 }
                button { border-style: none; margin: 2px; border-radius: 5px; padding: 5px; } button:hover { background-color: #E9DF9B }
            </style>";
            echo "<center><h2>$titulo</h2>$registros</center>".$tabla;
            break;
        case 'TXT':
            header('Content-type: application/msword');
            header('Content-Disposition: inline; filename=tributospordim.txt'); 
            echo "<style>body{font-family: consolas}</style>".utf8_encode($txt);
            break;
        case 'PDF':
            // INICIO DE PDF -------------------------------------------------------
            require('fpdf.php');
            $nr = mysql_num_rows($res);
            
            $grosor = 6*$nr+60;
            $pdf = new FPDF('L', 'mm', array(3320,$grosor));

            $pdf->AliasNbPages();            
            $pdf->SetY(-12);
            $pdf->SetFont('helvetica','',8);
            $pdf->Cell(0,10,' Pagina '.($pdf->PageNo()+1).' de {nb}',0,0,'C');
            $pdf->Image('../img/logo1.png',12,12,10);
            $pdf->Cell(15); $pdf->Cell(0,9,'HUBEMAR SAS',0,1,'');
            $pdf->SetFont('helvetica','B',9);
            $pdf->Cell(15); $pdf->Cell(0,0,'REPORTE DE TRIBUTOS POR DIM',0,1,'');
            $pdf->Ln(0);

            $pdf->SetFont('helvetica','',10);
            $pdf->Cell(1,1,'',0,1,'L');
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('helvetica','',8); 
            $pdf->SetDrawColor(180,180,180);
            $pdf->Cell(3); 
            $pdf->Cell(1,5,"",0,1,'L');
            $pdf->Cell(3,6,"",0,0,"C");
            $pdf->SetFillColor(180,180,180); 
            $ancho = 6;
            $tmp = ""; 

            $titulo = "Dim - Reporte de Tributos por DIM ";
            $registros = "(No. Registros $nr)";

            $nf = mysql_num_fields($res);
            $pdf->Cell(5,6,"No.",1,0,"C",true);
            $c = array();
            
            // Predeterminando ancho de columnas
            for($x=0; $x<=70; $x++) $c[$x] = 50;
            // Personalizado
            $c[0] = 20; $c[1] = 15; $c[2] = 15; $c[3] = 30; $c[4] = 20; $c[5] = 60;  $c[9] = 80; 
            $c[12] = 80;  $c[18] = 25; $c[19] = 25; $c[20] = 30; $c[21] = 25; $c[22] = 25; $c[23] = 40; 
            $c[67]=140;

            for($j=0; $j<$nf; $j++) {
                $campo = mysql_field_name($res, $j)." ";
                $pdf->Cell($c[$j],6,$campo,1,0,"C",true);
            }
            $pdf->Ln(); $pdf->Cell(3,$ancho,"",0,0,"C"); 
            $i=0;
            while($reg = @mysql_fetch_array($res)) {
                $i++;
                $pdf->Cell(5,6,$i,1,0,"C",true);
                for($j=0; $j<$nf; $j++) {
                    $pdf->Cell($c[$j],$ancho,$reg[$j],1,0,'L');
                }
                $pdf->Ln(); $pdf->Cell(3,$ancho,"",0,0,"C"); 
            }  
            $pdf->Output();     
           // FIN PDF -------------------------------------------------------------
            break;
        default:
            break;
    }
?>