<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=kpiexcel.xls");
header("Pragma: no-cache");
header("Expires: 0");

    $sucursal     = $_GET['p_sucursal']; 
    $importador   = $_GET['p_importador']; 
    $ejecutivo    = $_GET['p_ejecutivo'];
    $reporte      = $_GET['p_reporte'];
    
    // Informacion Especifica
    $numerodo     = $_GET['p_numerodo'];
    $numeroped    = $_GET['p_numeroped']; 
    $ordencompra  = $_GET['p_ordencompra'];
    $numeroacep   = $_GET['p_numeroacep'];
    
    // Modalidad Aduanera
    $modalidad    = $_GET['p_modalidad'];
    
    // Filtros para informe
    
    $faperturai   = $_POST['p_faperturai'];
    $faperturaf   = $_POST['p_faperturaf'];
    $flevantei    = $_POST['p_flevantei'];
    $flevantef    = $_POST['p_flevantef'];
    $faceptai     = $_POST['p_faceptai'];
    $faceptaf     = $_POST['p_faceptaf'];
    $fmercanciai  = $_POST['p_fmercanciai'];
    $fmercanciaf  = $_POST['p_fmercanciaf'];
    $fretiroi     = $_POST['p_fretiroi'];
    $fretirof     = $_POST['p_fretirof'];
    $fstickeri    = $_POST['p_fstickeri'];
    $fstickerf    = $_POST['p_fstickerf'];
    $ffacturai    = $_POST['p_ffacturai'];
    $ffacturaf    = $_POST['p_ffacturaf']; 
    

echo "Sucursal: $sucursal / Cod. importador: $importador";
?>
<table border="1" cellpadding="2" cellspacing="0">
    <tr>
        <td bgcolor="#D0D0D0">Datos111</td>
        <td>dato</td>
        <td>Datos33</td>
    </tr>
    <tr>
        <td>Datos</td>
        <td>Datos</td>
        <td>Datos</td>
    </tr>
    <tr>
        <td>Datos</td>
        <td>Datos</td>
        <td>Datos</td>
    </tr>
</table>
<?php echo ""; ?>