<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mostrar campañas
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Mostrar campañas</li>
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

                        <th>Campaña</th>
                        <th>Id Campaña</th>                    
                        
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item = "plaza";
                    $valor = $_SESSION["idPlaza"];
                    $item2 = null;
                    $valor2 = null;
                    $campañas = ControladorCampañas::ctrMostrarCampañasPlaza($item, $valor, $item2, $valor2);
                    
                    foreach($campañas as $key => $value){

                     
                      echo '<tr> 
                                <td>'.utf8_decode($value["campana"]).'</td>';
                                
                                
                                
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

