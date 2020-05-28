<?php
 	// /**
	// *  Definición de la interfaz 'Sistema de Registro2 y Estadisticas de Participantes'.
	// *
	// *  Permite registrar, confirmar, listar, exportar e imprimir la entrada al evento de los participantes.
	// *
	// *  @author Jonatha Solorzano <jonathasolorzano@gmail.com>
	// *  @license http://www.gnu.org/licenses/gpl.html
	// *	 GNU General Public License
	// *  @copyright Copyright (c) 2014, FUNDACITE Sucre
 	// *  @version 2015.04.27
	// * 
	// **/

	$action = $_REQUEST["action"];
	$params = $_POST;
	$estadistica = array();

	switch ($action) {
		case 'guardar':
			$cedula = $_POST["cedula"];
			$nombres = $_POST["nombres"];
			$apellidos = $_POST["apellidos"];
			$tipo_asistente = $_POST["tipo_asistente"];
			$asistencia = $_POST["asistencia"];
			$com_institucion = $_POST["com_institucion"];
			$ponencia = $_POST["ponencia"];
			$correo = $_POST["correo"];

			$conect = mysql_connect("localhost","root","852");

			mysql_select_db("registro-foro2",$conect);

			$sql = "INSERT INTO registro2 (cedula, nombres, apellidos, tipo_asistente, asistencia, com_institucion, ponencia, correo, dias) values ('$cedula', '$nombres', '$apellidos', '$tipo_asistente', '$asistencia', '$com_institucion', '$ponencia', '$correo', 'I')";
			$result = mysql_query($sql);

			if(!$result){                    
				print '{"success": false, "message": "Error al guardar los datos."}';
				return;
			}
			print '{"success": true, "message": "Registro guardado con éxito."}';
		break;

	case 'certificados_ponentes':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT cedula, nombres, apellidos FROM registro2 WHERE asistencia = 'Pescador'";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'certificados_participantes':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT cedula, nombres, apellidos, dias FROM registro2 WHERE asistencia = 'Participante'";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'certificados_comite':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT cedula, nombres, apellidos, asistencia, com_institucion FROM registro2 WHERE asistencia  IN ('Organizador' ,'Logistica')";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'listar_ponentes':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT * FROM registro2 WHERE asistencia = 'Pescador'";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'listar_participantes':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT * FROM registro2 WHERE asistencia <> 'Pescador'";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'listar_comite':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT cedula, nombres, apellidos, asistencia, com_institucion, correo FROM registro2 WHERE asistencia  IN ('Organizador' ,'Logistica')";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'listar_todos':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql = "SELECT * FROM registro";
		$result = mysql_query($sql);
		$array_result = array();
		while ($row = mysql_fetch_array ($result)) {
			$array_result[] = $row;
		}
		print json_encode($array_result);
		break;

	case 'est':
		$conect = mysql_connect("localhost","root","852");

		mysql_select_db("registro-foro2",$conect);

		$sql1 = "SELECT COUNT(*) FROM registro2 WHERE tipo_asistente = 'Pescador'";
		$result1 = mysql_query($sql1);
		$numfilas1 = mysql_fetch_array($result1)[0];

		$sql2 = "SELECT COUNT(*) FROM registro2 WHERE tipo_asistente = 'Funcionario Publico'";
		$result2 = mysql_query($sql2);
		$numfilas2 = mysql_fetch_array($result2)[0];

		$sql3 = "SELECT COUNT(*) FROM registro2 WHERE tipo_asistente = 'Funcionario Privado'";
		$result3 = mysql_query($sql3);
		$numfilas3 = mysql_fetch_array($result3)[0];

		$sql4 = "SELECT COUNT(*) FROM registro2 WHERE tipo_asistente = 'Comunidad'";
		$result4 = mysql_query($sql4);
		$numfilas4 = mysql_fetch_array($result4)[0];

		$sql6 = "SELECT COUNT(*) FROM registro2 WHERE `tipo_asistente` IN ('Pescador' ,'Funcionario Publico','Funcionario Privado','Comunidad')";
		$result6 = mysql_query($sql6);
		$numfilas6 = mysql_fetch_array($result6)[0];

		$estadistica = [$numfilas1, $numfilas2, $numfilas3, $numfilas4, $numfilas5, $numfilas6];

		print json_encode($estadistica);
		break;
		
		/*default:
			# code...
		break;*/
	}
?>