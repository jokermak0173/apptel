
<script>
  setTimeout('document.location.reload()',60000);

</script>
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Permutas
        <small>Lanza tu permuta</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permutas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Arrastra tu tipo de permuta al dia que lo necesitas</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <div class="external-event" style="background-color: rgb(102, 51, 0); color:white">Permuta dia x dia</div>
                <div class="external-event bg-light-blue">Permuta libre</div>
                <div class="external-event" style="background-color: rgb(51, 153, 102); color:white">Cambio Turno</div>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendarioPermutas"></div>
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

</div>
<!-- ./wrapper -->


<script src="vistas/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>


//force focusing password box

  </script>

<!-- Page specific script -->
<script>

  $(function () {



    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var numemp = '<?php echo $_SESSION["numemp"];?>';

    $('#calendarioPermutas').fullCalendar({

       eventLimit: true, // for all non-agenda views
        views: {
          agenda: {
            eventLimit: 1 // adjust to 6 only for agendaWeek/agendaDay
          }
        },

      events: "ajax/permutas.ajax.php?buscarCalendario=true&numemp="+ numemp,
      //Random default events

      editable  : false,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped



      var fechaDrop = new Date(date);
      var fechaHoy = new Date();

      if(Number(fechaDrop.getMonth()) < 9)
      {
        mesDrop = "0" + Number(fechaDrop.getMonth() + 1);
      }else{
        mesDrop = Number(fechaDrop.getMonth() + 1);
      }
      if(Number(fechaDrop.getDate() + 1) < 10)
      {
        diaDrop = "0" + Number(fechaDrop.getDate() + 1);
      }else{
        diaDrop = Number(fechaDrop.getDate() + 1);
      }

      if(Number(fechaHoy.getMonth()) < 10)
      {
        mesHoy = "0" + Number(fechaHoy.getMonth() + 1);
      }else{
        mesHoy = Number(fechaHoy.getMonth() + 1);
      }
      if(Number(fechaHoy.getDate()) < 10)
      {
        diaHoy = "0" + Number(fechaHoy.getDate());
      }else{
        diaHoy = Number(fechaHoy.getDate());
      }
      var fechaDropFinal = fechaDrop.getFullYear() + '/' + mesDrop + '/' + diaDrop;
      var fechaHoyFinal = fechaHoy.getFullYear() + '/' + mesHoy + '/' + diaHoy;


      /*Excepcion 01/07/2019*/
      if(fechaDropFinal == "2019/06/31"){
          fechaDropFinal = "2019/07/01";
      }



        if(fechaDropFinal < fechaHoyFinal )
        {
          swal({
                type: "error",
                title: "Dia no valido fechaDropFinal: " + fechaDropFinal + ", FechaDrop: " + diaDrop  + ", FechaHoy: " + fechaHoy.getDate(),
                showConfirmbutton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
              }).then(function(result){
                if(result.value){
                  window.location = "crear-permuta";
                }
              });
       }else{

        var globalData = {};
        var numemp = '<?php echo $_SESSION["numemp"];?>';

        function getGlobalData(url, method)
        {

            return JSON.parse($.ajax({
                type: method,
                url: url,
                dataType: 'json',
                async:false,
                success: function(data)
                {
                    return data;
                }
            }).responseText);
        }


        globalData = getGlobalData("http://189.198.135.118/mi_atel/ajax/permutas.ajax.php?buscarEventoRepetido=true&numemp="+ numemp + "&fechaEvento=" + fechaDropFinal , "GET");
        console.log(globalData);
       if(globalData.length > 0){
             swal({
                  title: "NO PUEDES MANDAR 2 O MAS PERMUTAS PARA 1 DIA EN ESPECIFICO, ESPERA A QUE LA AUTORICEN O BIEN BORRALA SI ES QUE ESTA ENVIADA" ,
                  type: "error",
                  confirmButtonText:"¡Cerrar!",
                }).then(function(result){
                  if(result.value){
                    window.location = "crear-permuta";
                  }
                });
        }
        else{
          // we need to copy it, so that multiple events don't have a reference to the same object
         var originalEventObject = $(this).data('eventObject')
         var copiedEventObject = $.extend({}, originalEventObject)
         // assign it the date that was reported
         copiedEventObject.start           = date
         copiedEventObject.allDay          = allDay
         copiedEventObject.backgroundColor = "gray"
         copiedEventObject.borderColor     = $(this).css('border-color')

         // render the event on the calendar
         // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
         $('#calendarioPermutas').fullCalendar('renderEvent', copiedEventObject, true)

         // is the "remove after drop" checkbox checked?
         if ($('#drop-remove').is(':checked')) {
           // if so, remove the element from the "Draggable Events" list
           $(this).remove()
         }

         var tipoPermuta = 0;
         var numemp = '<?php echo $_SESSION["numemp"];?>';
         var fechaPermuta = date.format();
         var campania = '<?php echo $_SESSION["campania"];?>';
         var idTurno = '<?php echo $_SESSION["idTurno"];?>';
         var supervisor = '<?php echo $_SESSION["nombreSupervisor"];?>';
         var estado = "enviada";
         var idPlaza = '<?php echo $_SESSION["idPlaza"];?>';
         switch(copiedEventObject.title){
           case 'Permuta dia x dia': tipoPermuta = 1; break;
           case 'Permuta libre': tipoPermuta = 2; break;
           case 'Cambio Turno': tipoPermuta = 3; break;
           default: break;
         }




         var datos = new FormData();
         datos.append("enviarPermuta", true);
         datos.append("tipoPermuta", tipoPermuta);
         datos.append("numemp", numemp);
         datos.append("fechaPermuta", fechaPermuta);
         datos.append("campania", campania);
         datos.append("idTurno", idTurno);
         datos.append("supervisor", supervisor);
         datos.append("estado", estado);
         datos.append("idPlaza", idPlaza);
         var enviarAjaxPermuta = false;
         var fechaCierre = "";
         if(tipoPermuta == 1){

           swal({
                 onOpen: function(el) {
                     $("#datepicker").datepicker();
                   },
                 title: "Ingresa fecha cierre de permuta" ,
                 html:
                 '<p><b>Importante: </b> En permutas de dia x dia es necesario indicar la fecha de cierre, esta fecha corresponde al dia en que tu vas a reponer el dia que te cubrieron  </p>'+
       '<h5>Pon la fecha que tu vas a cubrir</h5>'+
                 '<input type="text" id="datepicker" class="form-control">',
                 type: "warning",
                 confirmButtonText:"Aceptar",
               }).then(function(result){

           if(result.value){
            fechaCierre = $("#datepicker").val();


            if(fechaCierre == ""){
             swal({
                   title: "Permuta NO ENVIADA se requiere fecha cierre: ",
                   type: "error",
                   confirmButtonText:"¡Cerrar!",
                 }).then(function(result){
                   if(result.value){
                     window.location = "crear-permuta";
                   }
                 });
            }else{
             fecha = diaDrop + "/" + mesDrop +"/" +fechaDrop.getFullYear();
             var anioCierre = fechaCierre.substr(6, 4);
            var diaCierre = fechaCierre.substr(3, 2);
            var mesCierre = fechaCierre.substr(0, 2);
            fechaCierreFinal = diaCierre + "/" + mesCierre + "/" + anioCierre;
              datos.append("fechaCierre", fechaCierre);
               datos.append("turnoCubreSolicita", "");
              datos.append("turnoCubreAcepta", "");
               $.ajax({
                   url:"http://189.198.135.118/mi_atel/ajax/permutas.ajax.php",
                   method: "post",
                   data: datos,
                   cache: false,
                   contentType: false,
                   processData: false,

                   success: function(respuesta){
                     if(respuesta == "ok"){

                             swal({
                               type: "success",
                               title: "Permuta Enviada!",
                               html: "<p>Te cubren el " + fecha + "</p>"+
                                   "<p>Tu vienes el " + fechaCierreFinal,
                               showConfirmbutton: true,
                               confirmButtonText: "Cerrar",
                               closeOnConfirm: false
                             }).then(function(result){
                               if(result.value){
                                 window.location = "crear-permuta";
                               }
                              });


                       }else{

                           swal({
                             title: "Error al enviar permuta Cod. Error: " + respuesta,
                             type: "error",
                             confirmButtonText:"¡Cerrar!",
                           }).then(function(result){
                             if(result.value){
                               window.location = "crear-permuta";
                             }
                           });
                       }
                     }
                 })
            }
           }
         });
         }else if(tipoPermuta == 3){
         var datosTurno = new FormData();
         datosTurno.append("buscarTurnosPlaza", true);
         datosTurno.append("idPlaza", idPlaza);
           $.ajax({
         url:"http://189.198.135.118/mi_atel/ajax/turnos.ajax.php",
         method: "post",
         data: datosTurno,
         cache: false,
         contentType: false,
         processData: false,
         dataType:"json",
         success: function(respuesta){
           var turnoVengo = '<select id="turnoVengo" class="form-control">';
           turnoVengo = turnoVengo.concat('<option value="">Selecciona un turno</option>');
           for(var i = 0 ; i < respuesta.length; i++){
             turnoVengo = turnoVengo.concat('<option value="');
             turnoVengo = turnoVengo.concat(respuesta[i]["horario_entrada"]);
             turnoVengo = turnoVengo.concat(' - ');
             turnoVengo = turnoVengo.concat(respuesta[i]["horario_salida"]);
             turnoVengo = turnoVengo.concat('">');
             turnoVengo = turnoVengo.concat(respuesta[i]["horario_entrada"]);
             turnoVengo = turnoVengo.concat(' - ');
             turnoVengo = turnoVengo.concat(respuesta[i]["horario_salida"]);
             turnoVengo = turnoVengo.concat('</option>');
           }
           turnoVengo += "</select>";

           var turnoMeCubren = '<select id="turnoMeCubren" class="form-control">';
           turnoMeCubren = turnoMeCubren.concat('<option value="">Selecciona un turno</option>');
           for(var i = 0 ; i < respuesta.length; i++){
             turnoMeCubren = turnoMeCubren.concat('<option value="');
             turnoMeCubren = turnoMeCubren.concat(respuesta[i]["horario_entrada"]);
             turnoMeCubren = turnoMeCubren.concat(' - ');
             turnoMeCubren = turnoMeCubren.concat(respuesta[i]["horario_salida"]);
             turnoMeCubren = turnoMeCubren.concat('">');
             turnoMeCubren = turnoMeCubren.concat(respuesta[i]["horario_entrada"]);
             turnoMeCubren = turnoMeCubren.concat(' - ');
             turnoMeCubren = turnoMeCubren.concat(respuesta[i]["horario_salida"]);
             turnoMeCubren = turnoMeCubren.concat('</option>');
           }
           turnoMeCubren += "</select>";

        swal({

                 html:

       '<h5><b>¿En que turno vas a venir?</b></h5>'+turnoVengo+
                 '<br><h5><b>¿En que turno va a venir la otra persona?</b></h5>'+turnoMeCubren,
                 type: "warning",
                 confirmButtonText:"Aceptar",
               }).then(function(result){

           if(result.value){
       var horarioVengo = $("#turnoVengo").val();
       var horarioMeCubren = $("#turnoMeCubren").val();
       datos.append("fechaCierre", "");
             if(horarioVengo == "" || horarioMeCubren == "" ){
               swal({
                    title: "Tienes que introducir ambos horarios",
                    type: "error",
                    confirmButtonText:"¡Cerrar!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "crear-permuta";
                    }
                   });
             }else{
              datos.append("turnoCubreSolicita", horarioVengo);
              datos.append("turnoCubreAcepta", horarioMeCubren);


               $.ajax({
                   url:"http://189.198.135.118/mi_atel/ajax/permutas.ajax.php",
                   method: "post",
                   data: datos,
                   cache: false,
                   contentType: false,
                   processData: false,

                   success: function(respuesta){
                     if(respuesta == "ok"){

                             swal({
                               type: "success",
                               title: "Permuta Enviada!",

                               showConfirmbutton: true,
                               confirmButtonText: "Cerrar",
                               closeOnConfirm: false
                             }).then(function(result){
                               if(result.value){
                                 window.location = "crear-permuta";
                               }
                              });


                       }else{

                           swal({
                             title: "Error al enviar permuta Cod. Error: " + respuesta,
                             type: "error",
                             confirmButtonText:"¡Cerrar!",
                           }).then(function(result){
                             if(result.value){
                               window.location = "crear-permuta";
                             }
                           });
                       }
                     }
                 })
               }
           }
         });
       }
      })

         }
         else{
           datos.append("turnoCubreSolicita", "");
              datos.append("turnoCubreAcepta", "");
           datos.append("fechaCierre", fechaCierre);
               $.ajax({
                   url:"http://189.198.135.118/mi_atel/ajax/permutas.ajax.php",
                   method: "post",
                   data: datos,
                   cache: false,
                   contentType: false,
                   processData: false,

                   success: function(respuesta){
                     if(respuesta == "ok"){

                             swal({
                               type: "success",
                               title: "Permuta Enviada!",
                               showConfirmbutton: true,
                               confirmButtonText: "Cerrar",
                               closeOnConfirm: false
                             }).then(function(result){
                               if(result.value){
                                 window.location = "crear-permuta";
                               }
                              });


                       }else{

                           swal({
                             title: "Error al enviar permuta Cod. Error: " + respuesta,
                             type: "error",
                             confirmButtonText:"¡Cerrar!",
                           }).then(function(result){
                             if(result.value){
                               window.location = "crear-permuta";
                             }
                           });
                       }
                     }
                 })
         }
        }




       }

      },


    eventClick: function(calEvent, jsEvent, view) {
      var nombreSolicita = '<?php echo $_SESSION["nombreCompleto2"];?>';


      if(calEvent.asesor_acepta == null)
      {
        $('#asesorAcepta').val("");


      }else{

         var datos = new FormData();
        datos.append("validarAsesor", calEvent.asesor_acepta);

        $.ajax({
                  url:"ajax/usuarios.ajax.php",
                  method: "post",
                  data: datos,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType: "json",
                  success: function(respuesta){
                     $('#asesorAcepta').val(respuesta["nombre_completo"]);
                  }
                })
      }
     $("#fechaPermutaCubro").datepicker();
      $('#fechaPermuta').val(calEvent[3]);
      $('#idPermuta').val(calEvent[0]);
      $('#tipoPermuta').val(calEvent.title);
      $('#statusPermuta').val(calEvent[4]);
      $('#asesorSolicita').val(nombreSolicita);
      $('#supervisorSolicita').val(calEvent.supervisor_solicita);

      $('#supervisorAcepta').val(calEvent.supervisor_acepta);
      $('#fechaAceptacion').val(calEvent.fecha_acepta);

      $('#reviso').val(calEvent.reviso);
      $('#comentarioReviso').val(calEvent.comentario);
      $('#fechaReviso').val(calEvent.fecha_revision);
      $('#fechaPermutaCubro').val(calEvent.fecha_cierre);
      $('#infoTurnoCubro').val(calEvent.turno_cubre_solicita);
      $('#infoTurnoMeCubren').val(calEvent.turno_cubre_acepta);


      $("#modalPermuta").modal();

       }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

<!-- Modal -->
<div class="modal fade" id="modalPermuta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Detalle Permuta</h3>


      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Tipo Permuta:</label>
             <input type="hidden" class="form-control" id="idPermuta" name="idPermuta" style="border-radius: 4px" readonly>
             <input type="hidden" class="form-control" id="idTipoPermuta" name="idTipoPermuta" style="border-radius: 4px" readonly>
            <input type="text" class="form-control" id="tipoPermuta" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Fecha Me cubren:</label>
            <input type="text" class="form-control" id="fechaPermuta" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Fecha Cubro:</label>
            <input type="text" class="form-control" name="fechaPermutaCubro" id="fechaPermutaCubro" style="border-radius: 4px" >
          </div>

        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Turno Cubro:</label>
            <input type="text" class="form-control" id="infoTurnoCubro" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Turno me cubren:</label>
            <input type="text" class="form-control" id="infoTurnoMeCubren" style="border-radius: 4px" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Solicita:</label>
            <input type="text" class="form-control" id="asesorSolicita" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Supervisor:</label>
            <input type="text" class="form-control" id="supervisorSolicita" style="border-radius: 4px" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Acepta:</label>
            <input type="text" class="form-control" id="asesorAcepta" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Supervisor:</label>
            <input type="text" class="form-control" id="supervisorAcepta" style="border-radius: 4px" readonly>
          </div>
           <div class="form-group col-md-4">
            <label>Fecha Aceptacion:</label>
            <input type="text" class="form-control" id="fechaAceptacion" style="border-radius: 4px" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Reviso:</label>
            <input type="text" class="form-control" id="reviso" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Comentario:</label>
            <input type="text" class="form-control" id="comentarioReviso" style="border-radius: 4px" readonly>
          </div>
           <div class="form-group col-md-4">
            <label>Fecha Revision:</label>
            <input type="text" class="form-control" id="fechaReviso" style="border-radius: 4px" readonly>
          </div>
        </div>
         <div class="form-row">
         	<div class="form-group col-md-3">
            <label>Status:</label>
            <input type="text" class="form-control" id="statusPermuta" style="border-radius: 4px" readonly>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Guardar cambios</button>
        <button type="button" class="btn btn-danger btnBorrarPermuta" data-dismiss="modal">Borrar permuta</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
       <?php

            $editarFecha = new ControladorPermutas();
            $editarFecha->ctrEditarFechaCubro();

          ?>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalFechasCubrir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Fechas cubrir</h3>


      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Fecha me cubren:</label>
             <input type="hidden" class="form-control" style="border-radius: 4px" readonly>
            <input type="text" class="form-control" id="fechaMeCubren" style="border-radius: 4px" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Fecha yo cubro:</label>
            <input type="text" class="form-control" id="fechaCubro" style="border-radius: 4px" readonly>
          </div>

        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnBorrarPermuta" data-dismiss="modal">Guardar fecha</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php



//   echo '<script>
//   $(document).ready(function(){
//   $("#calendarioPermutas").fullCalendar({

//     events: "ajax/permutas.ajax.php?buscarCalendario=true&numemp='.$_SESSION["numemp"].'",

//   });
// });
//   </script>';



?>
