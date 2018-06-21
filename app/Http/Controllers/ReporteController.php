<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cotizacion;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReporteController extends Controller
{
    public function __construct() {
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);           
    }

    public function listado_miembros() {

        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->latest()->paginate(10);        

        return view('backend.reportes.listado_miembros')->with(['users' => $users]);
    }

    public function planilla_solicitud() {

        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->latest()->paginate(10);        

        return view('backend.reportes.planilla_solicitud')->with(['users' => $users]);
    }

    public function planilla_solicitud_word($id) {

        $user = User::find($id);
        $ips = '';
        foreach ($user->ips as $key => $ip) {
            $coma = $user->ips->count() != $key + 1 ? ', ' : '';
            $ips .= $ip->nombre.$coma;
        }

        $wordTest = new \PhpOffice\PhpWord\PhpWord(); 
        $wordTest->setDefaultFontName('Times New Roman');
        $wordTest->setDefaultFontSize(11);

        //sections
        $mainSection = $wordTest->addSection();

        //content
        $titleText = "UNION DE INFORMÁTICOS DE CUBA <w:br />";  
        $subTitleText = "Planilla de Solicitud de Ingreso a la Unión de Informáticos de Cuba <w:br />";

        //styles
        $wordTest->addFontStyle('titleFStyle', array('size' => 14, 'bold' => true, 'italic' => true));
        $wordTest->addParagraphStyle('titlePStyle', array('align'=>'center'));
        $wordTest->addFontStyle('h3Style', array('bold' => true));

        $wordTest->setDefaultParagraphStyle(
            array(
                'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
                'spacing' => 120,
                'lineHeight' => 1.2,
            )
            );
        
        $mainSection->addText($titleText, 'titleFStyle', 'titlePStyle');
        $mainSection->addText($subTitleText, array('size' => 14, 'bold' => true));

        $mainSection->addText('Datos Personales:', 'h3Style');
        $mainSection->addText('Nombre y Apellidos: '.ucwords($user->nombre_completo));
        $mainSection->addText('Sexo: '.ucwords($user->sexo));
        $mainSection->addText('Fecha de nacimiento: '.$user->fecha_nacimiento->formatLocalized('%A %d %B %Y'));
        $mainSection->addText('Número de Carné de Identidad: '.$user->ci);
        $mainSection->addText('Dirección Particular: '.$user->direccion_particular);
        $mainSection->addText('Provincia: '.$user->provincia.'              '.'Municipio: '.$user->municipio);
        $mainSection->addText('Teléfono: '.$user->telefono_personal.'                     '.'Correo electrónico: '.$user->email.'<w:br />');

        $mainSection->addText('Datos Profesionales:', 'h3Style');
        $mainSection->addText('Titulo obtenido: '.$user->titulo_profesional);
        $mainSection->addText('Universidad: '.$user->universidad);
        $mainSection->addText('Año de graduado: '.$user->ano_graduado.'<w:br />');

        $mainSection->addText('Integración Política:', 'h3Style');
        $mainSection->addText($ips.'<w:br />');

        $mainSection->addText('Datos Laborales:', 'h3Style');
        $mainSection->addText('Centro de trabajo actual (si es Jubilado, trabajador no estatal, o no trabaja, consígnelo así y señale último Centro de Trabajo):');
        $mainSection->addText('Centro de trabajo: '.$user->centro_trabajo);
        $mainSection->addText('Dirección: '.$user->direccion_laboral);
        $mainSection->addText('Provincia: '.$user->provincia_laboral.'              '.'Municipio: '.$user->municipio_laboral);
        $mainSection->addText('Teléfono: '.$user->telefono_laboral.'                     '.'Correo electrónico: '.$user->correo_laboral);
        $mainSection->addText('Cargo que ocupa: '.$user->cargo_laboral.'<w:br />');

        $mainSection->addText('Ciudad de_______________Municipio______________Provincia_______________');
        $mainSection->addText('Día_______________Mes______________Año_______________'.'<w:br />');
        $mainSection->addText('Firma del Solicitante<w:br />');

        $mainSection->addText('NOTA:  Deben anexar a la planilla de solicitud el curriculum vitae.');
        $mainSection->addText('Para ser llenado por la Junta Directiva Provincia (JDP) o la Junta Directiva Nacional (JDN) según el caso.');
        $mainSection->addText('___________________________________________________________________________');

        $mainSection->addText('Fecha de la reunión de la JDP en que se aprueba la solicitud: día___mes_____ año_____', 'h3Style');
        $mainSection->addText('No. del acuerdo:________________ Aprobado:  SI_____ NO______ ', 'h3Style');
        $mainSection->addText('(En caso de no aprobación se adjuntará  un documento fundamentando las causas)<w:br />');

        $mainSection->addText('Firma del presidente de la JDP y cuño.');


    
        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
        try {
            $objectWriter->save(storage_path('Planilla de solicitud de ingreso a UIC.docx'));
        } catch (Exception $e) {
        }
    
        return response()->download(storage_path('Planilla de solicitud de ingreso a UIC.docx'));
    }

    public function listado_miembros_excel() {        
        $users = User::orderBy('organismo_id', 'ASC')->where('rol', '!=', 'admin')->where('activo', true)->get(); 

        $users_count = $users->count();
        $max_rows = $users_count + 5;  
        $total_row = $max_rows + 2;
        $arrayCell = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];

        $spreadsheet = new Spreadsheet();
        // styles
        $styleTitle = [
            'font' => [
                'bold' => true,
            ]            
        ];
        $secondaryTitle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
            ],
            'font' => [
                'bold' => true,
            ]            
        ];   
        $content = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
            ]          
        ];                   
        //end styles

        // apply styles
        $spreadsheet->getActiveSheet()->getStyle('C4:AE4')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('D9D9D9');  
        $spreadsheet->getActiveSheet()->getStyle('B5:AE5')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('F2F2F2');
        $spreadsheet->getActiveSheet()->getStyle('C4:AE5')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('B6:B'.$max_rows)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);        

        $spreadsheet->getActiveSheet()->getStyle('B2')->applyFromArray($styleTitle);
        $spreadsheet->getActiveSheet()->getStyle('C4:K4')->applyFromArray($secondaryTitle);
        $spreadsheet->getActiveSheet()->getStyle('L4:N4')->applyFromArray($secondaryTitle);
        $spreadsheet->getActiveSheet()->getStyle('O4:X4')->applyFromArray($secondaryTitle);
        $spreadsheet->getActiveSheet()->getStyle('Y4:AE4')->applyFromArray($secondaryTitle);
        $spreadsheet->getActiveSheet()->getStyle('B5:AE5')->applyFromArray($secondaryTitle);
        $spreadsheet->getActiveSheet()->getStyle('B6:AE'.$max_rows)->applyFromArray($content);
        $spreadsheet->getActiveSheet()->getStyle('B'.$total_row)->applyFromArray($styleTitle);
        $spreadsheet->getActiveSheet()->getStyle('B6:B'.$max_rows)->applyFromArray($styleTitle);

        $spreadsheet->getActiveSheet()->mergeCells('C4:K4');
        $spreadsheet->getActiveSheet()->mergeCells('L4:N4');
        $spreadsheet->getActiveSheet()->mergeCells('O4:X4');
        $spreadsheet->getActiveSheet()->mergeCells('Y4:AE4');        

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        for ($i=1; $i < count($arrayCell); $i++) { 
            $spreadsheet->getActiveSheet()->getColumnDimension($arrayCell[$i])->setAutoSize(true);
        }
        // end apply styles 

        $spreadsheet->getActiveSheet()->setCellValue('B2', 'LISTADO DE MIEMBROS DE LA UIC - PROVINCIA PINAR DEL RIO');

        $spreadsheet->getActiveSheet()->setCellValue('C4', 'DATOS PERSONALES');
        $spreadsheet->getActiveSheet()->setCellValue('L4', 'DATOS PROFESIONALES');
        $spreadsheet->getActiveSheet()->setCellValue('O4', 'INTEGRACION POLITICA');        
        $spreadsheet->getActiveSheet()->setCellValue('Y4', 'DATOS LABORALES');

        $spreadsheet->getActiveSheet()->setCellValue('B5', 'Organismo');
        $spreadsheet->getActiveSheet()->setCellValue('C5', 'Nombre y apellidos');
        $spreadsheet->getActiveSheet()->setCellValue('D5', 'Sexo');
        $spreadsheet->getActiveSheet()->setCellValue('E5', 'No. CI');
        $spreadsheet->getActiveSheet()->setCellValue('F5', 'Fecha Nac.');
        $spreadsheet->getActiveSheet()->setCellValue('G5', 'Dir. Particular');
        $spreadsheet->getActiveSheet()->setCellValue('H5', 'Provincia');
        $spreadsheet->getActiveSheet()->setCellValue('I5', 'Municipio');
        $spreadsheet->getActiveSheet()->setCellValue('J5', 'Telefono');
        $spreadsheet->getActiveSheet()->setCellValue('K5', 'Correo');
        $spreadsheet->getActiveSheet()->setCellValue('L5', 'Titulo');
        $spreadsheet->getActiveSheet()->setCellValue('M5', 'Universidad');
        $spreadsheet->getActiveSheet()->setCellValue('N5', 'Año');
        $spreadsheet->getActiveSheet()->setCellValue('O5', 'PCC');
        $spreadsheet->getActiveSheet()->setCellValue('P5', 'UJC');
        $spreadsheet->getActiveSheet()->setCellValue('Q5', 'CDR');
        $spreadsheet->getActiveSheet()->setCellValue('R5', 'FMC');
        $spreadsheet->getActiveSheet()->setCellValue('S5', 'CTC');
        $spreadsheet->getActiveSheet()->setCellValue('T5', 'DC');
        $spreadsheet->getActiveSheet()->setCellValue('U5', 'UM');
        $spreadsheet->getActiveSheet()->setCellValue('V5', 'MTT');
        $spreadsheet->getActiveSheet()->setCellValue('W5', 'BPD');
        $spreadsheet->getActiveSheet()->setCellValue('X5', 'ACRC');
        $spreadsheet->getActiveSheet()->setCellValue('Y5', 'Centro Trabajo');
        $spreadsheet->getActiveSheet()->setCellValue('Z5', 'Direccion');
        $spreadsheet->getActiveSheet()->setCellValue('AA5', 'Provincia');
        $spreadsheet->getActiveSheet()->setCellValue('AB5', 'Municipio');
        $spreadsheet->getActiveSheet()->setCellValue('AC5', 'Telefono');
        $spreadsheet->getActiveSheet()->setCellValue('AD5', 'Correo');
        $spreadsheet->getActiveSheet()->setCellValue('AE5', 'Cargo');

        $spreadsheet->getActiveSheet()->setCellValue('B'.$total_row, 'TOTAL: '.$users_count);

        $prev_value = null;
        $count = 0;
        foreach ($users as $key => $user) {
            $date = strtotime($user->fecha_nacimiento);
            $fecha_nacimiento = date('d/m/Y',$date);
            $sexo = $user['sexo'] == 'masculino' ? 'M' : 'F';  

            $PCC = '';
            $UJC = '';
            $CDR = '';
            $FMC = '';
            $CTC = '';
            $DC = '';
            $UM = '';
            $MTT = '';
            $BPD = '';
            $ACRC = '';

            foreach ($user->ips as $key1 => $ip) {
                if ($ip->nombre == 'PCC') {
                    $PCC = 'X';
                }
                if ($ip->nombre == 'UJC') {
                    $UJC = 'X';
                }
                if ($ip->nombre == 'CDR') {
                    $CDR = 'X';
                }
                if ($ip->nombre == 'FMC') {
                    $FMC = 'X';
                }
                if ($ip->nombre == 'CTC') {
                    $CTC = 'X';
                }
                if ($ip->nombre == 'DC') {
                    $DC = 'X';
                }
                if ($ip->nombre == 'UM') {
                    $UM = 'X';
                }
                if ($ip->nombre == 'MTT') {
                    $MTT = 'X';
                }
                if ($ip->nombre == 'BPD') {
                    $BPD = 'X';
                }
                if ($ip->nombre == 'ACRC') {
                    $ACRC = 'X';
                }
            }
            $row = 6 + $key;
            $users_by_org = User::where('organismo_id', $user->organismo->id)->get();  
            //here
            $organismo = '';
            if ($user->organismo->nombre == $prev_value) {
                $count ++;
            } else {
                $spreadsheet->getActiveSheet()->mergeCells('B'.($row - ($count + 1)).':B'.($row - 1));
                $count = 0;
                $organismo = $user->organismo->nombre.' ('.$users_by_org->count().')';
            }            

            $user_array = [
                $organismo,
                $user->nombre_completo,
                $sexo,
                $user->ci,
                $fecha_nacimiento,
                $user->direccion_particular,
                $user->provincia,
                $user->municipio,
                $user->telefono_personal,
                $user->email,
                $user->titulo_profesional,
                $user->universidad,
                $user->ano_graduado,
                $PCC,
                $UJC,
                $CDR,
                $FMC,
                $CTC,
                $DC,
                $UM,
                $MTT,
                $BPD,
                $ACRC,
                $user->centro_trabajo,
                $user->direccion_laboral,
                $user->provincia_laboral,
                $user->municipio_laboral,
                $user->telefono_laboral,
                $user->correo_laboral,
                $user->cargo_laboral
            ];

            $prev_value = $user->organismo->nombre;

            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $user_array,   
                    NULL,        
                    'B'.$row    
                );
        }

        //here
        if ($users->count() == $count + 1) {
            $spreadsheet->getActiveSheet()->mergeCells('B6:B'.($count + 6));
        }

        $writer = new Xlsx($spreadsheet);        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. 'Listado de miembros UIC' .'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }   

    public function listado_cotizaciones() {

        $now = Carbon::now();
        $current_year = $now->format('Y');
        $current_month = $now->format('m');

        $array = range(2018, $current_year);

        $years = array_reverse($array);
        $months = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];

        return view('backend.reportes.listado_cotizaciones')->with(['years' => $years, 'months' => $months]);
    }

    public function listado_cotizaciones_excel(Request $request) {

        $arrayCell = ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];
        $users = User::where('rol', '!=', 'admin')
                      ->where('activo', true)->get();
        $year = $request->year;
        $month = $request->month;
        $months = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];
        $users_count = $users->count();
        $max_rows = $users_count + 4;  

        $spreadsheet = new Spreadsheet();
        // styles
        $styleTitle = [
            'font' => [
                'bold' => true,
            ]            
        ];
        $secondaryTitle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
            ],
            'font' => [
                'bold' => true,
            ]            
        ];   
        $content = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
            ]          
        ];                   
        //end styles

        //apply styles
        $spreadsheet->getActiveSheet()->getStyle('B2')->applyFromArray($styleTitle);
        $spreadsheet->getActiveSheet()->getStyle('B4:F4')->applyFromArray($secondaryTitle);
        $spreadsheet->getActiveSheet()->getStyle('B5:F'.$max_rows)->applyFromArray($content);
        $spreadsheet->getActiveSheet()->mergeCells('B2:D2');

        for ($i=0; $i < count($arrayCell); $i++) { 
            $spreadsheet->getActiveSheet()->getColumnDimension($arrayCell[$i])->setAutoSize(true);
        }
        //end styles

        //values
        $spreadsheet->getActiveSheet()->setCellValue('B2', 'Listado de cotizaciones de '.$months[$month].' del '.$year);
        $spreadsheet->getActiveSheet()->setCellValue('B4', 'Nombre y apellidos');
        $spreadsheet->getActiveSheet()->setCellValue('C4', 'Ci');
        $spreadsheet->getActiveSheet()->setCellValue('D4', 'Provincia');
        $spreadsheet->getActiveSheet()->setCellValue('E4', 'Municipio');
        $spreadsheet->getActiveSheet()->setCellValue('F4', 'Importe');
        
        foreach ($users as $key => $user) {   

            $row = 5 + $key;
            $cotizacion = Cotizacion::where('usuario_id', $user->id)
                            ->where('mes', $month)
                            ->where('ano', $year)
                            ->first();
            $importe = $cotizacion ? '$'.$cotizacion->importe : 'sin cotizar';

            $user_array = [
                $user->nombre_completo,
                $user->ci,
                $user->provincia,
                $user->municipio,
                $importe
            ];

            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $user_array,   
                    NULL,        
                    'B'.$row    
                );
        }

        //end values


        $writer = new Xlsx($spreadsheet);        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. 'Listado de cotizaciones' .'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

}
