<?php
	                   require('fpdf.php');
            class PDF extends FPDF {  
                var $parAsesor = "";    
                var $parEstado = "";
                var $parFdesde = "";
                var $parFhasta = "";

                function Header() {     
                    $this->SetFont('helvetica','',10);
                    $this->Image('../img/logo1.png',12,12,13);
                    //$this->Image('img/magua.png',70,50,100,100);
                    $this->Cell(15); $this->Cell(0,9,'HUBEMAR SAS',0,1,'');
                    $this->SetFont('helvetica','B',9);
                    $this->Cell(15); $this->Cell(0,0,'REPORTE DE TRIBUTOS POR DIM',0,1,'');
                    $this->SetFont('helvetica','',10);;
                    $this->Ln(0);
                }

                function Footer() {
                    $this->SetY(-12);
                    $this->SetFont('helvetica','',8);
                    $this->Cell(0,10,' Pagina '.$this->PageNo().' de {nb}'." - ",0,0,'C');
                }

                function LoadData()  {
                    $this->SetFont('helvetica','',10);
                    $this->Cell(1,1,'',0,1,'L');
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('helvetica','',8); 
                    $this->SetDrawColor(180,180,180);
                    $this->Cell(3); $this->Cell(1,5,"",0,1,'L');
                    $ancho= "6";
                    $this->Cell(3,$ancho,"",0,0,"C");
                    $this->SetFillColor(180,180,180); 
/*
                    $tmp = ""; 
                    $nr=0;
                    $res =  mysql_query($sql);
                    $fila = "<tr>";
                    $txt = "";
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

                    */                       
                    $this->Cell(18,$ancho,"Hora",1,0,"C",true);
                    $this->Cell(100,$ancho,"Cliente",1,0,"C",true);
                    $this->Cell(30,$ancho,"Asesor",1,0,"C",true);
                    $this->Cell(37,$ancho,"Realizada",1,0,"C",true);
                    $this->Cell(90,$ancho,"Contacto",1,0,"C",true); 
                    $this->Ln(); $this->Cell(3,$ancho,"",0,0,"C");


                    // Campos
                    $this->Cell(18,$ancho,"Dato",1,0,'L');
                    $this->Cell(100,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(30,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(37,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(90,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Ln(); $this->Cell(3,$ancho,"",0,0,"C");
                    $this->Cell(18,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(100,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(30,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(37,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(90,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Ln(); $this->Cell(3,$ancho,"",0,0,"C");
                    $this->Cell(18,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(100,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(30,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(37,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Cell(90,$ancho,"Dato",'LR',0,'L',false);;
                    $this->Ln();

                    $this->AddPage();
            

                    }


                function acabado($t)    { 
                    $tmp = "";
                     if($t==1) $tmp  = "PLASTIFICADO BTE"; 
                     if($t==2) $tmp  = "PLASTIFICADO MATE"; 
                     if($t==3) $tmp  = "PLAST.MATE + UVP"; 
                     if($t==4) $tmp  = "UV TOTAL"; 
                     return $tmp; 
                }

            }
            

            $pdf = new PDF('L', 'mm', array(1000,150));
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $info = $pdf->LoadData();        
            $pdf->Output();  
?>