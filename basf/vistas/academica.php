<style>
  .titulo {
    font-size: 12px;
  }
  #li1 a, #li2 a, #li3 a, #li4 a, #li5 a {
    color: black;
    font-weight: ;
  }
.desactivado {
pointer-events: none;
cursor: default;
text-decoration: none;
color: red;
}

</style>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs titulo">
    <li id="li1"><a id="t1" data-toggle="tab"><i style="color: #FCCB6D; font-size: 15px" class="fa fa-book"></i> Asignaturas</a></li>
    <li id="li2"><a id="t2" data-toggle="tab"><i style="color: #FCCB6D; font-size: 15px" class="fa fa-unlock-alt"></i> Gestion de Usuarios</a></li>
    <li id="li3"><a id="t3" data-toggle="tab"><i style="color: #FCCB6D; font-size: 15px" class="fa fa-group"></i> Grupos Academicos</a></li>
    <li id="li4"><a id="t4" data-toggle="tab"><i style="color: #FCCB6D; font-size: 15px" class="fa fa-user"></i> Alumnos por Grupos</a></li>
    <li id="li5"><a id="t5" data-toggle="tab"><i style="color: #FCCB6D; font-size: 15px" class="fa fa-sitemap"></i> Cargas Academicas</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane well" id="tab1">
      <?php include("asignaturas.php"); ?>
    </div>
    <div class="tab-pane well" id="tab2">
      <?php include("usuarios.php"); ?>
    </div>
    <div class="tab-pane well" id="tab3">
      <?php include("grupos.php"); ?>
    </div>
    <div class="tab-pane well" id="tab4">
      <?php include("alumnosporgrupo.php"); ?>
    </div>
    <div class="tab-pane well" id="tab5">
      <?php include("cargas.php"); ?>
    </div>
  </div>
</div>

<script>

</script>