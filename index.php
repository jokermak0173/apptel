<?php
  include "controladores/avisos.controlador.php";
  include "controladores/campanas.controlador.php";
  include "controladores/capacitadores.controlador.php";
  include "controladores/horario_checador.controlador.php";
  include "controladores/horario.controlador.php";
  include "controladores/niveles.controlador.php";
  include "controladores/permutas.controlador.php";
  include "controladores/plancarrera.controlador.php";
  include "controladores/plantilla.controlador.php";
  include "controladores/plazas.controlador.php";
  include "controladores/recomendados.controlador.php";
  include "controladores/supervisores.controlador.php";
  include "controladores/turnos.controlador.php";
  include "controladores/usuarios.controlador.php";

  include "modelos/avisos.modelo.php";
  include "modelos/campanas.modelo.php";
  include "modelos/capacitadores.modelo.php";
  include "modelos/horario_checador.modelo.php";
  include "modelos/horario.modelo.php";
  include "modelos/niveles.modelo.php";
  include "modelos/permutas.modelo.php";
  include "modelos/plancarrera.modelo.php";
  include "modelos/plantilla.modelo.php";
  include "modelos/plazas.modelo.php";
  include "modelos/recomendados.modelo.php";
  include "modelos/supervisores.modelo.php";
  include "modelos/turnos.modelo.php";
  include "modelos/usuarios.modelo.php";

  $plantilla = new ControladorPlantilla();
  $plantilla -> ctrPlantilla();

?>
