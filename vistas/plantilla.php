<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mi Atel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="vistas/img/plantilla/iconoAtel.ico">

  <!--====================================
  =            PLUGINS DE CSS            =
  =====================================-->



  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vistas/dist/css/skins/skin-blue.css">

  <!-- JQUERY UI -->
  <link rel="stylesheet" href="vistas/plugins/jQueryUI/jquery-ui.css">

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

  <link rel="stylesheet" href="vistas/css/estilos.css">
  <link rel="stylesheet" href="vistas/css/reloj.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

  <!-- CLOCK-PICKER -->
  <link rel="stylesheet" href="vistas/plugins/clockpicker/bootstrap-clockpicker.css ">

  <!-- PASSWORD CHECK STRONG -->
  <link rel="stylesheet" href="vistas/plugins/password_strength-master/css/strength.css">

  <!-- date range picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">

  <!-- alertify -->
  <link rel="stylesheet" href="vistas/plugins/alertifyjs/css/alertify.min.css">

  <link rel="stylesheet" href="vistas/plugins/alertifyjs/css/themes/bootstrap.min.css">
  <link rel="stylesheet" href="vistas/plugins/datepicker/jquery-ui.min.css">



  <!--=====================================
  =            PLUGINS JAVASCRIPT          =
  ======================================-->
  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI -->
  <!-- <script src="vistas/plugins/jQueryUI/jquery-ui.js"></script> -->
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <!-- <script src="vistas/dist/js/adminlte.min.js"></script> -->
  <!-- AdminLTE for demo purposes -->

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- fullCalendar -->
  <script src="vistas/bower_components/moment/moment.js"></script>
  <script src="vistas/bower_components/fullcalendar/dist/fullcalendar.js"></script>
  <script src="vistas/bower_components/fullcalendar/dist/es.js"></script>

  <!-- BOOTSTRAP FULLCALENDAR -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->

  <!-- SWEET ALERT 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- CLOCK-PICKER -->
  <script src="vistas/plugins/clockpicker/bootstrap-clockpicker.js"></script>

  <!-- PASSWORD CHECK STRONG -->
  <script src="vistas/plugins/password_strength-master/js/password_strength.js"></script>
  <script src="vistas/plugins/password_strength-master/js/jquery-strength.js"></script>

  <!-- CRYPTO JS FOR HASH IN MD5  -->
  <script src="vistas/plugins/crypto-js/crypto.min.js"></script>

  <!-- By default SweetAlert doesnt support IE. To enable IE 11 support, include Promise polyfill -->
  <script src="vistas/plugins/IE_Polyfill/core.js"></script>

  <!-- DATE RANGE PICKER -->
  <script src="vistas/plugins/daterangepicker/moment.min.js"></script>
  <script src="vistas/plugins/daterangepicker/daterangepicker.min.js"></script>

  <!-- alertify -->
  <script src="vistas/plugins/alertifyjs/alertify.min.js"></script>

  <script src="vistas/plugins/datepicker/jquery-ui.min.js"></script>


  <!-- Firebase App is always required and must be first -->
<!-- <script src="https://www.gstatic.com/firebasejs/5.8.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-messaging.js"></script>
<script>
   var config = {
      apiKey: "AIzaSyDWznsuU6Rk5hLqSP4vjrBTUp9Nwtrvhnc",
      authDomain: "mi-atel.firebaseapp.com",
      databaseURL: "https://mi-atel.firebaseio.com",
      projectId: "mi-atel",
      storageBucket: "mi-atel.appspot.com",
      messagingSenderId: "470216310153"
    };
    firebase.initializeApp(config);

    const messaging = firebase.messaging();
    messaging.requestPermission()
    .then(function(){
      console.log('Have permission');
    })
    .catch(function(err){
      console.log('Error Occured.')
    })
</script> -->

<script>

  function cargarHorario(numemp){


          var datos = new FormData();
          datos.append("numemp", numemp);
          datos.append("buscarAsistencias", true);
          $.ajax({
            url:"ajax/horarioChecador.ajax.php",
            method: "post",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

              for(var i = 0; i < respuesta.length; i++)
              {
                  var calificacion = respuesta[i]["calificacion"].toUpperCase();
                  calificacion = calificacion.trim();
                  switch(calificacion){

                      case 'A' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#298A08'); break;
                      case 'AA' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#00FF00'); break;
                      case 'D' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#F7BE81'); break;
                      case 'DD' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#0040FF'); break;
                      case 'PE' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#8904B1'); break;
                      case 'R' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', 'yellow'); break;
                      case 'RA' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#DBA901'); break;
                      case 'FI' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', 'red'); break;
                      case 'FJ' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#FE2EC8'); break;
                      case 'P' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#6E6E6E'); break;
                      case 'I' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#B12323'); break;
                      case 'V' : $('td[data-date='+ respuesta[i]["fecha"]+']').css('background-color', '#04E3D0'); break;

                  }
              }
            }
          });


    }
</script>
</head>

<!--======================================
=            CUERPO DOCUMENTO            =
=======================================-->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->


  <?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && isset($_SESSION["nivelAcceso"]))
    {
      echo '<div class="wrapper">';
      /* HEADER */
      include "modulos/header.php";


      if($_SESSION["nivelAcceso"] == 5)
      {
         include "modulos/menu_asesor.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){

              if($_GET["ruta"] == "avisos" ||
                 $_GET["ruta"] == "horario" ||
                 $_GET["ruta"] == "crear-permuta" ||
                 $_GET["ruta"] == "ver-permutas" ||
                 $_GET["ruta"] == "mis-permutas" ||
                 $_GET["ruta"] == "plancarrera" ||
                 $_GET["ruta"] == "recomienda" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/avisos.php";
          }
      }

      if($_SESSION["nivelAcceso"] == 1)
      {
         include "modulos/menu_sistemas.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){
              if($_GET["ruta"] == "usuariosSistemas" ||
                $_GET["ruta"] == "horario" ||
                $_GET["ruta"] == "asesoresNominas" ||
                $_GET["ruta"] == "avisosRecrea" ||
                $_GET["ruta"] == "campanas" ||
                $_GET["ruta"] == "supervisores" ||
                $_GET["ruta"] == "capacitadores" ||
                  $_GET["ruta"] == "turnos" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/usuariosSistemas.php";
          }
      }

      if($_SESSION["nivelAcceso"] == 2)
      {
         include "modulos/menu_calidad.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){

            if(
                $_GET["ruta"] == "avisos" ||
                $_GET["ruta"] == "horario" ||
                $_GET["ruta"] == "reportesCalidad" ||
                $_GET["ruta"] == "recomienda" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/menu_asesor.php";
          }
      }

      if($_SESSION["nivelAcceso"] == 3)
      {
         include "modulos/menu_recrea.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){
              if($_GET["ruta"] == "avisos" ||
                $_GET["ruta"] == "avisosRecrea" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/menu_asesor.php";
          }
      }

      if($_SESSION["nivelAcceso"] == 6)
      {
         include "modulos/menu_reclutamiento.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){
              if($_GET["ruta"] == "avisos" ||
                $_GET["ruta"] == "avisosRecrea" ||
                $_GET["ruta"] == "recomendados" ||
                $_GET["ruta"] == "citadosEntrevista" ||
                $_GET["ruta"] == "citadosCurso" ||
                $_GET["ruta"] == "enCurso" ||
                $_GET["ruta"] == "certificados" ||
                $_GET["ruta"] == "recomendadosPendientes" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/menu_asesor.php";
          }
      }

      if($_SESSION["nivelAcceso"] == 7)
      {
         include "modulos/menu_director.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){
              if($_GET["ruta"] == "avisosVallarta" ||
                $_GET["ruta"] == "avisosConcentro" ||
                 $_GET["ruta"] == "avisosDurango" ||

                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/menu_director.php";
          }
      }




      if($_SESSION["nivelAcceso"] == 4)
      {
         include "modulos/menu_administrativo.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){
              if($_GET["ruta"] == "avisos" ||
                $_GET["ruta"] == "horario" ||
                $_GET["ruta"] == "checador" ||
                $_GET["ruta"] == "asesoresNominas" ||
                $_GET["ruta"] == "permutasAdministrativo" ||
                $_GET["ruta"] == "permutasAutorizadas" ||
                $_GET["ruta"] == "supervisores" ||
                $_GET["ruta"] == "campanasNominas" ||
                $_GET["ruta"] == "turnosNominas" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/asesoresAdministrativo.php";
              }
          }else{
            include "modulos/menu_asesor.php";
          }
      }

      if($_SESSION["nivelAcceso"] == 999)
      {
         include "modulos/menu_root.php";

         /* CONTENIDO */
         if(isset($_GET["ruta"])){
              if($_GET["ruta"] == "usuariosRoot" ||
                $_GET["ruta"] == "plazasRoot" ||
                $_GET["ruta"] == "salir" ){
                include "modulos/".$_GET["ruta"].".php";
              }else{
                include "modulos/404.php";
              }
          }else{
            include "modulos/usuariosRoot.php";
          }
      }

      /* MENU */


      // FOOTER
      include "modulos/footer.php";

      echo '</div>';
    }
  else{
      include "modulos/login.php";
    }

  ?>




<script type="text/javascript" src="vistas/js/asesores.js"></script>
<script type="text/javascript" src="vistas/js/checador.js"></script>
<script type="text/javascript" src="vistas/js/usuariosSistemas.js"></script>
<script type="text/javascript" src="vistas/js/campanas.js"></script>
<script type="text/javascript" src="vistas/js/supervisores.js"></script>
<script type="text/javascript" src="vistas/js/capacitadores.js"></script>
<script type="text/javascript" src="vistas/js/turnos.js"></script>
<script type="text/javascript" src="vistas/js/horario.js"></script>
<script type="text/javascript" src="vistas/js/crear-permuta.js"></script>
<script type="text/javascript" src="vistas/js/ver-permutas.js"></script>
<script type="text/javascript" src="vistas/js/permutasAdministrativo.js"></script>
<script type="text/javascript" src="vistas/js/plazas.js"></script>
<script type="text/javascript" src="vistas/js/avisosRecrea.js"></script>
<script type="text/javascript" src="vistas/js/recomienda.js"></script>
<script type="text/javascript" src="vistas/js/recomendados.js"></script>



</body>
</html>
