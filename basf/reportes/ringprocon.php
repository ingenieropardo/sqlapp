<style>
	.de { text-align: right; }
</style>
<?php

	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=ingpropiosConsolidado.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    

	include("../config/funciones.php");
	conectalocal();
	$tipo = $_GET['tipo'];
	$valor = $_GET['valor'];
	if($tipo=="xls") {
        $titulo = "INGRESOS PROPIOS - CONSOLIDADO POR MES";
		$sql = $sql = "SELECT * FROM ingpropios";
		$res = mysql_query($sql);
	    $tmp = "";
	    $fila = "";
	    $i=0;
        $nr = mysql_num_rows($res);
        $nf = mysql_num_fields($res);   
        echo $titulo;
		$tEne = 0; $tFeb = 0; $tMar = 0; $tMay = 0; $tAbr = 0; $tMay=0; $tJun=0; $tJul=0; $tAgo=0; $tSep=0; $tOct=0; $tNov=0; $tDic=0;

		require_once '../excel/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('../archivos/comision.xls');

		error_reporting(E_ALL ^ E_NOTICE);
		$tmp = "";

		$cont = 0; $nfilas=0;
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			$mes =  $data->sheets[0]['cells'][$i][2];
			$credito = (int)($data->sheets[0]['cells'][$i][5]);
			if($mes=="Enero")      $tEne += $credito;
			if($mes=="Febrero")    $tFeb += $credito;
			if($mes=="Marzo")      $tMar += $credito;
			if($mes=="Abril")      $tAbr += $credito;
			if($mes=="Mayo")       $tMay += $credito;
			if($mes=="Junio")      $tJun += $credito;
			if($mes=="Julio")      $tJul += $credito;
			if($mes=="Agosto")     $tAgo += $credito;
			if($mes=="Septiembre") $tSep += $credito;
			if($mes=="Octubre")    $tOct += $credito;
			if($mes=="Noviembre")  $tNov += $credito;
			if($mes=="Diciembre")  $tDic += $credito;
		}
/*
		while($reg = @mysql_fetch_array($res)) {
			if($reg[2]=="Enero")       $tEne += (int)($reg[5]);
			if($reg[2]=="Febrero")     $tFeb += (int)($reg[5]);
			if($reg[2]=="Marzo")       $tMar += (int)($reg[5]);
			if($reg[2]=="Abril")       $tAbr += (int)($reg[5]);
			if($reg[2]=="Mayo")        $tMay += (int)($reg[5]);
			if($reg[2]=="Junio")       $tJun += (int)($reg[5]);
			if($reg[2]=="Julio")       $tJul += (int)($reg[5]);
			if($reg[2]=="Agosto")      $tAgo += (int)($reg[5]);
			if($reg[2]=="Septiembre")  $tSep += (int)($reg[5]);
			if($reg[2]=="Octubre")     $tOct += (int)($reg[5]);
			if($reg[2]=="Noviembre")   $tNov += (int)($reg[5]);
			if($reg[2]=="Diciembre")   $tDic += (int)($reg[5]);
		}	
		*/	
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
	    $tabla .= "<tr><th>MES</th><th>SUMA DE CREDITOS</th><td>Valor: ".number_format($valor)."</td></tr>";
	    $tabla .= "<tr><td>Enero</td><td class='de'>".number_format($tEne)."     </td><td>".number_format($tEne/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Febrero</td><td class='de'>".number_format($tFeb)."   </td><td>".number_format($tFeb/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Marzo</td><td class='de'>".number_format($tMar)."     </td><td>".number_format($tMar/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Abril</td><td class='de'>".number_format($tAbr)."     </td><td>".number_format($tAbr/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Mayo</td><td class='de'>".number_format($tMay)."      </td><td>".number_format($tMay/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Junio</td><td class='de'>".number_format($tJun)."     </td><td>".number_format($tJun/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Julio</td><td class='de'>".number_format($tJul)."     </td><td>".number_format($tJul/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Agosto</td><td class='de'>".number_format($tAgo)."    </td><td>".number_format($tAgo/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Septiembre</td><td class='de'>".number_format($tSep)."</td><td>".number_format($tSep/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Octubre</td><td class='de'>".number_format($tOct)."   </td><td>".number_format($tOct/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Noviembre</td><td class='de'>".number_format($tNov)." </td><td>".number_format($tNov/$valor)."</td></tr>";
	    $tabla .= "<tr><td>Diciembre</td><td class='de'>".number_format($tDic)." </td><td>".number_format($tDic/$valor)."</td></tr>";
	    $total = $tEne+$tFeb+$tMar+$tAbr+$tMay+$tJun+$tJul+$tAgo+$tSep+$tOct+$tNov+$tDic;
	    $tabla .= "<tr><td>TOTAL</td><td>".number_format($total)."</td></tr>";
	    $tabla .=  "</table>";
		echo $tabla;
	}
?>