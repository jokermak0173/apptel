<script>
  setTimeout('document.location.reload()',60000);
  var numemp = '<?php echo $_SESSION["numemp"];?>';
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ver permutas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ver permutas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo utf8_decode($_SESSION["campaniaNombre"]);?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <?php


        $item1 = "fecha_solicita";
        $valor1 = date('Y-m-d');
        $item2 = "campana_solicita";
        $valor2 = $_SESSION["campania"];
        $item3 = "estado";
        $valor3 = "enviada";
        $item4 = "asesor_solicita";
        $valor4 = $_SESSION["numemp"];

        $respuesta = ControladorPermutas::ctrMostrarPermutas($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
        $i = 1;
        foreach ($respuesta as $key => $value) {
            $item = "numemp";
            $valor = $value["asesor_solicita"];
            $asesor = ControladorUsuarios::ctrMostrarAsesorPorId($item, $valor);
                switch($value["tipo_permuta"]){
                              case 1: $tipoPermuta = "Permuta Dia x Dia"; 
                                $fondoHeader = "rgb(102, 51, 0)";
                              break;
                              case 2: $tipoPermuta = "Permuta libre"; 
                                $fondoHeader = "rgb(0, 163, 204)";
                              break;
                              case 3: $tipoPermuta = "Cambio Turno"; 
                                  $fondoHeader = "rgb(51, 153, 102)";
                              break;
                          }
                if($i == 1)
                {
                  echo ' <div class="row">';
                }
                echo '       <div class="col-md-4">
               
                <div class="box box-widget widget-user">
                 
                  <div class="widget-user-header" style="background-color:'.$fondoHeader.'; color:white">
                    <h3 class="widget-user-username">'.utf8_decode($asesor["nombre_completo"]).'</h3>
                    <h5 class="widget-user-desc">Isla : '.$value["supervisor_solicita"].'</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="'.$asesor["foto"].'" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">';
                          
                          
                          echo'<span><b>'.$tipoPermuta.'</b></span>
                        </div>
                      
                      </div>
                      
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <span><b>Fecha permuta</b></span>
                          <span class="description-text">'.$value["fecha_solicita"].'</span>
                        </div>
                       
                      </div>
                    
                      <div class="col-sm-4">
                        <div class="description-block">';
                          if($value["tipo_permuta"] == 1 || $value["tipo_permuta"] == 3)
                          {
                            echo '<button class="btn btn-primary btnInfoExtraPermuta" tipoPermuta="'.$value["tipo_permuta"].'" fechaPermuta="'.$value["fecha_solicita"].'" fechaCierre="'.$value["fecha_cierre"].'" turnoCubro="'.$value["turno_cubre_solicita"].'" turnoMeCubren="'.$value["turno_cubre_acepta"].'"><i class="fa fa-info"></i></button> ';
                          }
                          echo  
                          '<button class="btn btn-info btnConsolidarPermuta" idPermuta="'.$value["id"].'" fechaPermuta="'.$value["fecha_solicita"].'" numEmp="'.$_SESSION["numemp"].'"><i class="fa fa-handshake"></i></button>
                          
                        </div>
                        
                        
                      </div>
                     
                    </div>
                   
                  </div>
                </div>
               
              </div>';
                if($i == 3){
                  echo '</div>';
                  $i = 1;
                  continue;
                }
                $i++;
            }
      ?>
      
        </div>
        <!-- /.box-body -->
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->