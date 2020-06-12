<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Mis permutas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Mis permutas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Permutas que yo acepte</h3>

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
        $item2 = "estado";
        $item3= "asesor_acepta";
        $valor3 = $_SESSION["numemp"];

        $respuesta = ControladorPermutas::ctrMostrarPermutasQueAcepte($item1, $valor1, $item2, $item3, $valor3);
        $i = 1;
        foreach ($respuesta as $key => $value) {
            $item = "numemp";
            $valor = $value["asesor_solicita"];
            $asesor = ControladorUsuarios::ctrMostrarAsesorPorId($item, $valor);
                switch($value["tipo_permuta"]){
                              case 1: $tipoPermuta = "Permuta dia x dia"; 
                                $fondoHeader = "bg-green";
                              break;
                              case 2: $tipoPermuta = "Permuta libre"; 
                                $fondoHeader = "bg-blue";
                              break;
                              case 3: $tipoPermuta = "Cambio Turno"; 
                                  $fondoHeader = "bg-yellow";
                              break;
                          }
                switch($value["estado"]){
                              case 'aceptada': 
                                $fondoHeader = "bg-orange";
                              break;
                              case 'denegada': 
                                $fondoHeader = "bg-red";
                              break;
                              case 'cancelada':  
                                  $fondoHeader = "bg-purple";
                              break;
                              case 'autorizada':  
                                  $fondoHeader = "bg-green";
                              break;
                          }
                if($i == 1)
                {
                  echo ' <div class="row">';
                }
                echo '       <div class="col-md-4">
               
                <div class="box box-widget widget-user">
                 
                  <div class="widget-user-header '.$fondoHeader.'">
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
                          <span class="description-text">'.$value["fecha_solicita"].'</span><br>
                          <span><b>'.ucfirst($value["estado"]).'</b></span>
                        </div>
                       
                      </div>
                    
                      <div class="col-sm-4">
                        <div class="description-block">';
                        if($value["tipo_permuta"] == 1 || $value["tipo_permuta"] == 3)
                          {
                            echo '<button class="btn btn-primary btnInfoExtraPermuta" tipoPermuta="'.$value["tipo_permuta"].'" fechaPermuta="'.$value["fecha_solicita"].'" fechaCierre="'.$value["fecha_cierre"].'" turnoCubro="'.$value["turno_cubre_solicita"].'" turnoMeCubren="'.$value["turno_cubre_acepta"].'"><i class="fa fa-info"></i></button> ';
                          }

                        echo  
                          '
                          <button class="btn btn-info btnInfoPermuta" idPermuta="'.$value["id"].'"><img src="vistas/img/plantilla/info.png" width="18px" /></button>
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