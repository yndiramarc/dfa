 <?php 
  // /**
  // *  Definición de la interfaz 'Sistema de Registro y Estadisticas de Participantes'.
  // *
  // *  Permite registrar, confirmar, listar, exportar e imprimir la entrada al evento de los participantes.
  // *
  // *  @author Jonatha Solorzano <jonathasolorzano@gmail.com>
  // *  @license http://www.gnu.org/licenses/gpl.html
  // *  GNU General Public License
  // *  @copyright Copyright (c) 2014, FUNDACITE Sucre
  // * 
  // *  @version 2015.04.27
  // */


  include("../fpdf17/rpdf.php");

  $pdf = new FPDF("L","mm","Letter");
  $pdf->SetAutoPageBreak(false);

  $cedula = $_GET["cedula"];
  $tipo_certificado = $_GET["tipo"];

  $conect = mysql_connect("localhost","root","852");

  mysql_select_db("registro-foro2",$conect);
  $sql = "SELECT * FROM registro2 WHERE cedula = '$cedula'";
  $result = mysql_query($sql);
  $return = mysql_fetch_array ($result);
  // print_r($return);exit;

  // Agregar Página
  $pdf->AddPage("L");
  
  // Agregar Imagen de Fondo
  // $pdf->Image("../img/certificado-ponente.png",5,5,280-10,216-10);
  if ($tipo_certificado == "ponente") {
    $pdf->Image("../img/certificado-ponente.png",5,5,280-10,216-10);
    // Sombra Nombre de la Ponencia
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('times','BI',18);
    $pdf->SetY(130.5);
    $pdf->SetX(9.7);
    $pdf->MultiCell(265,9,utf8_decode(mb_convert_case($return[7], MB_CASE_UPPER, "UTF-8")),'','C'); // Nombre de la Ponencia
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('times','BI',18);
    $pdf->SetY(130);
    $pdf->MultiCell(265,9,utf8_decode(mb_convert_case($return[7], MB_CASE_UPPER, "UTF-8")),'','C');
  }
   if ($tipo_certificado == "asistente") {
    $pdf->Image("../img/certificado-asistente.png",5,5,280-10,216-10);
  }
   if ($tipo_certificado == "comite") {
    $pdf->Image("../img/certificado-comite.png",5,5,280-10,216-10);
  }

  // // Encabezado del certificado
  // $pdf->SetFont('times','I',17);
  // $pdf->SetY(30);
  // $pdf->MultiCell(265,8,utf8_decode("La República Bolivariana de Venezuela a través del\nMinisterio del Poder Popular para la Educación Universitaria, Ciencia y Tecnología\notorga el presente Certificado a:"),'','C');

  // sombra Nombre del Ponente
  $pdf->SetTextColor(255,255,255);
  $pdf->SetFont('times','BI',36);
  $pdf->SetY(66.2);
  $pdf->SetX(9.4);
  $pdf->Cell(265,15,utf8_decode(mb_convert_case($return["nombres"] . ' ' . $return["apellidos"], MB_CASE_TITLE, "UTF-8")),0,'','C');
  // Nombre del Ponente
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('times','BI',36);
  $pdf->SetY(66);
  $pdf->Cell(265,15,utf8_decode(mb_convert_case($return["nombres"] . ' ' . $return["apellidos"], MB_CASE_TITLE, "UTF-8")),0,'','C');

  // Sombra Cédula del Ponente
  $pdf->SetTextColor(255,255,255);
  $pdf->SetFont('times','BI',20);
  $pdf->SetY(69.2+12);
  $pdf->SetX(9.4);
  $pdf->Cell(265,10,utf8_decode("C.I.: " . number_format($cedula,0,"",".")),0,'','C');

  // Cédula del Ponente
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('times','BI',20);
  $pdf->SetY(69+12);
  $pdf->Cell(265,10,utf8_decode("C.I.: " . number_format($cedula,0,"",".")),0,'','C');

  // // Area de tipo de certificado sombra
  // $pdf->SetFillColor(255,235,63,240);
  // $pdf->SetTextColor(255,235,63,240);
  // $pdf->SetFont('times','BI',17);
  // $pdf->SetY(120.2);
  // $pdf->SetX(9.4);
  // $pdf->Cell(265,5,utf8_decode("Por su asistencia al:"),'','','C');
  // // Area de tipo de certificado sobre
  // $pdf->SetFillColor(255,87,47,240);
  // $pdf->SetTextColor(255,87,47,240);
  // $pdf->SetFont('times','BI',17);
  // $pdf->SetY(120);
  // $pdf->Cell(265,5,utf8_decode("Por su asistencia al:"),'','','C');

  // // Nombre del foro
  // $pdf->SetFillColor(0 ,0,0);
  // $pdf->SetTextColor(0,0,0);
  // $pdf->SetFont('times','B',22);
  // $pdf->SetY(125);
  // $pdf->Cell(265,20,utf8_decode("II Foro-Taller de Acuicultura del Estado Sucre, Cumaná 500 Años"),0,'','C');

  // Area de Firmas

  // Fuentes y tamaño de las Firmas
  $pdf->SetFont('times','B',12);
  $pdf->SetFillColor(0 ,0,0);
  $pdf->SetTextColor(0,0,0);

  // Primera Firma
  $pdf->SetXY(30,170);
  $pdf->MultiCell(45,5,utf8_decode("Soc. Enrique Ortiz\nPresidente\nFUNDACITE SUCRE"),"T","C");

  // Segunda Firma
  $pdf->SetXY(30+56,170);
  $pdf->MultiCell(45,5,utf8_decode(mb_convert_case("Ing. Angel Centeno\nDirector", MB_CASE_TITLE, "UTF-8")."\nINIA-SUCRE"),"T","C");

  // Tercera Firma
  $pdf->SetXY(150,170);
  $pdf->MultiCell(45,5,utf8_decode("Lic. Deinnys Quijada\nSub-Gerente\nINSOPESCA-SUCRE"),"T","C");

  // Cuarta Firma
  $pdf->SetXY(150+56,170);
  $pdf->MultiCell(45,5,utf8_decode(mb_convert_case("MSc. Elvis Villarroel\nPresidente", MB_CASE_TITLE, "UTF-8")."\nFIDAES"),"T","C");

  // Impresión del Certificado
  $pdf->Output();

 ?>