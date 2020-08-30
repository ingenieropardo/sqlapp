<?php
	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=UAPconsolidadoResumen.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
	include("../config/funciones.php");
	conectalocal();
	$tipo = $_GET['tipo'];
	if($tipo=="xls") {

	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
        $titulo = "CONSOLIDADO UAP - RESUMEN POR MES";
  
        //echo $titulo;

		require_once '../excel/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('../archivos/xconsolidadouap.xls');

		error_reporting(E_ALL ^ E_NOTICE);
		for($p=1; $p<=12; $p++) {
			$tA[$p]=0; $tI[$p]=0;
		}
		
		// style='background: #AAD9F7'";

		$totA = 0; $totI = 0;

		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			if($data->sheets[0]['cells'][$i][1]=="Enero")      { $tA[1]  += $data->sheets[0]['cells'][$i][6]; $tI[1]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Febrero")    { $tA[2]  += $data->sheets[0]['cells'][$i][6]; $tI[2]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Marzo")      { $tA[3]  += $data->sheets[0]['cells'][$i][6]; $tI[3]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Abril")      { $tA[4]  += $data->sheets[0]['cells'][$i][6]; $tI[4]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Mayo")       { $tA[5]  += $data->sheets[0]['cells'][$i][6]; $tI[5]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Junio")      { $tA[6]  += $data->sheets[0]['cells'][$i][6]; $tI[6]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Julio")      { $tA[7]  += $data->sheets[0]['cells'][$i][6]; $tI[7]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Agosto")     { $tA[8]  += $data->sheets[0]['cells'][$i][6]; $tI[8]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Septiembre") { $tA[9]  += $data->sheets[0]['cells'][$i][6]; $tI[9]  += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Octubre")    { $tA[10] += $data->sheets[0]['cells'][$i][6]; $tI[10] += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Noviembre")  { $tA[11] += $data->sheets[0]['cells'][$i][6]; $tI[11] += $data->sheets[0]['cells'][$i][7]; }
			if($data->sheets[0]['cells'][$i][1]=="Diciembre")  { $tA[12] += $data->sheets[0]['cells'][$i][6]; $tI[12] += $data->sheets[0]['cells'][$i][7]; }

			$totA += $data->sheets[0]['cells'][$i][6];
			$totI += $data->sheets[0]['cells'][$i][7];
		}
		
		$tabla = "<table border=1>
					<tr><td colspan=3 style='background: #AAD9F7'>$titulo</td></tr>
					<tr><th>MES</th><th>TOTAL ARANCEL</th><th>TOTAL IVA</th></tr>
					<tr><th>Enero</th>      <td style='text-align: right'>".number_format($tA[1],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[1],0,',','.')."</td></tr>
					<tr><th>Febrero</th>    <td style='text-align: right'>".number_format($tA[2],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[2],0,',','.')."</td></tr>
					<tr><th>Marzo</th>      <td style='text-align: right'>".number_format($tA[3],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[3],0,',','.')."</td></tr>
					<tr><th>Abril</th>      <td style='text-align: right'>".number_format($tA[4],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[4],0,',','.')."</td></tr>
					<tr><th>Mayo</th>       <td style='text-align: right'>".number_format($tA[5],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[5],0,',','.')."</td></tr>
					<tr><th>Junio</th>      <td style='text-align: right'>".number_format($tA[6],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[6],0,',','.')."</td></tr>
					<tr><th>Julio</th>      <td style='text-align: right'>".number_format($tA[7],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[7],0,',','.')."</td></tr>
					<tr><th>Agostobrero</th><td style='text-align: right'>".number_format($tA[8],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[8],0,',','.')."</td></tr>
					<tr><th>Septiembre</th> <td style='text-align: right'>".number_format($tA[9],0,',','.'). "</td><td style='text-align: right'>".number_format($tA[9],0,',','.')."</td></tr>
					<tr><th>Octubre</th>    <td style='text-align: right'>".number_format($tA[10],0,',','.')."</td><td style='text-align: right'>".number_format($tA[10],0,',','.')."</td></tr>
					<tr><th>Noviembre</th>  <td style='text-align: right'>".number_format($tA[11],0,',','.')."</td><td style='text-align: right'>".number_format($tA[11],0,',','.')."</td></tr>
					<tr><th>Diciembre</th>  <td style='text-align: right'>".number_format($tA[12],0,',','.')."</td><td style='text-align: right'>".number_format($tA[12],0,',','.')."</td></tr>
					<tr><th>TOTAL</th>      <td style='text-align: right'>".number_format($totA,0,',','.') . "</td><td style='text-align: right'>".number_format($totI,0,',','.')."</td></tr>
				  </table>
				";

		echo $tabla;
	}
?>