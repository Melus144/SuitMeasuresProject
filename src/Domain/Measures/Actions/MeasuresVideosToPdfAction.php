<?php

namespace Domain\Measures\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;


class MeasuresVideosToPdfAction
{
    //Dimensions del PDF de Plantilla Servei fet a mida (mateixes dimensions pels 4 PDFs)
    const WIDTH = 210;
    const HEIGHT = 297;

    public function __invoke
    (
        //Idioma del client dins l'aplicació web
        string $locale,

        //Codi de mesura
        string $measure_code,

        //Camps de la portada
        string $nombre,
        string $altura,
        string $peso,
        string $edad,
        //string $email,
        string $genero,
        string $mono_marina,
        string $talla_mono,
        string $costillar,
        string $ajuste_mono,

        //Camps de les mesures comunes (costillar i sense costillar)
        string $hombros,
        string $brazos,
        string $interior_manga,
        string $cuello,
        string $biceps,
        string $antebrazo,
        string $cintura,
        string $cadera,
        string $largo_talle,
        string $espalda_tiro,
        string $torso,
        string $largo_entero,
        string $pierna,
        string $interior_pierna,
        string $contorno_muslo_arriba,
        string $contorno_muslo_bajo,
        string $gemelo,

        //Camps mesures amb costillar
        string $pecho_costillar,
        string $costillas_costillar,

        //Camps mesures sense costillar
        string $pecho_sin_costillar,
    ): Mpdf
    {
        //Carreguem variables relacionades amb les fonts emprades per la impressió (Montserrat)
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $fontDir = array_merge($fontDirs, [
            resource_path('fonts'),
        ]);
        $fontData = $fontData + [
                'montserrat' => [
                    'R' => 'Montserrat-Regular.ttf',
                    'B' => 'Montserrat-SemiBold.ttf',
                ]
            ];

        //Creem objecte Mpdf amb les mateixes dimensions i orientació del PDF de plantilla
        $pdf = new Mpdf(['format' => [self::HEIGHT, self::WIDTH], 'orientation' => 'L', 'fontDir' => $fontDir, 'fontdata' => $fontData]);

        //Seleccionem el PDF de plantilla sobre el que farem la impressió segons el sexe i l'idioma de l'usuari
        if ($genero == "hombre") {
            if ($locale == 'es') {
                $original_pdf = public_path('customizer/adapted_to_you-male_suit-es.pdf');
            } elseif ($locale == 'en') {
                $original_pdf = public_path('customizer/adapted_to_you-male_suit-en.pdf');
            }
        } elseif ($genero == "mujer") {
            if ($locale == 'es') {
                $original_pdf = public_path('customizer/adapted_to_you-female_suit-es.pdf');
            } elseif ($locale == 'en') {
                $original_pdf = public_path('customizer/adapted_to_you-female_suit-en.pdf');
            }
        }

        //Impressió de les dades sobre el PDF de mesures de plantilla (Ordre segons pdf, d'adalt a abaix (per seccions) i d'esquerra a dreta)
        $pagecount = $pdf->SetSourceFile($original_pdf);
        for ($i = 1; $i <= $pagecount; $i++) {
            $pdf->AddPage('L');
            $tplId = $pdf->importPage($i);
            $pdf->SetFont('Arial', 'R', 8);
            $pdf->useTemplate($tplId, 0, 0, self::WIDTH, self::HEIGHT);

            //Impressió de les dades de la portada a la Capçalera del PDF
            $pdf->WriteText('23', '27.7', ($nombre));
            $pdf->WriteHTML('<div style="margin-left: 130px; margin-top: 25px; font-size:16px; font-weight: bold; font-family: Montserrat"><a target="_blank" href="https://marinaracewear.com/'.$locale.'/my-measures/'.$measure_code.'" style="margin-left:280px;margin-top:20px;">'.$measure_code.'</a></div>');
            $pdf->SetFont('montserrat', '', 10);
            $pdf->WriteText('22', '36', $altura);
            $pdf->WriteText('52', '36', $peso);
            $pdf->WriteText('22', '43', $edad);
            $pdf->SetFont('montserrat', 'R', 7);
            $pdf->SetFont('montserrat', '', 11);
            if ($mono_marina == "mono_marina_si") {
                $pdf->WriteText('137.7', '27.3', "x");
                if ($talla_mono != "" && $talla_mono != "0" && $talla_mono != null) {
                    $pdf->SetFont('montserrat', '', 8);
                    $pdf->WriteText('106.5', '33', $talla_mono);
                    $pdf->SetFont('montserrat', '', 11);
                }
            } elseif ($mono_marina == "mono_marina_no") {
                $pdf->WriteText('149.3', '26.9', "x");
            }
            if ($costillar == "con_costillar") {
                $pdf->WriteText('137.7', '39', "x");
            } elseif ($costillar == "sin_costillar") {
                $pdf->WriteText('149.3', '39', "x");
            }
            if ($ajuste_mono == "mono_ajustado") {
                $pdf->WriteText('185.4', '33.6', "x");
            }
            if ($ajuste_mono == "mono_regular") {
                $pdf->WriteText('185.4', '38.1', "x");
            }
            if ($ajuste_mono == "mono_holgado") {
                $pdf->WriteText('185.4', '42.8', "x");
            }
            // Fi impressió dades portada a la capçalera PDF

            //Impressió dades primera fila de mesures
            $pdf->SetFont('montserrat', '', 10);
            $pdf->WriteText('63', '102', $hombros);
            $pdf->WriteText('110.5', '102', $brazos);
            $pdf->WriteText('160', '102', $interior_manga);
            //Fi impressió dades primera fila de mesures

            //Impressió dades segona fila de mesures
            $pdf->WriteText('12.5', '129.5', $cuello);
            $pdf->WriteText('12.5', '144.3', $biceps);
            $pdf->WriteText('12.5', '159.2', $antebrazo);
            $pdf->WriteText('62', '130.5', $pecho_costillar);
            $pdf->WriteText('62', '130.5', $pecho_sin_costillar);
            $pdf->WriteText('62', '159.2', $costillas_costillar);
            $pdf->WriteText('111.5', '159.2', $cintura);
            $pdf->WriteText('160', '159', $cadera);
            //Fi impressió dades segona fila de mesures

            //Impressió dades tercera fila de mesures
            $pdf->WriteText('19.2', '216.5', $largo_talle);
            $pdf->WriteText('65.2', '216.5', $espalda_tiro);
            $pdf->WriteText('148', '216.5', $torso);
            //Fi impressió dades tercera fila de mesures

            //Impressió dades quarta fila de mesures
            $pdf->WriteText('14.5', '273', $largo_entero);
            $pdf->WriteText('61.8', '273', $pierna);
            $pdf->WriteText('110.2', '273', $interior_pierna);
            $pdf->WriteText('161', '251.2', $contorno_muslo_arriba);
            $pdf->WriteText('161', '257.8', $contorno_muslo_bajo);
            $pdf->WriteText('160', '272.8', $gemelo);
            //Fi impressió dades quarta fila de mesures

        }
        try {
            if ($locale == 'es') {
                $pdf->Output(storage_path('app/mesures-clients/' . "Medidas " . $nombre . '.pdf'), "F") ;
            }
            if ($locale == 'en') {
                $pdf->Output(storage_path('app/mesures-clients/' . "Measures " . $nombre . '.pdf'), "F");
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $pdf;
    }
}
