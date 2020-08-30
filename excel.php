<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1" cellpadding="2" cellspacing="0" width="100%">
    <tr>
        <td>Datos111</td>
        <td>Datos22</td>
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
