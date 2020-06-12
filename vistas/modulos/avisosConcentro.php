<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Avisos
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ver publicaciones</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

     <?php

        $item = "plaza";
        $valor = 2;
        $avisos = ControladorAvisos::ctrMostrarAvisos($item, $valor);

        foreach ($avisos as $key => $value) {

          $item = "numemp";
          $valor = $value["numemp"];
          $usuarioPublico = ControladorUsuarios::ctrMostrarUsuario($item, $valor);
          echo '<div class="row">
              <div class="col-md-2"></div>
        <div class="col-md-7">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$usuarioPublico["foto"].'" alt="User Image">';
                switch($usuarioPublico["nivel_acceso"]){
                  case "1": $area = "(Sistemas)"; break;
                  case "3": $area = "(Recrea)"; break;
                  case "6": $area = "(Reclutamiento y Seleccion)"; break;
                  default: $area = ""; break;
                }
                echo '
                <span class="username"><a href="#">'.utf8_decode($usuarioPublico["nombre_completo"]).'</a></span>
                <span class="description">Publicado el ';
                  $fecha = strtotime($value["fecha_publicacion"]);
                  $mesPublicacion = date('m',$fecha);
                  $diaPublicacion = date('d',$fecha);
                  $añoPublicacion = date('Y',$fecha);

                  $horaPublicacion = date('H',$fecha);
                  $minutoPublicacion = date('i',$fecha);

                  if($horaPublicacion > 12){
                    $ampm = "pm";
                    $horaPublicacion-=12;
                  }else{
                    $ampm = "am";
                  }

                  switch($mesPublicacion){
                    case 1: $mes = "enero"; break; 
                    case 2: $mes = "febrero"; break; 
                    case 3: $mes = "marzo"; break; 
                    case 4: $mes = "abril"; break; 
                    case 5: $mes = "mayo"; break; 
                    case 6: $mes = "junio"; break; 
                    case 7: $mes = "julio"; break; 
                    case 8: $mes = "agosto"; break; 
                    case 9: $mes = "septiembre"; break; 
                    case 10: $mes = "octubre"; break; 
                    case 11: $mes = "noviembre"; break; 
                    case 12: $mes = "diciembre"; break; 
                  }
                  if($horaPublicacion == 1){
                     echo $diaPublicacion." de ". $mes. " a la ".$horaPublicacion.":".$minutoPublicacion." ".$ampm;
                  }else{
                     echo $diaPublicacion." de ". $mes. " a las ".$horaPublicacion.":".$minutoPublicacion." ".$ampm;
                  }
                 
                echo '</span>
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p>'.utf8_decode($value["texto"]).'</p>';
              if($value["imagen"] != "")
              {
                echo '<img class="img-responsive pad" src="'.$value["imagen"].'">';
              }
              echo '         
            </div>
            
          </div>
        </div>
      </div>';
        }

     ?>
              
               
    
        


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->