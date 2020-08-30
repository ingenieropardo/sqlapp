<?php


$cel="573102334455";
$Fecha= date("Y-m-d H:i:s");
$mensaje="mensaje de prueba $Fecha  cel $cel . ";


$ch = curl_init();

                                // Url a la que hacemos la petición
                                $url = "http://sistemasmasivos.com/itcloud/api/sendsms/send.php";
                                //Realizamos la petición
                                curl_setopt($ch, CURLOPT_URL,$url);
                                // definimos el número de campos o parámetros que enviamos mediante POST
                                curl_setopt($ch, CURLOPT_POST, 1);
                                // definimos cada uno de los parámetros
                                curl_setopt($ch, CURLOPT_POSTFIELDS, "user=prueba@xxxxx.com&password=miclave&SMSText=$mensaje&GSM=$cel");

                                // recibimos la respuesta y la guardamos en una variable
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $respuesta = curl_exec ($ch);

                                // imprime respuesta
                                echo "$respuesta<p>";


                                // proceso para capturar codigo de enviocuando es exito
                                $ResultadoEnvio=      str_replace( ',', '',strstr($respuesta, ","));

                            // proceso para capturar codigo de envio cuando NO exito el envio
                                if (!$ResultadoEnvio){
                                  $ResultadoEnvio=  $respuesta;
                                 }

                                // imprime resultado
                                echo "ResultadoEnvio $ResultadoEnvio";



?>
