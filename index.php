<!DOCTYPE html>
<style>
    .buscar {
      border-radius: 15px;
      width: 35px;
      background: #E9CE4F;
    }
    .layo {
        padding: 5px;
        border-style: solid;
        border-width: 2px;
        border-color: white;
      }
      body {
        
      }
      @media (min-width: 101px) and (max-width: 600px)  {
        /*  Vista para Moviles */
        .contenedor {  margin-left: -8%; margin-top: -18px; width:  116%;  }  
        .logoresponsivo { width: 70%; }
        .rusuario { width: 80%; text-align: center; }
        .vistapc { display: none;  }
        .vistamv { display:  ;  }
        .inicial img { width: 100%; }
        #lista { height: 400px; width: 100%; }
      }
      @media (min-width: 601px) and (max-width: 2400px) {
         /* Vista para computadores y y Tabletas */
        .rusuario { width: 250px; font-size: 14px; text-align: center;}
        .logoresponsivo { width: 300px; }
        .vistapc { display: ;  }
        .vistamv { display: none;  }
        .contenedor {  margin-left: -15%; margin-top: -18px; width:  128%;  }
        #lista { height: 500px; width: 100%; }
      }
       @font-face {
          font-family: "Engravers";
          src: url("fonts/engravers.ttf");
      }
  .seccion { 
    padding: 10px;
    background-color: #E9F4F8;
    border-radius: 8px;
  }
    input[type=checkbox], input[type=radio]
    {   
      -ms-transform: scale(1.5); /* IE */
      -moz-transform: scale(1.5); /* FF */
      -webkit-transform: scale(1.5); /* Safari and Chrome */
      -o-transform: scale(1.5); /* Opera */
      margin-left: 15px;
      background: white;
    }
    input[type=checkbox]:disabled { background: grey; }
  .button.red {
      color: #fff;
      background-color: #ff3366;
      border-color: #ff3366;
  }
  .seccion {
    margin: -5px;
  }
  .button.red:hover {
    background-color: #EEABAB;
  }
  th{
    font-size: 16px;
    font-weight: normal;
    padding: 0px;
  }
  .refre { width: 40px; }
  .btn-inverse {
    background-color: #464646;
    color: white;
  }
  .btn-inverse:hover {
    background-color: #626262;
    color: white;
  }
  .btn-inverse:focus {
    color: white;

  }

  #d1 {
    width: 100%;
    height: 250px;
    overflow-y: scroll;
    margin: 0px;
    padding: 5px;
    
    border-radius: 4px;
  }  
  .c { background: #FFDBDB; text-align: center; font-weight: bold; width: 120px; 
       border-width: 2px; border-style: solid; border-color: white;}
  .c1 { background: #555555; text-align: center; font-weight: bold; width: 120px; 
       border-width: 2px; border-style: solid; border-color: white;}
  .c2 { background: #666666; text-align: center; border-width: 2px; border-style: solid; border-color: white; color: white;}
  .sb { border-width: 1px; border-style: solid; border-color: white; }
  #pp4 table tr td { border-width: 1px; border-style: solid; border-color: #888888; }
  .t0 { width: 70%;   }
  .t100 { width: 450px;  }
  .t1 { width: 250px; }
  .t2 { width: 200px; }
  .t3 { width: 100px; }
  .t30 { width: 90px; }
  .t31 { width: 30%; }
  .tt { width: 100%;  }
  .t4 { width: 140px; }
  .t5 { width: 350px; }
  .m0 { width: 50px;  }
  .m10 { width: 40px;  }
  .bp { width: 25px;  }
  .m5 { width: 65px; text-align: center; }
  .p1 { height: 30px; font-size: 9px;}
  .linea { padding: 0px; margin: 2px -15px; border-color: #B3B3B3}
  .linea2 { padding: 0px; margin: 2px 0px; border-color: #B3B3B3}
  .ttexto { height: 32px; padding: 0px; font-size: 13px; }
   input[type="date"],input[type="text"], textarea, select option {
     font-size: 13px;
  }
  textarea {
    font-size: 11pt;
  }
  .l2 { padding: 0px; margin: 0px; margin-top: 10px; }
  .fecha { width: 120px; }
  .estv { width: 25px; background: #789D6F; border-style: none; margin: 2px; height: 25px; border-radius: 12px;}
  .noshow { display: none; }

  table th { background: #7F7F7F; color: white; text-align: center;  }
        .overlay{
             display: none;
             position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: #000;
             z-index:1001;
             opacity:.75;
             -moz-opacity: 0.75;
             filter: alpha(opacity=75);
        }
        select {
            padding: 2px;
            height: 30px;
            border-radius: 3px;
            border-style: solid;
            border-width: 1px;
            border-color: #BDBDBD;
            margin: 3px;
            background: white;
        }
        textarea, input[type="text"], input[type="password"], input[type="date"], input[type="time"] {
            padding: 3px;
            border-radius: 3px;
            border-style: solid;
            border-width: 1px;
            border-color: #BDBDBD;
            margin: 3px;
            height: 28px;
            background: white;
        }
        input::placeholder { color: #CECECE; }
        .glyphicon {
          margin-right: 10px;
        }
        input:disabled, select:disabled, textarea:disabled { background: #D9D9D9; color:#3A3939; }
        .opcion { color: black; padding: 0px; background: #BFBFBF; margin-top: 18px; text-align: center;}  
        .alerta { 
          text-decoration: none; background: #DADADA;
          border-style: none; margin-left: 15px;
          padding: 5px 10px; margin-bottom: : 8px;
          border-radius: 8px; color: red;
        }
        .alerta:hover {
           text-decoration: none; background: #F0C9C9;
          border-style: none; margin-left: 15px;
          padding: 5px 10px; margin-bottom: 8px;
          border-radius: 8px; color: red;   
          cursor: pointer;      
        }
</style>
<script src="Chart.bundle.js"></script>
<script src="utils.js"></script>


<?php
  $invalido = "";
  @session_start();
  
  include_once("config/funciones.php");
  conectalocal();
  
  $contenidoModal = "";
  $error = "none";
  $menu  = "";
  $archivo = "";

  if(isset($_POST['conecta'])) {
      $usuario = $_POST['usuario'];
      $clave = md5($_POST['clave']);
      $sql = "select * from usuariosapp where usuario='$usuario' and clave='$clave' and estado='A'";

      $res = mysql_query($sql);
      if($reg = @mysql_fetch_array($res)) {

          $nomusuario =  "$reg[5]";
          $rol =  $reg[1];
          $archivo = "";
          $ideusu = $reg[0];
          $fe = fechaactual(0);
          $hr = fechaactual(1);
 
          $archivo = "vistas/fondo.php";
          $codigolog = rand(10000,99999);

          $sql2 = "UPDATE usuariosapp SET logueado='$codigolog' WHERE usuario='$usuario'";
          mysql_query($sql2);

          $_SESSION['codigolog'] = $codigolog;
          $_SESSION['rol']        = "$reg[1]";
          $_SESSION['nomusuario'] = "$reg[5]";
          $_SESSION['ideusuario'] = "$reg[0]";
          $_SESSION['idimportador']  = "$reg[6]";

      } else
         $invalido = "Error de credenciales<br>";
          $error = "";  
  } 
 
  

?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Hubemar ::. SQLApp 1.0</title>
        <meta name="description" content="Software de Consulta Hubemar App :. 2019">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="stylesheet" href="fonts/font-awesome.css">
        <link rel="stylesheet" href="fonts/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/demo.css">
        <link rel="stylesheet" href="css/pushy.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="icon" type="image/jpg" href="img/logo-hubemar.png" />         
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>        
    </head>

    <body style="font-family: Arial; " onload="setInterval("reload()",2000);">

        <header class="site-header push" style="background:   #004B83; padding: 5px; text-align: left; margin: 0px; margin-left: -20px; width: 110%;">
            &nbsp;&nbsp;&nbsp;
            <button class="menu-btn" style="background:   #004B83; padding: 0px; margin: 0px; font-size: 20px; width: 40px;">
              <span class="glyphicon glyphicon-th"></span> </button> 
                <font color="#E9CE4F" size="4">Hubemar</font>
                <font color="white">SQL</font>
                <font color="white" size="4">App </b><font color="#E9CE4F" size="2">1.0</font> 
                <font size="2" color="#F1EFCD" class="vistapc">
                    <?php  
                          if(isset($_SESSION['nomusuario']))
                            echo utf8_decode(strtoupper($_SESSION['rol']." ".$_SESSION['nomusuario'])); 
                    ?>
                </font>
                <font size="2" color="#F1EFCD" class="vistamv">
                    <?php  
                          if(isset($_SESSION['nomusuario']))
                            echo strtoupper($_SESSION['rol']." ".$_SESSION['ideusuario']); 
                    ?>
                </font>                
        </header><br>
            <div class="opcion" style="padding-top: 2px; margin-top: 14px; margin-left: -20px; margin-right: -20px; color: #EAF3F5; background-color: #5E8CAE">
              <?php 
              if(isset($_SESSION['nomusuario']))
                $usuario = $_SESSION['nomusuario']; else $usuario = "";
                if($usuario!="")
                  if(isset($_GET['accion'])) 
                      echo titulo($_GET['accion']);
              ?>
            </div>


        <nav class="pushy pushy-left" data-focus="#first-link" >
            <div class="pushy-content">
            <?php
                if(isset($_SESSION['rol'])) $rol = $_SESSION['rol']; else $rol =0;

                switch ($rol) {
                  case "0":  $menu = "vistas/menuexit.php";  break;

                  // Menu para usuarios Root
                  case "ROOT":  $menu = "vistas/menurol1.php";  break;

                  // Menu para Directivos
                  case "DIRECTIVO":  $menu = "vistas/menurol2.php";  break;

                  // Menu Operativo
                  case "OPERATIVO":  $menu = "vistas/menurol3.php";  break;

                  // Menu Clientes
                  case "CLIENTE":  $menu = "vistas/menurol4.php";  break;
                }

                if($menu != "") include ($menu); 
            ?>                 
            </div>
        </nav>

        <div id="container"  style="margin-top: -60px; margin-bottom: 0px">
            <div class='vistapc'>
                 
            </div>
            <div class='vistamv'>
                 
            </div>
            <?php 
              
              if(isset($_SESSION['nomusuario']))
                $usuario = $_SESSION['nomusuario']; 
              else $usuario = "";

              if(isset($_GET['accion'])) {
                $accion = $_GET['accion'];
                if($usuario=="") 
                  $accion="iniciarsesion";
                echo "&nbsp;";
                
                switch ($accion) {
                      case "iniciarsesion"      :  $archivo = "vistas/inicio.php";              break;
                      case "inventario"         :  $archivo = "vistas/inventario.php";          break;
                      case "informeskpi"        :  $archivo = "vistas/informeskpi.php";         break;
                      case "informesexpo"       :  $archivo = "vistas/informesexpo.php";        break;
                      case "informesdta"        :  $archivo = "vistas/informesdta.php";         break;
                      case "informesgenerales"  :  $archivo = "vistas/informesgenerales.php";   break;
                      case "procesorevision"    :  $archivo = "vistas/procesorevision.php";     break;
                      case "usuarios"           :  $archivo = "vistas/usuarios.php";            break;
                      case "noticias"           :  $archivo = "vistas/noticias.php";            break;
                      case "parametrosbasicos"  :  $archivo = "vistas/parametrosbasicos.php";   break;
                      case "cambiopwd"          :  $archivo = "vistas/clave.php";               break;
                      case "movil"              :  $archivo = "vistas/movil.php";               break;
                      case "soporte"            :  $archivo = "vistas/soporte.php";             break;
                      default                   :  $archivo = "vistas/invalida.php";            break;
                }
              
              } else {
                $archivo = "vistas/fondo.php";
              }
              if($archivo != "") include ($archivo);  
            ?>
        </div>
        <?php 
          if($invalido!="") {
            echo $invalido;
          }
        ?>
        <!--
        <footer class="site-footer push">
          www.simecomsas.co - Ingenieria y Soluciones TI - Derechos Reservados 2019 &reg;
        </footer>
        -->
        <script src="js/pushy.min.js"></script>
        <input type="date" value="<?php echo fechaactual(0); ?>" id="fechasistema" style="display: none">

    </body>
    <button style="display: none ;" type="button" id="btncerrars" class="btn btn-success bex" data-toggle="modal" data-target="#cerrars"><span style="font-size:36px;" class="glyphicon glyphicon-question-sign"></span><br>Ayuda</button>
    <input type="text" id="nomusu" style="display: none; color: black;" value="<?php if(isset($_SESSION['ideusuario'])) echo $_SESSION['ideusuario']; else echo '' ?>">
    <input type="text" id="logusu" style="display: none; color: black;" value="<?php if(isset($_SESSION['codigolog'])) echo $_SESSION['codigolog']; else echo '' ?>">
</html>


 <!-- ...................MODALES ...................................... -->
  <div class="modal fade" id="cerrars" role="dialog" style="margin-top: 100px;">
    <div class="modal-dialog">
      <div class="modal-content" style=" color: black">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Seguridad del Sistema</b></h4>
        </div>
        <div class="modal-body">
          <p style="text-align: center;">
          <span class="fa fa-exclamation-triangle fa-4x" style="color: #000000"></span><br>
              <br>
              <b>Sesion Cerrada</b><br>
              Inicie Sesion para reestablecer su <br>
              conexion
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- FIN VENTANAS MODALES -->

<script>
  if($("#nomusu").val()!="")
      var idIntervalo = setInterval(verificasesion,10000);
  //verificasesion();

  function sii() {
    //$("#btncerrars").click();
  }
  
  function verificasesion() { 
        $.ajax({
          type:"post",
          url: "ajax/idlogueado.php",
          data: {
            usactual: $("#nomusu").val(),
            idactual: $("#logusu").val()
          },
          success : function (data) {
            if(data.trim()=="Error") {
              $("#btncerrars").click();
              clearInterval(idIntervalo);
              location.href="cerrarsesion.php";
            }
          }
        })
    
  }

  document.addEventListener("deviceready", onDeviceReady, false);
  function onDeviceReady() {
      console.log(navigator.vibrate);
  }



  function notificaciones() {
    location.href="index.php";
  }
  
  function horaampm(hora) {
    hours = parseInt(hora.substr(0,2));
    minutos = hora.substr(2,3);

    ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; 
    strTime = hours + minutos + ' ' + ampm;

    return strTime;
  }


  function fechaactual() {
    var f = new Date();
    dia = f.getDate(); if(dia<10) dia = "0"+ dia;
    mes = (f.getMonth() +1); if(mes<10) mes = "0" + mes;
    return(f.getFullYear() + "-" + mes + "-" + dia);
  }

  function horaactual() {
    var f = new Date();
    hora = f.getHours();
    minu = f.getMinutes();
    segu = f.getSeconds();
    return (hora+":"+minu+":"+segu);
  }

  function number_format(amount, decimals=0) {
      amount += ''; 
      amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); 
      decimals = decimals || 0; 

      if (isNaN(amount) || amount === 0) 
          return parseFloat(0).toFixed(decimals);

      amount = '' + amount.toFixed(decimals);
      var amount_parts = amount.split('.'),
          regexp = /(\d+)(\d{3})/;

      while (regexp.test(amount_parts[0]))
          amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

      return amount_parts.join('.');
  }

   function enviamsg(emailpara, mess,asu, ale) {
    $.ajax({
        type:"post",
        url :"ajax/aviso.php",
        data: {
          para : emailpara,
          mensaje: mess,
          asunto: asu,
          alerta : ale
        },
        success : function(data) {
          alert(data);
          location.reload(true);
          navigator.vibrate(2000);
        }
    });
   }


</script>

<style>
  .alert {
  padding: 8px 35px 8px 14px;
  margin-bottom: 20px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
}

.alert,
.alert h4 {
  color: #c09853;
}

.alert h4 {
  margin: 0;
}

.alert .close {
  position: relative;
  top: -2px;
  right: -21px;
  line-height: 20px;
}

.alert-success {
  color: #468847;
  background-color: #dff0d8;
  border-color: #d6e9c6;
}

.alert-success h4 {
  color: #468847;
}

.alert-danger,
.alert-error {
  color: #b94a48;
  background-color: #f2dede;
  border-color: #eed3d7;
}

.alert-danger h4,
.alert-error h4 {
  color: #b94a48;
}

.alert-info {
  color: #3a87ad;
  background-color: #d9edf7;
  border-color: #bce8f1;
}

.alert-info h4 {
  color: #3a87ad;
}

.alert-block {
  padding-top: 14px;
  padding-bottom: 14px;
}

.alert-block > p,
.alert-block > ul {
  margin-bottom: 0;
}

.alert-block p + p {
  margin-top: 5px;
}
.thumbnails {
  margin-left: -20px;
  list-style: none;
  *zoom: 1;
}

.thumbnails:before,
.thumbnails:after {
  display: table;
  line-height: 0;
  content: "";
}

.thumbnails:after {
  clear: both;
}

.row-fluid .thumbnails {
  margin-left: 0;
}

.thumbnails > li {
  float: left;
  margin-bottom: 20px;
  margin-left: 20px;
}

.thumbnail {
  display: block;
  padding: 4px;
  line-height: 20px;
  border: 1px solid #ddd;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
     -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
          box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);
  -webkit-transition: all 0.2s ease-in-out;
     -moz-transition: all 0.2s ease-in-out;
       -o-transition: all 0.2s ease-in-out;
          transition: all 0.2s ease-in-out;
}

a.thumbnail:hover,
a.thumbnail:focus {
  border-color: #0088cc;
  -webkit-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);
     -moz-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);
          box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);
}

.thumbnail > img {
  display: block;
  max-width: 100%;
  margin-right: auto;
  margin-left: auto;
}

.thumbnail .caption {
  padding: 9px;
  color: #555555;
}
.tabbable {
  *zoom: 1;
}

.tabbable:before,
.tabbable:after {
  display: table;
  line-height: 0;
  content: "";
}

.tabbable:after {
  clear: both;
}

.tab-content {
  overflow: auto;
}

.tabs-below > .nav-tabs,
.tabs-right > .nav-tabs,
.tabs-left > .nav-tabs {
  border-bottom: 0;
}

.tab-content > .tab-pane,
.pill-content > .pill-pane {
  display: none;
}

.tab-content > .active,
.pill-content > .active {
  display: block;
}

.tabs-below > .nav-tabs {
  border-top: 1px solid #ddd;
}

.tabs-below > .nav-tabs > li {
  margin-top: -1px;
  margin-bottom: 0;
}

.tabs-below > .nav-tabs > li > a {
  -webkit-border-radius: 0 0 4px 4px;
     -moz-border-radius: 0 0 4px 4px;
          border-radius: 0 0 4px 4px;
}

.tabs-below > .nav-tabs > li > a:hover,
.tabs-below > .nav-tabs > li > a:focus {
  border-top-color: #ddd;
  border-bottom-color: transparent;
}

.tabs-below > .nav-tabs > .active > a,
.tabs-below > .nav-tabs > .active > a:hover,
.tabs-below > .nav-tabs > .active > a:focus {
  border-color: transparent #ddd #ddd #ddd;
}

.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li {
  float: none;
}

.tabs-left > .nav-tabs > li > a,
.tabs-right > .nav-tabs > li > a {
  min-width: 74px;
  margin-right: 0;
  margin-bottom: 3px;
}

.tabs-left > .nav-tabs {
  float: left;
  margin-right: 19px;
  border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
  margin-right: -1px;
  -webkit-border-radius: 4px 0 0 4px;
     -moz-border-radius: 4px 0 0 4px;
          border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
  border-color: #ddd transparent #ddd #ddd;
  *border-right-color: #ffffff;
}

.tabs-right > .nav-tabs {
  float: right;
  margin-left: 19px;
  border-left: 1px solid #ddd;
}

.tabs-right > .nav-tabs > li > a {
  margin-left: -1px;
  -webkit-border-radius: 0 4px 4px 0;
     -moz-border-radius: 0 4px 4px 0;
          border-radius: 0 4px 4px 0;
}

.tabs-right > .nav-tabs > li > a:hover,
.tabs-right > .nav-tabs > li > a:focus {
  border-color: #eeeeee #eeeeee #eeeeee #dddddd;
}

.tabs-right > .nav-tabs .active > a,
.tabs-right > .nav-tabs .active > a:hover,
.tabs-right > .nav-tabs .active > a:focus {
  border-color: #ddd #ddd #ddd transparent;
  *border-left-color: #ffffff;
}
.nav > .disabled > a {
  color: #999999;
}

.nav > .disabled > a:hover,
.nav > .disabled > a:focus {
  text-decoration: none;
  cursor: default;
  background-color: transparent;
}

.navbar {
  *position: relative;
  *z-index: 2;
  margin-bottom: 20px;
  overflow: visible;
}

.navbar-inner {
  min-height: 40px;
  padding-right: 20px;
  padding-left: 20px;
  background-color: #fafafa;
  background-image: -moz-linear-gradient(top, #ffffff, #f2f2f2);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#f2f2f2));
  background-image: -webkit-linear-gradient(top, #ffffff, #f2f2f2);
  background-image: -o-linear-gradient(top, #ffffff, #f2f2f2);
  background-image: linear-gradient(to bottom, #ffffff, #f2f2f2);
  background-repeat: repeat-x;
  border: 1px solid #d4d4d4;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#fff2f2f2', GradientType=0);
  *zoom: 1;
  -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
     -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
          box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
}

.navbar-inner:before,
.navbar-inner:after {
  display: table;
  line-height: 0;
  content: "";
}

.navbar-inner:after {
  clear: both;
}

.navbar .container {
  width: auto;
}

.nav-collapse.collapse {
  height: auto;
  overflow: visible;
}

.navbar .brand {
  display: block;
  float: left;
  padding: 10px 20px 10px;
  margin-left: -20px;
  font-size: 20px;
  font-weight: 200;
  color: #777777;
  text-shadow: 0 1px 0 #ffffff;
}

.navbar .brand:hover,
.navbar .brand:focus {
  text-decoration: none;
}

.navbar-text {
  margin-bottom: 0;
  line-height: 40px;
  color: #777777;
}

.navbar-link {
  color: #777777;
}

.navbar-link:hover,
.navbar-link:focus {
  color: #333333;
}

.navbar .divider-vertical {
  height: 40px;
  margin: 0 9px;
  border-right: 1px solid #ffffff;
  border-left: 1px solid #f2f2f2;
}

.navbar .btn,
.navbar .btn-group {
  margin-top: 5px;
}

.navbar .btn-group .btn,
.navbar .input-prepend .btn,
.navbar .input-append .btn,
.navbar .input-prepend .btn-group,
.navbar .input-append .btn-group {
  margin-top: 0;
}

.navbar-form {
  margin-bottom: 0;
  *zoom: 1;
}

.navbar-form:before,
.navbar-form:after {
  display: table;
  line-height: 0;
  content: "";
}

.navbar-form:after {
  clear: both;
}

.navbar-form input,
.navbar-form select,
.navbar-form .radio,
.navbar-form .checkbox {
  margin-top: 5px;
}

.navbar-form input,
.navbar-form select,
.navbar-form .btn {
  display: inline-block;
  margin-bottom: 0;
}

.navbar-form input[type="image"],
.navbar-form input[type="checkbox"],
.navbar-form input[type="radio"] {
  margin-top: 3px;
}

.navbar-form .input-append,
.navbar-form .input-prepend {
  margin-top: 5px;
  white-space: nowrap;
}

.navbar-form .input-append input,
.navbar-form .input-prepend input {
  margin-top: 0;
}

.navbar-search {
  position: relative;
  float: left;
  margin-top: 5px;
  margin-bottom: 0;
}

.navbar-search .search-query {
  padding: 4px 14px;
  margin-bottom: 0;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  font-weight: normal;
  line-height: 1;
  -webkit-border-radius: 15px;
     -moz-border-radius: 15px;
          border-radius: 15px;
}

.navbar-static-top {
  position: static;
  margin-bottom: 0;
}

.navbar-static-top .navbar-inner {
  -webkit-border-radius: 0;
     -moz-border-radius: 0;
          border-radius: 0;
}

.navbar-fixed-top,
.navbar-fixed-bottom {
  position: fixed;
  right: 0;
  left: 0;
  z-index: 1030;
  margin-bottom: 0;
}

.navbar-fixed-top .navbar-inner,
.navbar-static-top .navbar-inner {
  border-width: 0 0 1px;
}

.navbar-fixed-bottom .navbar-inner {
  border-width: 1px 0 0;
}

.navbar-fixed-top .navbar-inner,
.navbar-fixed-bottom .navbar-inner {
  padding-right: 0;
  padding-left: 0;
  -webkit-border-radius: 0;
     -moz-border-radius: 0;
          border-radius: 0;
}

.navbar-static-top .container,
.navbar-fixed-top .container,
.navbar-fixed-bottom .container {
  width: 940px;
}

.navbar-fixed-top {
  top: 0;
}

.navbar-fixed-top .navbar-inner,
.navbar-static-top .navbar-inner {
  -webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
     -moz-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
          box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
}

.navbar-fixed-bottom {
  bottom: 0;
}

.navbar-fixed-bottom .navbar-inner {
  -webkit-box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);
     -moz-box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);
          box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);
}

.navbar .nav {
  position: relative;
  left: 0;
  display: block;
  float: left;
  margin: 0 10px 0 0;
}

.navbar .nav.pull-right {
  float: right;
  margin-right: 0;
}

.navbar .nav > li {
  float: left;
}

.navbar .nav > li > a {
  float: none;
  padding: 10px 15px 10px;
  color: #777777;
  text-decoration: none;
  text-shadow: 0 1px 0 #ffffff;
}

.navbar .nav .dropdown-toggle .caret {
  margin-top: 8px;
}

.navbar .nav > li > a:focus,
.navbar .nav > li > a:hover {
  color: #333333;
  text-decoration: none;
  background-color: transparent;
}

.navbar .nav > .active > a,
.navbar .nav > .active > a:hover,
.navbar .nav > .active > a:focus {
  color: #555555;
  text-decoration: none;
  background-color: #e5e5e5;
  -webkit-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
     -moz-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
          box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);
}

.navbar .btn-navbar {
  display: none;
  float: right;
  padding: 7px 10px;
  margin-right: 5px;
  margin-left: 5px;
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #ededed;
  *background-color: #e5e5e5;
  background-image: -moz-linear-gradient(top, #f2f2f2, #e5e5e5);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f2f2f2), to(#e5e5e5));
  background-image: -webkit-linear-gradient(top, #f2f2f2, #e5e5e5);
  background-image: -o-linear-gradient(top, #f2f2f2, #e5e5e5);
  background-image: linear-gradient(to bottom, #f2f2f2, #e5e5e5);
  background-repeat: repeat-x;
  border-color: #e5e5e5 #e5e5e5 #bfbfbf;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff2f2f2', endColorstr='#ffe5e5e5', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);
     -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);
}

.navbar .btn-navbar:hover,
.navbar .btn-navbar:focus,
.navbar .btn-navbar:active,
.navbar .btn-navbar.active,
.navbar .btn-navbar.disabled,
.navbar .btn-navbar[disabled] {
  color: #ffffff;
  background-color: #e5e5e5;
  *background-color: #d9d9d9;
}

.navbar .btn-navbar:active,
.navbar .btn-navbar.active {
  background-color: #cccccc \9;
}

.navbar .btn-navbar .icon-bar {
  display: block;
  width: 18px;
  height: 2px;
  background-color: #f5f5f5;
  -webkit-border-radius: 1px;
     -moz-border-radius: 1px;
          border-radius: 1px;
  -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
     -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
          box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
}

.btn-navbar .icon-bar + .icon-bar {
  margin-top: 3px;
}

.navbar .nav > li > .dropdown-menu:before {
  position: absolute;
  top: -7px;
  left: 9px;
  display: inline-block;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #ccc;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.navbar .nav > li > .dropdown-menu:after {
  position: absolute;
  top: -6px;
  left: 10px;
  display: inline-block;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #ffffff;
  border-left: 6px solid transparent;
  content: '';
}

.navbar-fixed-bottom .nav > li > .dropdown-menu:before {
  top: auto;
  bottom: -7px;
  border-top: 7px solid #ccc;
  border-bottom: 0;
  border-top-color: rgba(0, 0, 0, 0.2);
}

.navbar-fixed-bottom .nav > li > .dropdown-menu:after {
  top: auto;
  bottom: -6px;
  border-top: 6px solid #ffffff;
  border-bottom: 0;
}

.navbar .nav li.dropdown > a:hover .caret,
.navbar .nav li.dropdown > a:focus .caret {
  border-top-color: #333333;
  border-bottom-color: #333333;
}

.navbar .nav li.dropdown.open > .dropdown-toggle,
.navbar .nav li.dropdown.active > .dropdown-toggle,
.navbar .nav li.dropdown.open.active > .dropdown-toggle {
  color: #555555;
  background-color: #e5e5e5;
}

.navbar .nav li.dropdown > .dropdown-toggle .caret {
  border-top-color: #777777;
  border-bottom-color: #777777;
}

.navbar .nav li.dropdown.open > .dropdown-toggle .caret,
.navbar .nav li.dropdown.active > .dropdown-toggle .caret,
.navbar .nav li.dropdown.open.active > .dropdown-toggle .caret {
  border-top-color: #555555;
  border-bottom-color: #555555;
}

.navbar .pull-right > li > .dropdown-menu,
.navbar .nav > li > .dropdown-menu.pull-right {
  right: 0;
  left: auto;
}

.navbar .pull-right > li > .dropdown-menu:before,
.navbar .nav > li > .dropdown-menu.pull-right:before {
  right: 12px;
  left: auto;
}

.navbar .pull-right > li > .dropdown-menu:after,
.navbar .nav > li > .dropdown-menu.pull-right:after {
  right: 13px;
  left: auto;
}

.navbar .pull-right > li > .dropdown-menu .dropdown-menu,
.navbar .nav > li > .dropdown-menu.pull-right .dropdown-menu {
  right: 100%;
  left: auto;
  margin-right: -1px;
  margin-left: 0;
  -webkit-border-radius: 6px 0 6px 6px;
     -moz-border-radius: 6px 0 6px 6px;
          border-radius: 6px 0 6px 6px;
}

.navbar-inverse .navbar-inner {
  background-color: #1b1b1b;
  background-image: -moz-linear-gradient(top, #222222, #111111);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#222222), to(#111111));
  background-image: -webkit-linear-gradient(top, #222222, #111111);
  background-image: -o-linear-gradient(top, #222222, #111111);
  background-image: linear-gradient(to bottom, #222222, #111111);
  background-repeat: repeat-x;
  border-color: #252525;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff222222', endColorstr='#ff111111', GradientType=0);
}

.navbar-inverse .brand,
.navbar-inverse .nav > li > a {
  color: #999999;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}

.navbar-inverse .brand:hover,
.navbar-inverse .nav > li > a:hover,
.navbar-inverse .brand:focus,
.navbar-inverse .nav > li > a:focus {
  color: #ffffff;
}

.navbar-inverse .brand {
  color: #999999;
}

.navbar-inverse .navbar-text {
  color: #999999;
}

.navbar-inverse .nav > li > a:focus,
.navbar-inverse .nav > li > a:hover {
  color: #ffffff;
  background-color: transparent;
}

.navbar-inverse .nav .active > a,
.navbar-inverse .nav .active > a:hover,
.navbar-inverse .nav .active > a:focus {
  color: #ffffff;
  background-color: #111111;
}

.navbar-inverse .navbar-link {
  color: #999999;
}

.navbar-inverse .navbar-link:hover,
.navbar-inverse .navbar-link:focus {
  color: #ffffff;
}

.navbar-inverse .divider-vertical {
  border-right-color: #222222;
  border-left-color: #111111;
}

.navbar-inverse .nav li.dropdown.open > .dropdown-toggle,
.navbar-inverse .nav li.dropdown.active > .dropdown-toggle,
.navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle {
  color: #ffffff;
  background-color: #111111;
}

.navbar-inverse .nav li.dropdown > a:hover .caret,
.navbar-inverse .nav li.dropdown > a:focus .caret {
  border-top-color: #ffffff;
  border-bottom-color: #ffffff;
}

.navbar-inverse .nav li.dropdown > .dropdown-toggle .caret {
  border-top-color: #999999;
  border-bottom-color: #999999;
}

.navbar-inverse .nav li.dropdown.open > .dropdown-toggle .caret,
.navbar-inverse .nav li.dropdown.active > .dropdown-toggle .caret,
.navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle .caret {
  border-top-color: #ffffff;
  border-bottom-color: #ffffff;
}

.navbar-inverse .navbar-search .search-query {
  color: #ffffff;
  background-color: #515151;
  border-color: #111111;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);
     -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);
  -webkit-transition: none;
     -moz-transition: none;
       -o-transition: none;
          transition: none;
}

.navbar-inverse .navbar-search .search-query:-moz-placeholder {
  color: #cccccc;
}

.navbar-inverse .navbar-search .search-query:-ms-input-placeholder {
  color: #cccccc;
}

.navbar-inverse .navbar-search .search-query::-webkit-input-placeholder {
  color: #cccccc;
}

.navbar-inverse .navbar-search .search-query:focus,
.navbar-inverse .navbar-search .search-query.focused {
  padding: 5px 15px;
  color: #333333;
  text-shadow: 0 1px 0 #ffffff;
  background-color: #ffffff;
  border: 0;
  outline: 0;
  -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
     -moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
}

.navbar-inverse .btn-navbar {
  color: #ffffff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #0e0e0e;
  *background-color: #040404;
  background-image: -moz-linear-gradient(top, #151515, #040404);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#151515), to(#040404));
  background-image: -webkit-linear-gradient(top, #151515, #040404);
  background-image: -o-linear-gradient(top, #151515, #040404);
  background-image: linear-gradient(to bottom, #151515, #040404);
  background-repeat: repeat-x;
  border-color: #040404 #040404 #000000;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff151515', endColorstr='#ff040404', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.navbar-inverse .btn-navbar:hover,
.navbar-inverse .btn-navbar:focus,
.navbar-inverse .btn-navbar:active,
.navbar-inverse .btn-navbar.active,
.navbar-inverse .btn-navbar.disabled,
.navbar-inverse .btn-navbar[disabled] {
  color: #ffffff;
  background-color: #040404;
  *background-color: #000000;
}

.navbar-inverse .btn-navbar:active,
.navbar-inverse .btn-navbar.active {
  background-color: #000000 \9;
}

</style>

<script>
    $("#t1").click(function(){
      $("#li1").addClass("active");
      $("#li2").removeClass("active");
      $("#li3").removeClass("active");
      $("#li4").removeClass("active");
      $("#li5").removeClass("active");
      $("#tab1").show();
      $("#tab2").hide();
      $("#tab3").hide();
      $("#tab4").hide();
      $("#tab5").hide();
  });

  $("#t2").click(function(){
      $("#li1").removeClass("active");
      $("#li2").addClass("active");
      $("#li3").removeClass("active");
      $("#li4").removeClass("active");
      $("#li5").removeClass("active");
      $("#tab1").hide();
      $("#tab2").show();
      $("#tab3").hide();
      $("#tab4").hide();
      $("#tab5").hide();
  });

  $("#t3").click(function(){
      $("#li1").removeClass("active");
      $("#li2").removeClass("active");
      $("#li3").addClass("active");
      $("#li4").removeClass("active");
      $("#li5").removeClass("active");
      $("#tab1").hide();
      $("#tab2").hide();
      $("#tab3").show();
      $("#tab4").hide();
      $("#tab5").hide();
  });

  $("#t4").click(function(){
      $("#li1").removeClass("active");
      $("#li2").removeClass("active");
      $("#li3").removeClass("active");
      $("#li4").addClass("active");
      $("#li5").removeClass("active");
      $("#tab1").hide();
      $("#tab2").hide();
      $("#tab3").hide();
      $("#tab4").show();
      $("#tab5").hide();
  });

  $("#t5").click(function(){
      $("#li1").removeClass("active");
      $("#li2").removeClass("active");
      $("#li3").removeClass("active");
      $("#li4").removeClass("active");
      $("#li5").addClass("active");
      $("#tab1").hide();
      $("#tab2").hide();
      $("#tab3").hide();
      $("#tab4").hide();
      $("#tab5").show();
  });

  function horaampm(hora) {
    hours = parseInt(hora.substr(0,2));
    minutos = hora.substr(2,3);

    ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; 
    strTime = hours + minutos + ' ' + ampm;

    return strTime;
  }


  function fechaactual(formato=0) {
    var f = new Date();
    if(formato==0) {
      dia = f.getDate(); if(dia<10) dia = "0"+ dia;
      mes = (f.getMonth() +1); if(mes<10) mes = "0" + mes;
      return(f.getFullYear() + "-" + mes + "-" + dia);    
    }

    if(formato==1) {
      dia = f.getDate(); if(dia<10) dia = "0"+ dia;
      mes = (f.getMonth() +1); if(mes<10) mes = "0" + mes;
      return( dia + "/" + mes + "/" + f.getFullYear());
    }

    }

  function horaactual() {
    var f = new Date();
    hora = f.getHours();
    minu = f.getMinutes();
    segu = f.getSeconds();
    return (hora+":"+minu+":"+segu);
  }

  function number_format(amount, decimals=0) {
      amount += ''; 
      amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); 
      decimals = decimals || 0; 

      if (isNaN(amount) || amount === 0) 
          return parseFloat(0).toFixed(decimals);

      amount = '' + amount.toFixed(decimals);
      var amount_parts = amount.split('.'),
          regexp = /(\d+)(\d{3})/;

      while (regexp.test(amount_parts[0]))
          amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

      return amount_parts.join('.');
  }

   function enviamsg(emailpara, mess,asu, ale) {
    $.ajax({
        type:"post",
        url :"ajax/aviso.php",
        data: {
          para : emailpara,
          mensaje: mess,
          asunto: asu,
          alerta : ale
        },
        success : function(data) {
          alert(data);
          location.reload(true);
          navigator.vibrate(2000);
        }
    });
   }

</script>