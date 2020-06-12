
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Horario
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar horario</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-2">

          <!-- /. box -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">
                <div class="wrap">
                  <div class="widget">
                    <?php
                      if($_SESSION["idPlaza"] != "2"){
                        echo '<div class="fecha">
                                Tolerancia quincena actual (estimacion)
                              </div>';
                      }
                    ?>

                    <?php

                        $valor1 = $_SESSION["numemp"];

                        $valor2 = $_SESSION["idChecador"];



                        $tolerancia = ControladorHorarios::ctrCalcularTiempoTolerancia($valor1, $valor2);
                        echo '<div class="reloj">';
                        if($_SESSION["idPlaza"] != "2"){
                            echo '<span>'.$tolerancia.':00 min</span>';
                        }else{
                          echo '<span> No hay tiempo de tolerancia en tu plaza </span>';
                        }
                        echo '  </div>';

                    ?>
                  </div>
                </div>
              </h4>
            </div>
            <div class="box-body">
              <!-- the events -->


              <div id="external-events">

               <div class="external-event" style="background-color:#298A08; color:white;">A - Asistencia</div>
               <div class="external-event" style="background-color:#00FF00; color:white;">AA - Asistencia x permuta</div>
               <div class="external-event" style="background-color:#F7BE81; color:white;">D - Descanso</div>
               <div class="external-event" style="background-color:#0040FF; color:white;">DD - Dia sin goce (Permuta libre)</div>
               <div class="external-event" style="background-color:#8904B1; color:white;">PE - Permuta Dia x Dia</div>
               <div class="external-event" style="background-color:yellow; color:white;">R - Retardo</div>
               <div class="external-event" style="background-color:#DBA901; color:white;">RA - Retardo en Permuta</div>
               <div class="external-event" style="background-color:red; color:white;">FI - Falta Injustificada</div>
               <div class="external-event" style="background-color:#FE2EC8; color:white;">FJ - Falta Justificada</div>
               <div class="external-event" style="background-color:#6E6E6E; color:white;">P - Permiso</div>
               <div class="external-event" style="background-color:#B12323; color:white;">I - Incapacidad</div>
                <div class="external-event" style="background-color:#04E3D0; color:white;">V - Vacaciones</div>


              </div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendarioHorario"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php



  echo '<script>
  $(document).ready(function(){
  $("#calendarioHorario").fullCalendar({

    events: "ajax/horarioChecador.ajax.php?buscarHorarioEntrada=true&idPlaza='.$_SESSION["idPlaza"].'&idChecador='.$_SESSION["idChecador"].'",

    dayClick: function(date, jsEvent, view){

        traerComentario(date.format(), '.$_SESSION["numemp"].');
        $("#modalComentarioAsistencia").modal();
    }


  }, "calendarioHorario");

  cargarHorario('.$_SESSION["numemp"].');
});

</script>';
?>

<div class="modal fade" id="modalComentarioAsistencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Comentario</h3>


      </div>
      <div class="modal-body">


        <div class="form-row">
          <div class="form-group col-md-10">

            <textarea class="form-control" id="comentarioAsistencia" style="border-radius: 4px" readonly> </textarea>
          </div>

        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
