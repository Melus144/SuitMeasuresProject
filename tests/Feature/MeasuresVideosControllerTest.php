<?php

use App\Front\MeasuresVideos\MeasuresVideosController;
use Domain\Measures\Actions\MeasuresVideosToPdfAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class MeasuresVideosControllerTest extends TestCase
{
    /**
     * Prueba la función 'saveMeasures' del controlador.
     */
    public function testSaveMeasures()
    {
        $controller = new MeasuresVideosController();

        // Crea un objeto de solicitud (request) simulado con datos válidos
        $request = Request::create('/url', 'POST', [
            'nombre' => 'John Doe',
            'altura' => 180,
            'peso' => 80,
            'edad' => 30,
            'email' => 'john.doe@example.com',
            'genero' => 'hombre',
            'mono_marina' => 'mono_marina_no',
            'talla_mono' => null,
            'costillar' => 'sin_costillar',
            'ajuste_mono' => 'mono_ajustado',
            'talla_altura' => 54,
            'talla_peso' => 54,
            'talla_pecho' => 54,
            'talla_cintura' => 54,
            'talla_cadera' => 54,
            'con_costillar' => [
                'shoulder' => 50,
                'sleeve_length' => 40,
                'sleeve_interior' => 60,
                'neck' => 38,
                'biceps' => 30,
                'forearm' => 25,
                'waist' => 80,
                'hip' => 100,
                'torso_length' => 70,
                'back_shot' => 50,
                'torso' => 60,
                'total_length' => 110,
                'leg' => 80,
                'interior_leg' => 75,
                'leg_upper' => 55,
                'leg_lower' => 50,
                'calf' => 35,
                'rib_chest' => 90,
                'rib_rack' => 85,
            ],
            'sin_costillar' => [
                'shoulder' => 55,
                'sleeve_length' => 45,
                'sleeve_interior' => 65,
                'neck' => 43,
                'biceps' => 35,
                'forearm' => 30,
                'waist' => 85,
                'hip' => 105,
                'torso_length' => 75,
                'back_shot' => 55,
                'torso' => 65,
                'total_length' => 115,
                'leg' => 85,
                'interior_leg' => 80,
                'leg_upper' => 60,
                'leg_lower' => 55,
                'calf' => 40,
                'chest' => 100
            ],
        ]);

        // Llama a la función del controlador con la solicitud simulada
        $response = $controller->saveMeasures($request);

        // Verifica que la redirección ocurra después de guardar las medidas
        $response->assertRedirect();

        // Verifica que el código de estado de la respuesta sea 302 (redirección)
        $this->assertEquals(302, $response->getStatusCode());
    }

    /**
     * Prueba la función 'downloadPdf' del controlador.
     */
    public function testDownloadPdf()
    {
        $controller = new MeasuresVideosController();

        // Crea una instancia de la clase MeasuresVideosToPdfAction
        $action = new MeasuresVideosToPdfAction();

        // Define los valores de prueba para los parámetros
        $locale = 'es';
        $measure_code = 'ABC123';
        $nombre = 'John Doe';
        $altura = '180 cm';
        $peso = '75 kg';
        $edad = '30 años';
        $genero = 'hombre';
        $mono_marina = 'mono_marina_si';
        $talla_mono = 'M';
        $costillar = 'con_costillar';
        $ajuste_mono = 'mono_ajustado';
        $hombros = '50 cm';
        $brazos = '40 cm';
        $interior_manga = '60 cm';
        $cuello = '38 cm';
        $biceps = '30 cm';
        $antebrazo = '25 cm';
        $cintura = '80 cm';
        $cadera = '100 cm';
        $largo_talle = '70 cm';
        $espalda_tiro = '50 cm';
        $torso = '60 cm';
        $largo_entero = '110 cm';
        $pierna = '80 cm';
        $interior_pierna = '75 cm';
        $contorno_muslo_arriba = '55 cm';
        $contorno_muslo_bajo = '50 cm';
        $gemelo = '35 cm';
        $pecho_costillar = '90 cm';
        $costillas_costillar = '85 cm';
        $pecho_sin_costillar = '95 cm';

        // Llama a la función __invoke con los parámetros de prueba
        $pdf = $action->__invoke(
            $locale,
            $measure_code,
            $nombre,
            $altura,
            $peso,
            $edad,
            $genero,
            $mono_marina,
            $talla_mono,
            $costillar,
            $ajuste_mono,
            $hombros,
            $brazos,
            $interior_manga,
            $cuello,
            $biceps,
            $antebrazo,
            $cintura,
            $cadera,
            $largo_talle,
            $espalda_tiro,
            $torso,
            $largo_entero,
            $pierna,
            $interior_pierna,
            $contorno_muslo_arriba,
            $contorno_muslo_bajo,
            $gemelo,
            $pecho_costillar,
            $costillas_costillar,
            $pecho_sin_costillar
        );

        // Verifica si se generó el PDF correctamente
        $this->assertInstanceOf(\Mpdf\Mpdf::class, $pdf);

        // Crea una solicitud (request) simulada con método GET y ruta '/download-pdf'
        $request = Request::create('/download-pdf', 'GET', [
        $locale => 'es',
        $measure_code => 'ABC123',
        $nombre => 'John Doe',
        $altura => '180 cm',
        $peso => '75 kg',
        $edad => '30 años',
        $genero => 'hombre',
        $mono_marina => 'mono_marina_si',
        $talla_mono => 'M',
        $costillar => 'con_costillar',
        $ajuste_mono => 'mono_ajustado',
        $hombros => '50 cm',
        $brazos => '40 cm',
        $interior_manga => '60 cm',
        $cuello => '38 cm',
        $biceps => '30 cm',
        $antebrazo => '25 cm',
        $cintura => '80 cm',
        $cadera => '100 cm',
        $largo_talle => '70 cm',
        $espalda_tiro => '50 cm',
        $torso => '60 cm',
        $largo_entero => '110 cm',
        $pierna => '80 cm',
        $interior_pierna => '75 cm',
        $contorno_muslo_arriba => '55 cm',
        $contorno_muslo_bajo => '50 cm',
        $gemelo => '35 cm',
        $pecho_costillar => '90 cm',
        $costillas_costillar => '85 cm',
        $pecho_sin_costillar => '95 cm',
        ]);

        // Llama a la función del controlador con la solicitud simulada y el objeto de acción (action) simulado
        $response = $controller->downloadPdf($request, $action);

        // Verifica que se descargue correctamente el PDF
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));

        // Verifica que el código de estado de la respuesta sea 200 (éxito)
        $this->assertEquals(200, $response->getStatusCode());
    }
}
