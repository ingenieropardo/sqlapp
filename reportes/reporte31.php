<?php

    include("../config/funciones.php");
    $tipo = $_GET['p_tipo']; 
    $sucursal     = $_GET['p_sucursal']; 
    $importador   = $_GET['p_importador']; 
    $tercero      = $_GET['p_tercero']; 
    $ejecutivo    = $_GET['p_ejecutivo'];
    $reporte      = $_GET['p_reporte'];
    $numerodo     = $_GET['p_numerodo'];
    $numeroped    = $_GET['p_numeroped']; 
    $ordencompra  = $_GET['p_ordencompra'];
    $doctrans     = $_GET['p_doctrans'];
    $modalidad    = $_GET['p_modalidad'];
    $faperturai   = $_GET['p_faperturai'];
    $faperturaf   = $_GET['p_faperturaf'];
    $flevantei    = $_GET['p_flevantei'];
    $flevantef    = $_GET['p_flevantef'];
    $faceptai     = $_GET['p_faceptai'];
    $faceptaf     = $_GET['p_faceptaf'];
    $fmercanciai  = $_GET['p_fmercanciai'];
    $fmercanciaf  = $_GET['p_fmercanciaf'];
    $fretiroi     = $_GET['p_fretiroi'];
    $fretirof     = $_GET['p_fretirof'];
    $fstickeri    = $_GET['p_fstickeri'];
    $fstickerf    = $_GET['p_fstickerf'];
    $ffacturai    = $_GET['p_ffacturai'];
    $ffacturaf    = $_GET['p_ffacturaf'];
    $param_fecha="";
    $titulo="INFORME DECLARACIONES BASF";

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I'";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";
        

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  FD.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  FD.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  FD.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";
    }    else {
        
        if($numerodo!=""){
            $filtros= " WHERE ED.NUMERO_DO='$numerodo'";
        } 

        if($$numeroped!=""){
            $filtros= " WHERE ED.NUMERO_PEDIDO='$numeroped'";
        } 

        if($ordencompra!=""){
            $filtros= " WHERE ED.NUMERO_ORDEN_COMPRA='$ordencompra'";
        } 

        if($doctrans!=""){
            $filtros= " WHERE DT.NUMERO_DOC_TRANS='$doctrans'";
        } 

    }
    
    conectaremoto();


    // Dim - Reporte de Tributos por DIM
    $sql  = "SELECT ED.NUMERO_DO, ED.NUMERO_PEDIDO, ED.TIPO_REGIMEN, CF.NOMBRE_EXPORTADOR, UPPER(T.NOMBRE_TRANSPORTADOR), 
            UC.TIPO_CARGA, UC.DIMENSIONES, UC.NUMERO_ID_CONTENEDOR,  DATE_FORMAT(I.FECHA_LLEGADA_MCIA, '%d/%m/%Y') FECHA_ETAR,
            DATE_FORMAT(COALESCE(I.FECHA_LIBERACION, I.FECHA_LEVANTE),'%d/%m/%Y') FECHA_LEVANTE, I.FECHA_RETIRO_TOTAL, 
            DATE_FORMAT(I.FECHA_MERCANCIA_EN_PLANTA,'%d/%m/%Y') FECHA_MERCANCIA_PLANTA, 
            DATE_FORMAT(UC.FECHA_DEVOLUCION,'%d/%m/%Y') FECHA_DEVOLUCION,  LEFT(ED.DESCRIPCION,250) PRODUCTO, 
            MR.NOMBRE_MODALIDAD,  DTI.NUMERO_DOC_TRANS DOCUMENTO_TRANSPORTE, CF.CANTIDAD CANTIDADKL, 
            PA.NOMBRE_PAIS NOMBRE_PAIS,  IF(UC.CODIGO_TIPO_UNIDAD_CARGA=2, 'FCL','LCL') FCLLCL, 
            MT.NOMBRE_MEDIO_TRANS MODO_TRANSPORTE,   ED.NUMERO_FACTURA, ED.FECHA_FACTURA, ED.NUMERO_ORDEN_COMPRA,
            DTI.FLETE FLETE,   I.BODEGAJE_GESTION_COMERCIAL_VALOR COSTOS_TERRESTRES,  COALESCE(A.GASTOS_PORTUARIOS,0) GASTOS_PORTUARIOS ,  
            ( (FV.SUBTOTAL_FACTURA+FV.IVA_FACTURA+FV.TOTAL_GASTOS_DO+FV.VALOR_GRAVAMEN_FINANCIERO) -  (FV.VALOR_RTE_ICA + FV.VALOR_RTE_IVA +  FV.VALOR_RTE_FTE + COALESCE(A.GASTOS_PORTUARIOS,0) ) ) OTROS_GASTOS  ,
            FV.SUBTOTAL_FACTURA,FV.IVA_FACTURA, FV.TOTAL_GASTOS_DO, FV.VALOR_GRAVAMEN_FINANCIERO, 
            FV.VALOR_RTE_ICA, FV.VALOR_RTE_IVA , FV.VALOR_RTE_FTE ,  COALESCE(A.GASTOS_PORTUARIOS,0) 

        FROM IMPORTACIONES I
        INNER JOIN DOCUMENTOS_TRASPORTE DTI ON DTI.NUMERO_DO=I.NUMERO_DO
        INNER JOIN ESTADOS_DO ED ON I.NUMERO_DO=ED.NUMERO_DO
        LEFT OUTER JOIN MODALIDADES_REGIMENES  MR ON MR.ID_MODALIDAD=ED.ID_MODALIDAD
        LEFT OUTER JOIN PAISES    PA ON PA.CODIGO_PAIS=DTI.CODIGO_PAIS_PROCEDENCIA
        LEFT OUTER JOIN TRASPORTADORES T ON T.CODIGO_TRANSPORTADOR=DTI.CODIGO_TRANSPORTADOR
        LEFT OUTER JOIN MEDIOS_TRASPORTE MT ON MT.CODIGO_MEDIO_TRANS=DTI.CODIGO_MEDIO_TRANS
        
        LEFT OUTER JOIN facturas_ventas FV ON FV.CODIGO_SUCURSAL=ED.CODIGO_SUCURSAL_OP AND FV.NUMERO_FACTURA_VENTA=ED.NUMERO_FACTURA AND FV.VERIFICADO='S' AND FV.ANULADO='N'
        LEFT OUTER JOIN ( SELECT C.NUMERO_DO, E.NOMBRE_EXPORTADOR, SUM(DF.CANTIDAD) CANTIDAD FROM CABEZA_FACTURAS C 
          LEFT OUTER JOIN   DETALLES_FACTURAS DF ON DF.ID_CABEZA_FACTURA=C.ID_CABEZA_FACTURA 
          LEFT OUTER JOIN EXPORTADORES E ON E.ID_EXPORTADOR=C.ID_EXPORTADOR GROUP BY 1 ) CF 
          ON CF.NUMERO_DO=I.NUMERO_DO 
        LEFT OUTER JOIN ( SELECT NUMERO_DO, CODIGO_TIPO_UNIDAD_CARGA, FECHA_DEVOLUCION, 
          CASE CARGA_EN_CONTENEDOR WHEN '1' THEN 'SUELTA' WHEN '2' THEN 'CONTENEDORIZADA'  WHEN '3' THEN  'GRANEL' WHEN '4' THEN 'MIXTA' WHEN '5' THEN  'ISOTANQUE'  ELSE 'FLEXITANQUE' END AS TIPO_CARGA , 
          GROUP_CONCAT(NUMERO_ID_CONTENEDOR) NUMERO_ID_CONTENEDOR, 
          GROUP_CONCAT(  CASE TAMANO WHEN '1' THEN '20 PIES' WHEN '2' THEN 'HIGH CUBE'   WHEN '3' THEN  '40 PIES' WHEN '4' THEN '45 PIES' END )  DIMENSIONES FROM UNIDADES_CARGA   GROUP BY 1 ) UC  ON UC.NUMERO_DO=I.NUMERO_DO 
        
        
        LEFT OUTER JOIN (SELECT D.NUMERO_DO, SUM(D.VALOR) GASTOS_PORTUARIOS  FROM MOVIMIENTOS_DOS D
            INNER JOIN CONCEPTOS_GTOS_INGS C ON C.ID_CONCEPTO_GTO_ING =D.ID_CONCEPTO_GTO_ING
                       WHERE D.ID_CONCEPTO_GTO_ING=185 OR D.ID_CONCEPTO_GTO_ING=605 OR D.ID_CONCEPTO_GTO_ING=195 OR
                             D.ID_CONCEPTO_GTO_ING=235 OR D.ID_CONCEPTO_GTO_ING=421 OR D.ID_CONCEPTO_GTO_ING=193 OR
                             D.ID_CONCEPTO_GTO_ING=596 OR D.ID_CONCEPTO_GTO_ING=616 OR D.ID_CONCEPTO_GTO_ING=409 OR
                             D.ID_CONCEPTO_GTO_ING=234 OR D.ID_CONCEPTO_GTO_ING=574 OR D.ID_CONCEPTO_GTO_ING=209 OR
                             D.ID_CONCEPTO_GTO_ING=464 OR D.ID_CONCEPTO_GTO_ING=190 OR D.ID_CONCEPTO_GTO_ING=437 OR
                             D.ID_CONCEPTO_GTO_ING=286 OR D.ID_CONCEPTO_GTO_ING=281 OR D.ID_CONCEPTO_GTO_ING=418 OR
                             D.ID_CONCEPTO_GTO_ING=598 OR D.ID_CONCEPTO_GTO_ING=188 OR D.ID_CONCEPTO_GTO_ING=539 OR
                             D.ID_CONCEPTO_GTO_ING=618 OR D.ID_CONCEPTO_GTO_ING=516 OR D.ID_CONCEPTO_GTO_ING=186 OR
                             D.ID_CONCEPTO_GTO_ING = 518 Or D.ID_CONCEPTO_GTO_ING = 403 
                   GROUP BY 1 ) A ON A.NUMERO_DO=I.NUMERO_DO AND ED.NUMERO_FACTURA IS NOT NULL 
        

    $filtros  
    $param_fecha
";    

    $tmp = ""; 
    $nr=0;
    $res =  mysql_query($sql);
    $fila = "<tr>";
    $txt = "";
    if($tipo=="XLS" || $tipo=="TXT" || $tipo=="HTML") {
        if(!empty($res)) {
            $tmp = ""; 
            $nr = mysql_num_rows($res);
            
            $registros = " Registros $nr";
            $nf = mysql_num_fields($res);

            //TITULOS DE CABECERA
            for($j=0; $j<$nf; $j++) {
                $fila .= "<th>".mysql_field_name($res, $j)."</th>";
                $txt .= mysql_field_name($res, $j)." ";
            }

            $txt .=PHP_EOL;
            $fila .= "</tr>";
            $rawdata = array(); $i=0;
            $sw=0;


            //LECTURA QUERY Y FORMATEO DE CELDAS

            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;

                $txt .= utf8_decode($reg[$j]);
                
                for($j=0; $j<$nf; $j++) {
                    
                    switch($j) {

                        // Pasar de numero a texto
                        case 0:
                        case 1:
                        case 4:
                        case 5:
                        case 7:
                        {  
                            $fila .=  "<td style= mso-number-format:'@';>". utf8_decode($reg[$j])."</td>";
                             break;
                        }                        
                        
                        // Alinear celda a la derecha
                        case 2:
                        case 3:
                        {  
                            $fila .=  "<td align='right'>". utf8_decode($reg[$j])."</td>";
                             break;
                        }    

                        // Alinear celda al centro fechas
                        case 6:
                        {  
                            $fila .=  "<td align='center'>". utf8_decode($reg[$j])."</td>";
                             break;
                        }    
                        case 8:
                        {  
                            $fila .=  "<td align='center'>". utf8_decode($reg[$j])."</td>";
                             break;
                        }    


                        default:
                        {  
                            $fila .= "<td>". utf8_decode($reg[$j])."</td>";
                             break;
                        }

                    }
         
                }
                $i+=1;
                $txt  .= PHP_EOL;
                $fila .= "</tr>";
            }
        }  
        $tabla = "<table border='1' cellpadding='2' cellspacing='0'>$fila</table>";
    }
    

    switch ($tipo) {            
        case 'XLS':
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=" .$titulo .".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "  <link rel='stylesheet' href='../css/pushy.css'>
                    <link rel='stylesheet' href='../css/bootstrap.css'>
                    <link rel='stylesheet' href='../css/bootstrap.min.css'>
                    <link rel='stylesheet' href='../css/bootstrap-responsive.css'>
                    <link rel='stylesheet' href='../css/bootstrap-responsive.min.css'>
                    <link rel='icon' type='image/jpg' href='../img/logo-hubemar.png' /> 
                    <title>$titulo</title>
                    <style> 
                        body { font-family: Arial; }
                        th { background-color: #000099; color: white; text-align: center !important; }
                        tr:hover { background-color: #E2E2E2; color: #684242;  }
                        #info {
                            width: 99%;
                            height: 82%;
                            overflow-y: scroll;
                            margin: 0px;
                            padding: 5px;
                            border-style: solid;
                            border-color: grey;
                        }
                    </style>";
            echo   "<center><h3><img style='width: 60px;' src='../img/logo1.png'><br>$titulo</h3>".fechaactual(2)." - $registros</center>
                    <div id='info' style='margin-left:15px'>
                        <table border='1' cellpadding='2' class='table table-bordered table-condensed' cellspacing='0'>$fila</table>
                    </div>";
             
            break;
        case 'TXT':
            header('Content-type: application/msword');
            header('Content-Disposition: inline; filename='.$file.'.txt'); 
            echo (utf8_encode($txt));
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
            $pdf->Cell(15); $pdf->Cell(0,0,$titulo,0,1,'');
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

            
            $registros = "(No. Registros $nr)";

            $nf = mysql_num_fields($res);
            $pdf->Cell(5,6,"No.",1,0,"C",true);
            $c = array();
            
            // Personalizado
            $c[0] = 50; $c[1] = 50; $c[2] = 30; $c[3] = 30; $c[4] = 100; $c[5] = 40;  $c[6] = 40; 
            $c[7] = 60;  $c[8] = 60; $c[9] = 30;

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