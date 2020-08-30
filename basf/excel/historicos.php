<?php
	include("../config/funciones.php");
	conectalocal();
	$condicion = "1";
    $anno = $_POST['anno'];
    $mes  = $_POST['mes'];
    $est  = $_POST['estado'];

    if($est != "T")    $condicion .= " AND estado='$estado' ";
    if($mes !="TODOS") $condicion .= " AND c3='$mes' ";

    $sql = "SELECT * FROM historicos WHERE $condicion AND c2='$anno'";
    $res = mysql_query($sql);
    $num = mysql_num_fields($res);
    $tmp = "";
    $fila = 0;
    while($reg = @mysql_fetch_array($res)) {
    	$tmp .= "<tr>";
    	if($fila == 0) 
	    	for($i = 0; $i < $num; $i++)
	    		$tmp .= "<th>$reg[$i]</th>";
    	else
	    	for($i = 0; $i < $num; $i++)
	    		$tmp .= "<td>$reg[$i]</td>";
	    $fila++;
    	$tmp .= "</tr>";
    }

	echo ($tmp);

/*
require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();
$anno = $_POST['anno'];
$data->setOutputEncoding('CP1251');
$data->read('../archivos/historicos/'.$anno.'.xls');

error_reporting(E_ALL ^ E_NOTICE);
$tmp = "";

$cont = 0;
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	$tmp .= "<tr>";
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		if($i==1) 
			$tmp .=  "<th style='width:100px'>".$data->sheets[0]['cells'][$i][$j]. "</th>";
		else
			$tmp .=  "<td>".$data->sheets[0]['cells'][$i][$j]. "</td>";
	}
	$tmp .= "</tr>";
}


*/

?>
