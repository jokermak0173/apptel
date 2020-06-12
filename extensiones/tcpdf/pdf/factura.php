<?php

require_once "../../../controladores/campanas.controlador.php";
require_once "../../../modelos/campanas.modelo.php";

require_once "../../../controladores/permutas.controlador.php";
require_once "../../../modelos/permutas.modelo.php";

require_once "../../../controladores/plazas.controlador.php";
require_once "../../../modelos/plazas.modelo.php";

require_once "../../../controladores/turnos.controlador.php";
require_once "../../../modelos/turnos.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/supervisores.controlador.php";
require_once "../../../modelos/supervisores.modelo.php";
class imprimirPermuta{

public $idPermuta;
public function traerImpresionPermuta(){

$item = "id";
$valor = $this->idPermuta;
$infoPermuta = ControladorPermutas::ctrMostrarPermutaPorId($item, $valor);

$item = "id";
$valor = $infoPermuta["plaza"];
$infoPlaza = ControladorPlazas::ctrMostrarPlaza($item, $valor);

$item = "numemp";
$valor = $infoPermuta["asesor_solicita"];
$infoUsuarioSolicita = ControladorUsuarios::ctrMostrarAsesorPorId($item, $valor);

$item = "id";
$valor = $infoUsuarioSolicita["turno"];
$infoTurnoSolicita = ControladorTurnos::ctrMostrarTurno($item, $valor);

$item = "id";
$valor = $infoUsuarioSolicita["campana"];
$infoCampañaSolicita = ControladorCampañas::ctrMostrarCampaña($item, $valor);

$item = "numemp";
$valor = $infoPermuta["asesor_acepta"];
$infoUsuarioAcepta = ControladorUsuarios::ctrMostrarAsesorPorId($item, $valor);

$item = "id";
$valor = $infoUsuarioAcepta["turno"];
$infoTurnoAcepta = ControladorTurnos::ctrMostrarTurno($item, $valor);

$item = "id";
$valor = $infoUsuarioAcepta["campana"];
$infoCampañaAcepta = ControladorCampañas::ctrMostrarCampaña($item, $valor);


// REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();
$pdf->AddPage();

// ----------------------------------------------------------------------------------------------------
$bloque1 = <<<EOF
	<br><br>
	<table>
		<tr>
			<td style="width:150px"><img src="images/atel.png"></td>

			<td style="background-color:white; width:220px; text-align:center">
				<br><br>
				<h2>FORMATO PERMUTAS</h2>
			</td>
			
			<td style="background-color:white; width:110px; text-align:center; color:red">
				<br><br>
				PERMUTA NO. <br> $this->idPermuta
			</td>
		</tr>
	</table>
	
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ----------------------------------------------------------------------------------------------------
switch ($infoPermuta["tipo_permuta"]) {
	case 1:
		$tipo_permuta2 = "Dia x dia"; break;
	case 2:
		$tipo_permuta2 = "Permuta libre"; break;
	case 3:
		$tipo_permuta2 = "Cambio turno"; break;
	
	default:
		# code...
		break;
}
$bloque2 = <<<EOF
	
	<table>

		<tr>

			<td style="width:540px"><img src="images/back.jpg" alt=""></td>

		</tr>

	</table>
	
	<table style="font-size:10px; padding:5px 10px;">
		<tr>

			<td style="border: 1px solid #666; background-color:white; width:150px">

				<b>Tipo Permuta</b>: $tipo_permuta2

			</td>

			<td style="border: 1px solid #666; background-color: white; width:150px">
				<b>Fecha Permuta</b>: $infoPermuta[fecha_solicita]
			</td>
			<td style="border: 1px solid #666; background-color: white; width:200px">
				<b>Plaza</b>: $infoPlaza[nombre]
			</td>
		</tr>

	
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ----------------------------------------------------------------------------------------------------

$bloque3 = <<<EOF
	<br><br>
	Solicita
	<br>
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center"><b>Asesor</b></td>
			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center"><b>Supervisor</b></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Turno</b></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Campaña</b></td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:160px">$infoUsuarioSolicita[apellido_paterno] $infoUsuarioSolicita[apellido_materno] $infoUsuarioSolicita[nombres]</td>
			<td style="border: 1px solid #666; background-color:white; width:160px">$infoPermuta[supervisor_acepta]</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			$infoTurnoAcepta[horario_entrada] - $infoTurnoAcepta[horario_salida]</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$infoCampañaAcepta[campana]</td>
		</tr>
		
	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


// ----------------------------------------------------------------------------------------------------

$bloque4 = <<<EOF
	<br><br>
	Acepta
	<br>
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center"><b>Asesor</b></td>
			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center"><b>Supervisor</b></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Turno</b></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Campaña</b></td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:160px">$infoUsuarioAcepta[apellido_paterno] $infoUsuarioAcepta[apellido_materno] $infoUsuarioAcepta[nombres]</td>
			<td style="border: 1px solid #666; background-color:white; width:160px">$infoPermuta[supervisor_solicita]</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			$infoTurnoSolicita[horario_entrada] - $infoTurnoSolicita[horario_salida]</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">$infoCampañaSolicita[campana]</td>
		</tr>
		
	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

// ----------------------------------------------------------------------------------------------------
	


$bloque5 = <<<EOF
		
		<br><br><br><br><br><br><br><br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		
		_______________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
		_______________________
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma solicita&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma acepta

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ----------------------------------------------------------------------------------------------------

// $bloque5 = <<<EOF

// 	<table style="font-size:10px; padding:5px 10px;">

// 		<tr>
// 			<td style="color: #333; background-color:white; width:340px; text-align:center"></td>
// 			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>
// 			<td style="border-bottom: 1px solid #666; color: #333; background-color:white; width:100px; text-align:center"></td>

// 		</tr>

// 		<tr>
// 			<td style="border-right: 1px solid #666; color: #333; background-color:white; width:340px; text-align:center"></td>
// 			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
// 				Neto:
// 			</td>

// 			<td style="border: 1px solid #666; color: #333; background-color:white; width:100px; text-align:center">
// 				$ $neto
// 			</td>
// 		</tr>

// 		<tr>
			
// 			<td style="border-right: 1px solid #666; color: #333; background-color:white; width:340px; text-align:center"></td>
// 			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
// 				Impuesto:
// 			</td>

// 			<td style="border: 1px solid #666; color: #333; background-color:white; width:100px; text-align:center">
// 				$ $impuesto
// 			</td>

// 		</tr>

// 		<tr>
			
// 			<td style="border-right: 1px solid #666; color: #333; background-color:white; width:340px; text-align:center"></td>
// 			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
// 				<b>Total</b>:
// 			</td>

// 			<td style="border: 1px solid #666; color: #333; background-color:white; width:100px; text-align:center">
// 				$ $total
// 			</td>

// 		</tr>

// 	</table>

// EOF;

// $pdf->writeHTML($bloque5, false, false, false, false, '');

// }

// $pdf->Output('factura.pdf');

$pdf->Output('factura.pdf');
 }
}
$factura = new imprimirPermuta();
$factura -> idPermuta = $_GET["idPermuta"]; 
$factura -> traerImpresionPermuta();
?>