<?php
    //include_once("../config/funciones.php");
    //conectaremoto();
    header('Access-Control-Allow-Origin: *');

    $servidor  = "ib.hubemar.com:3309";
    $basedatos = "hubemar";
    $usuario   = "hubemar18";
    $clave     = "Hube2018Mar.";

    @mysql_set_charset('utf8');

    $conn = mysql_connect($servidor, $usuario, $clave);
    mysql_select_db($basedatos) or die("Error de conexion Remota '$servidor'"); 

    function JSONObject($consulta="") {
        $res = mysql_query($consulta);       
        $respuesta =  mysql_num_rows($res);
        $campo = [];

        $nf = mysql_num_fields($res);
        for($j=0; $j<$nf; $j++) {
            $campo[$j] = mysql_field_name($res, $j);
        }

        $json = "{\"datos\":[";
        $contador = 0;
        while($reg = @mysql_fetch_array($res)) {
            $c = mysql_num_fields($res);
            $json .= "{";
            for($c=0; $c < count($reg)/2; $c++) {
                $json .= "\"".$campo[$c]."\":\"".trim($reg[$c])."\"";
                if(!($c==count($reg)/2-1)) $json .=",";
            }
            //if($reg) $json .= "\"vacio\":\"\"}";
            $json .= "}";
            $contador++;
            if($contador != $respuesta) $json .=",";
        }
        $json .= "],\"success\":\"1\",\"message\":\"success\"}";
       
        if($respuesta==0)
                return "{\"datos\":[],\"success\":\"0\",\"message\":\"success\"}";
            else
                return utf8_encode($json);          
    }

    function CSV($consulta="") {
        $res = mysql_query($consulta);
        $tmp = "";
        while($reg = @mysql_fetch_array($res)) {
            for($c=0; $c < count($reg)/2; $c++) {
                $tmp .= "$reg[$c]|";
            }
        }
        return utf8_encode($tmp);          
    }

    function Tabla($consulta="") {
        $res = mysql_query($consulta);
        $tmp = "";
        $fila = 0;
        while($reg = @mysql_fetch_array($res)) {
            $fila++;
            $tmp .= "<tr>";
            $tmp .= "<td>$fila</td>";
            $ancho = "";
            for($c=0; $c < count($reg)/2; $c++) {
                /*
                if($c==0) $ancho = " style='width:120px;' ";
                if($c==1) $ancho = " style='width:260px;' ";
                if($c==2) $ancho = " style='width:180px;' ";
                if($c==3) $ancho = " style='width:170px;' ";
                */
                if($c==0) 
                        $tmp .= "<td><button style='height: 24px' class='btn btn-sm' onclick='verDO(\"$reg[$c]\",\"".$reg[3]."\")'>$reg[$c]</button></td>";
                    else
                        $tmp .= "<td $ancho >".substr($reg[$c],0,50)."</td>";
            }
            $tmp .= "</tr>";
        }
        return utf8_encode($tmp);          
    }

    $tipo = $_POST['tipo'];
    $formato = $_POST['formato'];

    if($tipo==3) {
        $numdo = $_POST['numdo'];
        $sql = "SELECT TIPO_REGIMEN FROM ESTADOS_DO WHERE NUMERO_DO='$numdo'";
        $res = mysql_query($sql);
        $tmp = "";
        if($reg = @mysql_fetch_array($res)) {
            $tmp = $reg[0];
        }
        echo  "{\"datos\":[\"regimen\",\"$tmp\"],\"success\":\"1\",\"message\":\"success\"}";
    }


    if($tipo==1) { // Mostrar Ambiente Web

        // Lectura de parametros pasados por referencia
        $regimen    = $_POST['regimen'];
        $numdo      = $_POST['numdo'];
        $pedido     = $_POST['pedido'];
        $importador = $_POST['importador'];

        // Filtro para condicionar listado por DOS no anulados
        $condicion= " WHERE ANULADO='N' ";

        // Si no se selecciona un estado de DO se filtran todos Abiertos o Cerrados
        if(!isset($_POST['estado'])) { 
            $estado = "TODOS"; 
        } else    { 

            $estado = $_POST['estado'];

            // Validamos el importador Seleccionado
            if($importador!="0") {
                $condicion .= " AND ID_IMPORTADOR='$importador' ";
            }    
            
            // Validados el estado Seleccionado       
            if($estado!="TODOS") {
                $condicion .= " AND ED.CERRADO_OPERATIVAMENTE='$estado'";
            }
        }

        // Validamos que el Numero de Do y Numero de Pedido esten vacios
        if($numdo=="" && $pedido=="") {

            // Validamos el tipo de regimen Seleccionado 
            if($regimen!="TODOS") { 
               $condicion .= " AND TIPO_REGIMEN='$regimen' ";
            }


            // Validamos el rango de fechas ingresado
            $inicial   = $_POST['inicial'];
            $final     = $_POST['final'];
            if($inicial != "") {
                $inicial = "$inicial 00:00:00";
                $final   = "$final 23:59:59";
                $condicion .= " AND (FECHA_APERTURA BETWEEN '$inicial' AND '$final')";
            }

        }  else {
            
            // Validamos el Do ingresado
            if($numdo !="")  {
                $condicion = " WHERE NUMERO_DO='$numdo' " ;
            }

            // Validamos el Pedido Ingresado, como un numero de pedido puede estar en varios DOS y en cualquier posicion del
            // Campo, hacemos la busqueda por LIKE
            if($pedido!="") {
               $condicion = " WHERE NUMERO_PEDIDO LIKE '" . "%" . $pedido . "%'" ;
            }
        }

        $sql = "SELECT NUMERO_DO, NUMERO_PEDIDO, DATE_FORMAT(FECHA_APERTURA,  '%d/%m/%Y') FECHA_APERTURA,
                       CASE TIPO_REGIMEN WHEN 'I' THEN 'IMPORTACION' WHEN 'E' THEN 'EXPORTACION'
                                         WHEN 'T' THEN 'T.ADUANERO' ELSE 'OTROS' END AS REGIMEN
                FROM ESTADOS_DO ED
                $condicion ORDER BY ED.FECHA_APERTURA DESC "; 

        if ($formato=="JSON")  echo JSONObject($sql); 
        if ($formato=="CSV")   echo CSV($sql);
        if ($formato=="TABLA") echo Tabla($sql);

        
    }


    if($tipo==2) { 

        $numdo   = $_POST['numdo'];
       // $pedido = $_POST['pedido'];

        $texto   = "";

        $sqlx = "SELECT CASE TIPO_REGIMEN WHEN 'I' THEN 'IMPORTACION' WHEN 'E' THEN 'EXPORTACION'
                                         WHEN 'T' THEN 'T.ADUANERO' ELSE 'OTROS' END AS REGIMEN FROM ESTADOS_DO WHERE NUMERO_DO='$numdo'";
        $resx = mysql_query($sqlx);
        $tmp = "";
        if($regx = @mysql_fetch_array($resx)) {
            $regimen = $regx[0];
        }

        // ------------------------   DETALLE - EXPORTACION    -----------------------------------------
        if($regimen=="EXPORTACION" || $regimen=="E") { 
            $sql = "SELECT  ED.NUMERO_DO, 
                            UCASE(ED.NUMERO_PEDIDO) NRO_PEDIDO, 
                            I.NOMBRE_IMPORTADOR, 
                            DT.CODIGO_CONDICION_ENTREGA, 
                            CF.NUMERO_FACTURA, 
                            CF.FECHA_FACTURA, 
                            EX.NOMBRE_EXPORTADOR, 
                            CF.TOTAL_FACTURA, 
                            CF.FLETE_US, 
                            CF.SEGURO_US, 
                            DT.NUMERO_DOCUMENTO_TRANSPORTE,
                            DT.FECHA_DOCUMENTO_TRANSPORTE, 
                            E.FECHA_DEX , 
                            GROUP_CONCAT(SAU.NUMERO_DEX) NUMERO_DEX,
                            GROUP_CONCAT(SAU.ID_DOCUMENTO_MUISCA) SAE, 
                            GROUP_CONCAT(E.FECHA_ZARPE) FZARPE, 
                            VM.FECHA_ETA FECHA_ESTIMA_ARRIBO,
                            UC.CONTENEDORES, 
                            LEFT(TRIM(ED.DESCRIPCION), 250 )  PRODUCTO, 
                            VM.NOMBRE_VAPOR MOTONAVE, 
                            DATEDIFF(MD.FECHA_RTAD, VM.FECHA_ETS )+1 TIEMPO_TRANSITO,
                            UPPER( LI.NOMBRE_LUGAR_EMBAR_ARRIB_INAL) PUERTO_DESTINO, 
                            ED.NUMERO_FACTURA, ED.FECHA_FACTURA
                    FROM ESTADOS_DO ED 
                    LEFT OUTER JOIN EXPORTACIONES                  E   ON ED.NUMERO_DO=E.NUMERO_DO 
                    LEFT OUTER JOIN IMPORTADORES                   I   ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR 
                    LEFT OUTER JOIN EX_SOLICITUDES_AUT_EMBARQUES   SAU ON SAU.NUMERO_DO=ED.NUMERO_DO 
                    LEFT OUTER JOIN documentos_transportes_expos   DT  ON DT.NUMERO_DO=ED.NUMERO_DO 
                    LEFT OUTER JOIN facturas_exportaciones         CF  ON CF.NUMERO_DO=ED.NUMERO_DO 
                    LEFT OUTER JOIN EXPORTADORES                   EX  ON EX.ID_EXPORTADOR=DT.ID_EXPORTADOR 
                    LEFT OUTER JOIN VIAJES_MOTONAVES               VM  ON VM.ID_VIAJE_MOTONAVE=DT.ID_VIAJE_MOTONAVE
                    LEFT OUTER JOIN motonaves_destinos             MD  ON MD.ID_VIAJE_MOTONAVE = VM.ID_VIAJE_MOTONAVE AND MD.CODIGO_LUGAR_EMBAR_ARRIB_INAL = DT.CODIGO_LUGAR_EMBAR_ARRIB_INAL 
                    LEFT OUTER JOIN ex_lugares_embar_arrib_Inales LI ON LI.CODIGO_LUGAR_EMBAR_ARRIB_INAL=MD.CODIGO_LUGAR_EMBAR_ARRIB_INAL
                    LEFT  OUTER JOIN (SELECT NUMERO_DO, COUNT(NUMERO_ID_CONTENEDOR) CONTENEDORES FROM unidades_carga GROUP BY 1 ) UC ON UC.NUMERO_DO=ED.NUMERO_DO
                    WHERE ED.NUMERO_DO='$numdo' ";

            if($formato=="VISTA") {
                $res = mysql_query($sql);
                $texto = "<table class='table table-condensed'>";
                if($reg = @mysql_fetch_array($res)) {
                    $texto .= "<tr><th></th><th>Descripción Detallada</th></tr>";
                    $texto .= "<tr><th>Numero DO</th><td>$reg[0]</td></tr>";
                    $texto .= "<tr><th>Regimen</th><td>$regimen</td></tr>";

                    $texto .= "<tr><th>Pedido</th><td>$reg[1]</td></tr>";
                    $texto .= "<tr><th>Producto</th><td>$reg[18]</td></tr>";    
                    $texto .= "<tr><th>Contenedores</th><td>$reg[17]</td></tr>";  
                    $texto .= "<tr><th>Exportador</th><td>$reg[2]</td></tr>";
                    $texto .= "<tr><th>Condición Entrega</th><td>$reg[3]</td></tr>";
                    $texto .= "<tr><th>Factura</th><td>$reg[4]</td></tr>";
                    $texto .= "<tr><th>Fecha Factura</th><td>$reg[5]</td></tr>";
                    $texto .= "<tr><th>Importador</th><td>$reg[6]</td></tr>";
                    $texto .= "<tr><th>Total Factura</th><td>$reg[7]</td></tr>";
                    $texto .= "<tr><th>Flete</th><td>$reg[8]</td></tr>";
                    $texto .= "<tr><th>Seguro US</th><td>$reg[9]</td></tr>";
                    $texto .= "<tr><th>Doc. Transporte</th><td>$reg[10]</td></tr>";
                    $texto .= "<tr><th>SAE</th><td>$reg[11]</td></tr>";
                    $texto .= "<tr><th>Zarpe</th><td>$reg[12]</td></tr>";
                    /* Adiciones al codigo*/  
                    $texto .= "<tr><th>Motonave</th><td>$reg[19]</td></tr>";
                    $texto .= "<tr><th>Fecha Est. Arribo</th><td>$reg[16]</td></tr>";
                    
                    $texto .= "<tr><th>Destino</th><td>$reg[21]</td></tr>";
                    $texto .= "<tr><th>Tiempo Transito</th><td>$reg[20]</td></tr>";
           

                }
                $texto .= "</table>";
            }
            if($formato=="JSON") {
                $texto = JSONObject($sql);
            }
        }


        // ------------------------   DETALLE - IMPORTACION    -----------------------------------------
        if($regimen=="IMPORTACION" || $regimen=="I") { 
            $sql = "SELECT  ED.NUMERO_DO, 
                            ED.NUMERO_PEDIDO, 
                            DATE_FORMAT(ED.FECHA_APERTURA,'%d/%m/%Y') FECHA_APERTURA, 
                            I.NOMBRE_IMPORTADOR CLIENTE,
                            IM.SELECTIVIDAD, 
                            A.NOMBRE_SUCURSAL SUCURSAL,  
                            ETD.NOMBRE_ETAPA ETAPA,
                            IM.FECHA_LLEGADA_MCIA FECHA_LLEGADA_MERCANCIA, 
                            IM.FECHA_DOCUMENTOS_OK_CLIENTE FECHA_DOC_OK_CLIENTE,
                            IM.FECHA_MANIFIESTO FECHA_MANIFIESTO, 
                            IM.FECHA_LEVANTE,  
                            IM.FECHA_DOCS_TRANSPORTADOR, 
                            IM.FECHA_RETIRO_TOTAL,
                            ED.NUMERO_FACTURA
                    FROM ESTADOS_DO ED
                    LEFT OUTER JOIN IMPORTACIONES IM ON IM.NUMERO_DO=ED.NUMERO_DO
                    LEFT OUTER JOIN IMPORTADORES  I ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR
                    LEFT OUTER JOIN SUCURSALES    A ON A.CODIGO_SUCURSAL=ED.CODIGO_SUCURSAL_CO
                    LEFT OUTER JOIN ETAPAS_DO     ETD     ON ETD.ID_ETAPA_DO=ED.ID_ETAPA_DO
                    WHERE ED.NUMERO_DO='$numdo'";
            if($formato=="VISTA") {
                $res = mysql_query($sql);
                $texto = "<table class='table table-condensed'>";
                if($reg = @mysql_fetch_array($res)) {
                    $texto .= "<tr><th></th><th>Descripcion Detallada</th></tr>";
                    $texto .= "<tr><th>Regimen</th><td>$regimen</td></tr>";
                    $texto .= "<tr><th>Numero DO</th><td>         $reg[0]</td></tr>";
                    $texto .= "<tr><th>Pedido</th><td>            $reg[1]</td></tr>";
                    $texto .= "<tr><th>Apertura</th><td>          $reg[2]</td></tr>";
                    $texto .= "<tr><th>Cliente</th><td>           $reg[3]</td></tr>";
                    $texto .= "<tr><th>Selectividad</th><td>      $reg[4]</td></tr>";
                    $texto .= "<tr><th>Sucursal</th><td>          $reg[5]</td></tr>";
                    $texto .= "<tr><th>Etapa</th><td>             $reg[6]</td></tr>";
                    $texto .= "<tr><th>Llegada Mercancia</th><td> $reg[7]</td></tr>";
                    $texto .= "<tr><th>Doc. OK cliente</th><td>   $reg[8]</td></tr>";
                    $texto .= "<tr><th>Manifiesto</th><td>        $reg[9]</td></tr>";
                    $texto .= "<tr><th>Levante</th><td>           $reg[10]</td></tr>";
                    $texto .= "<tr><th>Doc. Transportador</th><td>$reg[11]</td></tr>";
                    $texto .= "<tr><th>Retiro Total</th><td>      $reg[12]</td></tr>";
                    $texto .= "<tr><th>Factura</th><td>           $reg[13]</td></tr>";
                }
                $texto .= "</table>";
            }
            if($formato=="JSON") {
                $texto = JSONObject($sql);
            }
        }


        // ------------------------   DETALLE - TRANSITO    -----------------------------------------
        if($regimen=="T.ADUANERO" || $regimen=="T") { 
            $sql = "SELECT  ED.NUMERO_DO, 
                            S.NOMBRE_SUCURSAL,  
                            DT.FECHA_DOC_DIAN, 
                            DT.FECHA_BUQUE, 
                            DT.FECHA_MCIA_PTO, 
                            DT.FECHA_RETIRO, 
                            DF.NUMERO_MANIFIESTO_CARGA, 
                            DF.FECHA_MANIFIESTO_CARGO, 
                            DF.NUMERO_DOCUMENTO_TRANSPORTE, 
                            DF.FECHA_DOCUMENTO_TRANSPORTE,  
                            DF.VALOR_FOB_MERCANCIA 
                    FROM ESTADOS_DO ED 
                    LEFT OUTER JOIN IMPORTADORES           I  ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR 
                    LEFT OUTER JOIN SUCURSALES             S  ON S.CODIGO_SUCURSAL=ED.CODIGO_SUCURSAL_OP 
                    LEFT OUTER JOIN DTAS       DT ON DT.NUMERO_DO=ED.NUMERO_DO 
                    LEFT OUTER JOIN dtas_forms DF ON DF.NUMERO_DO=ED.NUMERO_DO 
                    LEFT OUTER JOIN EMPLEADOS  E  ON ED.ID_EMPLEADO_OP=E.ID_EMPLEADO 
                    wHERE ED.NUMERO_DO='$numdo'";

            if($formato=="VISTA") {
                $res = mysql_query($sql);
                $texto = "<table class='table table-condensed'>";
                if($reg = @mysql_fetch_array($res)) {
                    $texto .= "<tr><th></th><th>Descripcion Detallada</th></tr>";
                    $texto .= "<tr><th>Regimen</th><td>$regimen</td></tr>";
                    $texto .= "<tr><th>Numero DO</th><td>              $reg[0]</td></tr>";
                    $texto .= "<tr><th>Sucursal</th><td>               $reg[1]</td></tr>";
                    $texto .= "<tr><th>Feca Doc. DIAN</th><td>         $reg[2]</td></tr>";
                    $texto .= "<tr><th>Fecha Buque</th><td>            $reg[3]</td></tr>";
                    $texto .= "<tr><th>Mercancia Pto</th><td>          $reg[4]</td></tr>";
                    $texto .= "<tr><th>Retiro</th><td>                 $reg[5]</td></tr>";
                    $texto .= "<tr><th>Manifiesto No.</th><td>         $reg[6]</td></tr>";
                    $texto .= "<tr><th>Fecha Manifiesto</th><td>       $reg[7]</td></tr>";
                    $texto .= "<tr><th>Doc. Transporte</th><td>        $reg[8]</td></tr>";
                    $texto .= "<tr><th>Fecha Doc. Tran.</th><td>       $reg[9]</td></tr>";
                    $texto .= "<tr><th>Valor Mercancia</th><td>        $reg[10]</td></tr>";
                }
                $texto .= "</table>";
            }
            if($formato=="JSON") {
                $texto = JSONObject($sql);
            }
        }

        // ------------------------   DETALLE - OTROS    -----------------------------------------
        if($regimen=="OTROS" || $regimen=="O") { 
            $sql = "SELECT  ED.NUMERO_DO, 
                            ED.NUMERO_PEDIDO, 
                            DATE_FORMAT(ED.FECHA_APERTURA,'%d/%m/%Y') FECHA_APERTURA, 
                            I.NOMBRE_IMPORTADOR CLIENTE,
                            CODIGO_SUCURSAL_OP SUCURSAL,  
                            ETD.NOMBRE_ETAPA ETAPA,
                            TRIM(UCASE(DESCRIPCION)) PRODUCTO, 
                            ED.NUMERO_FACTURA,
                            ED.FECHA_FACTURA 
                    FROM ESTADOS_DO ED
                    LEFT OUTER JOIN IMPORTADORES  I ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR
                    LEFT OUTER JOIN SUCURSALES    A ON A.CODIGO_SUCURSAL=ED.CODIGO_SUCURSAL_CO
                    LEFT OUTER JOIN ETAPAS_DO     ETD     ON ETD.ID_ETAPA_DO=ED.ID_ETAPA_DO
                    WHERE ED.NUMERO_DO='$numdo'";
            if($formato=="VISTA") {
                $res = mysql_query($sql);
                $texto = "<table class='table table-condensed'>";
                if($reg = @mysql_fetch_array($res)) {
                    $texto .= "<tr><th></th><th>Descripcion Detallada</th></tr>";
                    $texto .= "<tr><th>Regimen</th><td>$regimen</td></tr>";
                    $texto .= "<tr><th>Numero DO</th><td>         $reg[0]</td></tr>";
                    $texto .= "<tr><th>Pedido</th><td>            $reg[1]</td></tr>";
                    $texto .= "<tr><th>Apertura</th><td>          $reg[2]</td></tr>";
                    $texto .= "<tr><th>Cliente</th><td>           $reg[3]</td></tr>";
                    $texto .= "<tr><th>Sucursal</th><td>      $reg[4]</td></tr>";
                    $texto .= "<tr><th>Etapa Actual</th><td>          $reg[5]</td></tr>";
                    $texto .= "<tr><th>Producto</th><td>             $reg[6]</td></tr>";
                    $texto .= "<tr><th>Numero Factura</th><td> $reg[7]</td></tr>";
                    $texto .= "<tr><th>Fecha Factura</th><td>   $reg[8]</td></tr>";
                }
                $texto .= "</table>";
            }
            if($formato=="JSON") {
                $texto = JSONObject($sql);
            }
        }

        echo $texto;
    }
 

    if($tipo==99) { echo "prueba JSON"; }
 ?>