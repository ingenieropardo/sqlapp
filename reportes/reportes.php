<?php
	function QueryTributos() {
		
	}
	/*

    Vtsql = "SELECT  DATE_FORMAT(FD.FECHA_ACEPTACION, '%Y') ANIO, DATE_FORMAT(FD.FECHA_ACEPTACION, '%m'), FD.NUMERO_FORMULARIO_DI, FD.FECHA_ACEPTACION, ED.NUMERO_DO, ED.NUMERO_PEDIDO, ED.FECHA_APERTURA, SC.NOMBRE_SEGMENTO, I.NUMERO_IDENTIFICACION, I.NOMBRE_IMPORTADOR, A.NOMBRE_ADMINISTRACION, " _
    & " EM.NUMERO_IDENTIFICACION, EM.NOMBRE_PERSONA, CF.NUMERO_FACTURA FACTURA,CF.FECHA_FACTURA,CF.NUMERO_LISTA_EMPAQUE,  CF.CODIGO_CONDICION_ENTREGA, EX.NOMBRE_EXPORTADOR, FD.PESO_NETO, FD.PESO_BRUTO,FD.VALOR_TOTAL_FOB, FD.VALOR_ADUANA VALOR_CIF, ED.TRM,  " _
    & " DT.FECHA_DOC_TRANS,DT.NUMERO_DOC_TRANS, DT.FECHA_MANIFIESTO, DT.NUMERO_MANIFIESTO, " _
    & " FD.NUMERO_STICKER, FD.FECHA_PAGO, TD.NOMBRE_TIPO_DECLARACION DIM, FD.SELECTIVIDAD, FD.VALOR_TOTAL_FOB, FD.VALOR_FLETES, FD.VALOR_SEGUROS, FD.VALOR_OTROS_GASTOS, FD.AJUSTE_VALOR, FD.VALOR_ADUANA ," _
    & " FD.PORCENTAJE_ARANCEL, FD.BASE_ARANCEL, FD.TOTAL_ARANCEL, FD.PORCENTAJE_IVA, FD.BASE_IVA, FD.TOTAL_IVA, FD.TOTAL_LIQUIDADO, " _
    & " FD.NUMERO_LEVANTE, FD.FECHA_LEVANTE, IF(INSTR(FD.NUMERO_ACEPTACION,'M')=0,'SIGLO XXI','MANUAL') TRAMITE_REALIZADO_POR, I.CODIGO_UAP, " _
    
    Vtsql = Vtsql & " FD.NUMERO_ACEPTACION, FD.FORMULARIO_FISICO, FD.FECHA_ACEPTACION, IM.FECHA_RETIRO_TOTAL, FD.CODIGO_MODALIDAD, FD.CODIGO_POSICION, CP.CODIGO_UNIDAD_CCIAL_DIAN, FD.CANTIDAD, FD.BULTOS, FD.NUMERO_REG_LICENCIA, FD.PROGRAMA_AUTORIZADO, FD.CIP,  "
    Vtsql = Vtsql & " PA.NOMBRE_PAIS C46, PA1.NOMBRE_PAIS C47, FD.CODIGO_REG_LICENCIA C48, FD.NUMERO_REG_LICENCIA C49, FD.CODIGO_ACUERDO C50 , NULL DESCRIPCION, IM.CODIGO_DEPOSITO, T.NOMBRE_TRANSPORTADOR "
    
    Vtsql = Vtsql & " FROM FORMULARIOS_DIS FD  " _
     & " LEFT OUTER JOIN POSICION_ARANCELARIA CP ON CP.CODIGO_POSICION = FD.CODIGO_POSICION " _
    & " LEFT OUTER JOIN ESTADOS_DO ED ON ED.NUMERO_DO = FD.NUMERO_DO " _
    & " LEFT OUTER JOIN IMPORTACIONES IM ON IM.NUMERO_DO = FD.NUMERO_DO " _
    & " LEFT OUTER JOIN ADMINISTRACIONES A ON IM.CODIGO_ADMINISTRACION = A.CODIGO_ADMINISTRACION " _
    & " LEFT OUTER JOIN CABEZA_FACTURAS CF ON CF.ID_CABEZA_FACTURA = FD.ID_CABEZA_FACTURA " _
    & " LEFT OUTER JOIN EXPORTADORES EX ON EX.ID_EXPORTADOR = CF.ID_EXPORTADOR " _
    & " LEFT OUTER JOIN IMPORTADORES I ON ED.ID_IMPORTADOR = I.ID_IMPORTADOR " _
    & " LEFT OUTER JOIN EMPLEADOS EM ON EM.ID_EMPLEADO = FD.ID_DECLARANTE " _
    & " LEFT OUTER JOIN SEGMENTOS_CLIENTES SC ON ED.ID_SEGMENTO_CLIENTE = SC.ID_SEGMENTO_CLIENTE " _
    & " LEFT OUTER JOIN DOCUMENTOS_TRASPORTE    DT  ON FD.NUMERO_DO = DT.NUMERO_DO " _
    & " LEFT OUTER JOIN TRASPORTADORES         T  ON T.CODIGO_TRANSPORTADOR=DT.CODIGO_TRANSPORTADOR " _
    & " LEFT OUTER JOIN TIPOS_DECLARACION TD ON FD.CODIGO_TIPO_DECLARACION = TD.CODIGO_TIPO_DECLARACION " _
    & "LEFT OUTER JOIN PAISES                         PA  ON PA.CODIGO_PAIS             = EX.CODIGO_PAIS " _
    & "LEFT OUTER JOIN PAISES                         PA1 ON PA1.CODIGO_PAIS            = FD.CODIGO_PAIS_ORIGEN " _

       
    ' Aplicar Filtros de Fechas
    If Regimen <> "1" Then
        MsgBox "Regimen aduanero es invalido", vbCritical, "Error"
        Exit Sub
    End If
    If IsEmpty(FiltroDo) And IsEmpty(Pedido) And IsEmpty(Orden_compra) Then
        Filtros = Filtros & valida_fecha("ED.FECHA_APERTURA", 1) ' Fecha Apertura
        Filtros = Filtros & valida_fecha("FD.FECHA_LEVANTE", 2) ' Fecha Levante
        Filtros = Filtros & valida_fecha("FD.FECHA_ACEPTACION", 3) ' Fecha Aceptacion
        Filtros = Filtros & valida_fecha("IM.FECHA_LIBERACION", 4) ' Mcia en planta
        Filtros = Filtros & valida_fecha("IM.FECHA_RETIRO_TOTAL", 5) ' Retiro Total
        Filtros = Filtros & valida_fecha("FD.FECHA_PAGO", 6) ' Fecha de pago
        Filtros = Filtros & valida_fecha("ED.FECHA_FACTURA", 7) ' Fecha Factura
    End If
    
    Vtsql = Vtsql & Filtros & " ORDER BY ED.NUMERO_DO, FD.NUMERO_FORMULARIO_DI  "
    Hoja = "TRIBUTOS"
    Workbooks(FileMacro).Sheets(Hoja).Visible = True
    Workbooks(FileMacro).Sheets(Hoja).Copy
    Workbooks(FileMacro).Sheets(Hoja).Visible = False
    FileReport = ActiveWorkbook.Name
    
    Workbooks(FileReport).Activate
    Sheets(Hoja).Select
    
    Call SelectAndReturnRecordsADO(Vtsql, Hoja, False, 2)
    
    If NumeroRegistros < 1 Then
        MsgBox "La consulta no arrojo resultados", vbCritical, Empcia
        Exit Sub
    End If
    
    '------------------Resumen
    Workbooks(FileReport).Activate
    Sheets(Hoja).Select
    
    Rows("2:" & NumeroRegistros + 1).Select
    Selection.RowHeight = 15
    Range("a2").Select
	*/

?>