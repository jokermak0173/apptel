<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mostrar turnos
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Mostrar turnos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
         
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>Horario Entrada</th>
                        <th>Horario Salida</th>                    
                        <th>Id Turno</th>  
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item1 = "plaza";
                    $valor1 = $_SESSION["idPlaza"];
                    
                    
                    $turnos = ControladorTurnos::ctrMostrarTurnos();

                    foreach($turnos as $key => $value){

                      
                      echo '<tr> 
                                <td>'.$value["horario_entrada"].'</td>
                                <td>'.$value["horario_salida"].'</td>';
                               
                                
                                
                               
                                  echo '<td>'.$value["id"].'</td>';
                              
                               
                                 echo'
                                
                            </tr>';
                            
                    }

                  ?>
                    
                    </tr>
                </tbody>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>


    </section>
   
  </div>

