<?php
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
    $titulo="POLIZA UAP";

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
    include("../config/funciones.php");
    conectaremoto();

    // Dim - Reporte de Tributos por DIM
    $sql  = "SELECT I.NUMERO_IDENTIFICACION 'NUMERO IDENTIFICACION', I.NOMBRE_IMPORTADOR 'NOMBRE IMPORTADOR',
  IM.CODIGO_ADMINISTRACION 'CODIGO ADMINISTRACION', I.CIUDAD_DOMICILIO 'CIUDAD DOMICILIO', '8904030776' NITDECLARANTE,
  EM.NUMERO_IDENTIFICACION 'NUMERO IDENTIFICACION', I.CODIGO_TIPO_IMPORTADOR 'CODIGO TIPO IMPORTADOR',
  I.CODIGO_ACT_ECONOMICA 'CODIGO ACT ECONOMICA', FD.CODIGO_TIPO_DECLARACION 'CODIGO TIPO DECLARACION',
  FD.DECLARACION_ANTERIOR 'DECLARACION ANTERIOR', FD.FECHA_DECLAR_ANTERIOR 'FECHA DECLAR ANTERIOR',
  FD.CODIGO_ADMINISTRACION_ANT 'CODIGO ADMINISTRACION ANT', FD.NUMERO_DEX 'NUMERO DEX', FD.FECHA_DEX 'FECHA DEX',
  FD.CODIGO_ADMINISTRACION_DEX 'CODIGO ADMINISTRACION DEX', LI.NOMBRE_LUGAR_INGRESO 'NOMBRE LUGAR INGRESO',
  IM.CODIGO_DEPOSITO 'CODIGO DEPOSITO', DT.NUMERO_MANIFIESTO 'NUMERO MANIFIESTO', DT.FECHA_MANIFIESTO 'FECHA MANIFIESTO',
  DT.NUMERO_DOC_TRANS 'NUMERO DOC TRANS', DT.FECHA_DOC_TRANS 'FECHA DOC TRANS', EX.NOMBRE_EXPORTADOR 'NOMBRE EXPORTADOR',
  EX.CIUDAD 'CIUDAD', EX.CODIGO_PAIS 'CODIGO PAIS', EX.DIRECCION 'DIRECCION', EX.EMAIL 'EMAIL', CF.NUMERO_FACTURA 'NUMERO FACTURA',
  CF.FECHA_FACTURA 'FECHA FACTURA', DT.CODIGO_PAIS_PROCEDENCIA 'CODIGO PAIS PROCEDENCIA',
  DT.CODIGO_MEDIO_TRANS 'CODIGO MEDIO TRANS', DT.CODIGO_BANDERA 'CODIGO BANDERA',
  IM.CODIGO_DEPARTAMENTO_DESTINO 'CODIGO DEPARTAMENTO DESTINO', DT.CODIGO_TRANSPORTADOR 'CODIGO TRANSPORTADOR',
  T.NOMBRE_TRANSPORTADOR 'NOMBRE TRANSPORTADOR', ED.TRM 'TRM', FD.CODIGO_POSICION 'CODIGO POSICION',
  FD.CODIGO_MODALIDAD 'CODIGO MODALIDAD', FD.CUOTAS_MESES 'CUOTAS MESES', FD.VALOR_CUOTA_USD 'VALOR CUOTA USD',
  FD.PERIODICIDAD_CUOTA 'PERIODICIDAD CUOTA', CF.PAIS_ORIGEN 'PAIS ORIGEN', FD.CODIGO_ACUERDO 'CODIGO ACUERDO',
  FD.CODIGO_FORMA_PAGO 'CODIGO FORMA PAGO', FD.CODIGO_TIPO_IMPORTACION 'CODIGO TIPO IMPORTACION', CF.PAIS_COMPRA 'PAIS COMPRA',
  FD.PESO_BRUTO 'PESO BRUTO', FD.PESO_NETO 'PESO NETO', FD.CODIGO_EMBALAGE 'CODIGO EMBALAGE', FD.BULTOS 'BULTOS',  NULL SUBPARTIDA,
  PA.CODIGO_UNIDAD_CCIAL_DIAN 'CODIGO UNIDAD CCIAL DIAN', FD.CANTIDAD 'CANTIDAD',  FD.VALOR_TOTAL_FOB 'VALOR TOTAL FOB',
  FD.VALOR_FLETES 'VALOR FLETES', FD.VALOR_SEGUROS 'VALOR SEGUROS', FD.VALOR_OTROS_GASTOS 'VALOR OTROS GASTOS',
  FD.SUM_FLE_SEG_OTROS 'SUM FLE SEG OTROS', FD.AJUSTE_VALOR 'AJUSTE VALOR', FD.VALOR_ADUANA 'VALOR ADUANA',
  FD.CODIGO_REG_LICENCIA 'CODIGO REG LICENCIA',FD.NUMERO_REG_LICENCIA 'NUMERO REG LICENCIA',
  FD.CODIGO_OFICINA_INCOMEX 'CODIGO OFICINA INCOMEX', FD.ANO_EXPEDICION 'AÑO EXPEDICION',
  FD.PROGRAMA_AUTORIZADO 'PROGRAMA AUTORIZADO', FD.CIP 'CIP', UCASE(LEFT(TRIM(FD.DESCRIPCION), 4700)) 'DESCRIPCIÓN',
  FD.PORCENTAJE_ARANCEL 'PORCENTAJE ARANCEL', FD.BASE_ARANCEL 'BASE ARANCEL', FD.TOTAL_ARANCEL 'TOTAL ARANCEL',
  FD.PAGAR_ARANCEL 'PAGAR ARANCEL', FD.PORCENTAJE_IVA 'PORCENTAJE IVA', FD.BASE_IVA 'BASE IVA', FD.TOTAL_IVA 'TOTAL IVA',
  FD.PAGAR_IVA 'PAGAR IVA', FD.PORCENTAJE_SANCIONES 'PORCENTAJE SANCIONES', FD.BASE_SANCIONES 'BASE SANCIONES',
  FD.TOTAL_SANCIONES 'TOTAL SANCIONES', FD.PAGAR_SANCIONES 'PAGAR SANCIONES', FD.PORCENTAJE_OTROS 'PORCENTAJE OTROS',
  FD.BASE_OTROS 'BASE OTROS', FD.TOTAL_OTROS 'TOTAL OTROS', FD.PAGAR_OTROS 'PAGAR OTROS',
  FD.VALOR_PAGO_ANTERIORES 'VALOR PAGO ANTERIORES', FD.RECIBO_PAGO_ANTERIOR'RECIBO PAGO ANTERIOR',
  FD.FECHA_PAGO_ANTERIOR 'FECHA PAGO ANTERIOR', FD.NUMERO_ACEPTACION 'NUMERO ACEPTACION', FD.FECHA_ACEPTACION 'FECHA ACEPTACION',
  FD.NUMERO_LEVANTE 'NUMERO LEVANTE', FD.FECHA_LEVANTE 'FECHA LEVANTE', FD.NUMERO_STICKER 'NUMERO STICKER',
  FD.FECHA_PAGO 'FECHA PAGO'

    FROM FORMULARIOS_DIS FD

    LEFT OUTER JOIN ESTADOS_DO              ED   ON ED.NUMERO_DO = FD.NUMERO_DO
    LEFT OUTER JOIN IMPORTACIONES           IM   ON IM.NUMERO_DO = FD.NUMERO_DO
    LEFT OUTER JOIN ADMINISTRACIONES        A    ON IM.CODIGO_ADMINISTRACION = A.CODIGO_ADMINISTRACION
    LEFT OUTER JOIN CABEZA_FACTURAS         CF   ON CF.ID_CABEZA_FACTURA = FD.ID_CABEZA_FACTURA
    LEFT OUTER JOIN EXPORTADORES            EX   ON EX.ID_EXPORTADOR = CF.ID_EXPORTADOR
    LEFT OUTER JOIN IMPORTADORES            I    ON ED.ID_IMPORTADOR = I.ID_IMPORTADOR
    LEFT OUTER JOIN EMPLEADOS               EM   ON EM.ID_EMPLEADO = FD.ID_DECLARANTE
    LEFT OUTER JOIN SEGMENTOS_CLIENTES      SC   ON ED.ID_SEGMENTO_CLIENTE = SC.ID_SEGMENTO_CLIENTE
    LEFT OUTER JOIN DOCUMENTOS_TRASPORTE    DT   ON FD.NUMERO_DO = DT.NUMERO_DO
    LEFT OUTER JOIN TRASPORTADORES          T    ON T.CODIGO_TRANSPORTADOR=DT.CODIGO_TRANSPORTADOR
    LEFT OUTER JOIN TIPOS_DECLARACION       TD   ON  FD.CODIGO_TIPO_DECLARACION= TD.CODIGO_TIPO_DECLARACION
    LEFT OUTER JOIN POSICION_ARANCELARIA    PA   ON PA.CODIGO_POSICION= FD.CODIGO_POSICION
    LEFT OUTER JOIN LUGARES_INGRESO         LI   ON LI.CODIGO_LUGAR_INGRESO=IM.CODIGO_LUGAR_INGRESO

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

            //LECTURA QUERY
            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;
                for($j=0; $j<$nf; $j++) {
                    $fila .= "<td>".utf8_encode($reg[$j])."</td>";
                    switch ($j) {
                        case 2:  $txt .= esp($reg[$j],3)." ";  break;
                        case 5:  $txt .= esp($reg[$j],33)." ";  break;
                        default: $txt .= $reg[$j]." "; break;
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
                        th { background-color: #575656; color: white;  }
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
