<?php

namespace App\Front\MeasuresVideos;

use App\Controller;
use Domain\Measures\Actions\MeasuresVideosToPdfAction;
use Domain\Measures\Models\Measures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MeasuresVideosController extends Controller
{

    //Funció per carregar la interfície de mesures amb tota la informació corresponent a cada mesura
    public function index()
    {
        //Definim les dades dels pasos/videos a mostrar a la inferfície, diferenciant entre costillar i sin costillar
        //Estableixem el nom del video, el nom del input, la clau de traducció del títol i el subtítol, establirem traduccions desde backoffice
        $pasos_costillar = [
            1 => [
                'video' => '1. Hombros Animacio',
                'input' => 'shoulder',
                'title' => 'title_hombros',
                'subtitle' => 'subtitle_hombros',
            ],
            2 => [
                'video' => '2. Brazos',
                'input' => 'sleeve_length',
                'title' => 'title_brazos',
                'subtitle' => 'subtitle_brazos',
            ],
            3 => [
                'video' => '3. Interior Manga',
                'input' => 'sleeve_interior',
                'title' => 'title_interior_manga',
                'subtitle' => 'subtitle_interior_manga',
            ],
            4 => [
                'video' => '4. Cuello',
                'input' => 'neck',
                'title' => 'title_cuello',
                'subtitle' => 'subtitle_cuello',
            ],
            5 => [
                'video' => '5. Contorno Bíceps',
                'input' => 'biceps',
                'title' => 'title_biceps',
                'subtitle' => 'subtitle_biceps',
            ],
            6 => [
                'video' => '6. Contorno Antebrazo',
                'input' => 'forearm',
                'title' => 'title_antebrazo',
                'subtitle' => 'subtitle_antebrazo',
            ],
            //Canvia el video corresponent a la mesura segons si les mesures son preses amb costillar o sense
            7 => [
                'video' => '7. Pecho Costillar',
                'input' => 'rib_chest',
                'title' => 'title_pecho_costillar',
                'subtitle' => 'subtitle_pecho_costillar',
            ],
            //Mesura i video adicional per mesures amb costillar
            8 => [
                'video' => '8. Costillas Costillar',
                'input' => 'rib_rack',
                'title' => 'title_costillas_costillar',
                'subtitle' => 'subtitle_costillas_costillar',
            ],
            9 => [
                'video' => '10. Cintura',
                'input' => 'waist',
                'title' => 'title_cintura',
                'subtitle' => 'subtitle_cintura',
            ],
            10 => [
                'video' => '11. Cadera',
                'input' => 'hip',
                'title' => 'title_cadera',
                'subtitle' => 'subtitle_cadera',
            ],
            11 => [
                'video' => '12. Largo Talle',
                'input' => 'torso_length',
                'title' => 'title_largo_talle',
                'subtitle' => 'subtitle_largo_talle',
            ],
            12 => [
                'video' => '13. Espalda + Tiro',
                'input' => 'back_shot',
                'title' => 'title_espalda_tiro',
                'subtitle' => 'subtitle_espalda_tiro',
            ],
            13 => [
                'video' => '14. Torso',
                'input' => 'torso',
                'title' => 'title_torso',
                'subtitle' => 'subtitle_torso',
            ],
            14 => [
                'video' => '15. Largo Entero',
                'input' => 'total_length',
                'title' => 'title_largo_entero',
                'subtitle' => 'subtitle_largo_entero',
            ],
            15 => [
                'video' => '16. Pierna',
                'input' => 'leg',
                'title' => 'title_pierna',
                'subtitle' => 'subtitle_pierna',
            ],
            16 => [
                'video' => '17. Interior Pierna',
                'input' => 'interior_leg',
                'title' => 'title_interior_pierna',
                'subtitle' => 'subtitle_interior_pierna',
            ],
            17 => [
                'video' => '18. Contorno Pierna Muslo Arriba',
                'input' => 'leg_upper',
                'title' => 'title_pierna_muslo_arriba',
                'subtitle' => 'subtitle_pierna_muslo_arriba',
            ],
            18 => [
                'video' => '19. Contorno Pierna Muslo Bajo',
                'input' => 'leg_lower',
                'title' => 'title_pierna_muslo_bajo',
                'subtitle' => 'subtitle_pierna_muslo_bajo',
            ],
            19 => [
                'video' => '20. Gemelo',
                'input' => 'calf',
                'title' => 'title_gemelo',
                'subtitle' => 'subtitle_gemelo',
            ]
        ];

        $pasos_sin_costillar = [
            1 => [
                'video' => '1. Hombros Animacio',
                'input' => 'shoulder',
                'title' => 'title_hombros',
                'subtitle' => 'subtitle_hombros',
            ],
            2 => [
                'video' => '2. Brazos',
                'input' => 'sleeve_length',
                'title' => 'title_brazos',
                'subtitle' => 'subtitle_brazos',
            ],
            3 => [
                'video' => '3. Interior Manga',
                'input' => 'sleeve_interior',
                'title' => 'title_interior_manga',
                'subtitle' => 'subtitle_interior_manga',
            ],
            4 => [
                'video' => '4. Cuello',
                'input' => 'neck',
                'title' => 'title_cuello',
                'subtitle' => 'subtitle_cuello',
            ],
            5 => [
                'video' => '5. Contorno Bíceps',
                'input' => 'biceps',
                'title' => 'title_biceps',
                'subtitle' => 'subtitle_biceps',
            ],
            6 => [
                'video' => '6. Contorno Antebrazo',
                'input' => 'forearm',
                'title' => 'title_antebrazo',
                'subtitle' => 'subtitle_antebrazo',
            ],
            //Canvia el video corresponent a la mesura segons si les mesures son preses amb costillar o sense
            7 => [
                'video' => '9. Pecho Sin Costillar',
                'input' => 'chest',
                'title' => 'title_pecho_sin_costillar',
                'subtitle' => 'subtitle_pecho_sin_costillar',
            ],
            8 => [
                'video' => '10. Cintura',
                'input' => 'waist',
                'title' => 'title_cintura',
                'subtitle' => 'subtitle_cintura',
            ],

            9 => [
                'video' => '11. Cadera',
                'input' => 'hip',
                'title' => 'title_cadera',
                'subtitle' => 'subtitle_cadera',
            ],
            10 => [
                'video' => '12. Largo Talle',
                'input' => 'torso_length',
                'title' => 'title_largo_talle',
                'subtitle' => 'subtitle_largo_talle',
            ],
            11 => [
                'video' => '13. Espalda + Tiro',
                'input' => 'back_shot',
                'title' => 'title_espalda_tiro',
                'subtitle' => 'subtitle_espalda_tiro',
            ],
            12 => [
                'video' => '14. Torso',
                'input' => 'torso',
                'title' => 'title_torso',
                'subtitle' => 'subtitle_torso',
            ],
            13 => [
                'video' => '15. Largo Entero',
                'input' => 'total_length',
                'title' => 'title_largo_entero',
                'subtitle' => 'subtitle_largo_entero',
            ],
            14 => [
                'video' => '16. Pierna',
                'input' => 'leg',
                'title' => 'title_pierna',
                'subtitle' => 'subtitle_pierna',
            ],
            15 => [
                'video' => '17. Interior Pierna',
                'input' => 'interior_leg',
                'title' => 'title_interior_pierna',
                'subtitle' => 'subtitle_interior_pierna',
            ],
            16 => [
                'video' => '18. Contorno Pierna Muslo Arriba',
                'input' => 'leg_upper',
                'title' => 'title_pierna_muslo_arriba',
                'subtitle' => 'subtitle_pierna_muslo_arriba',
            ],
            17 => [
                'video' => '19. Contorno Pierna Muslo Bajo',
                'input' => 'leg_lower',
                'title' => 'title_pierna_muslo_bajo',
                'subtitle' => 'subtitle_pierna_muslo_bajo',
            ],
            18 => [
                'video' => '20. Gemelo',
                'input' => 'calf',
                'title' => 'title_gemelo',
                'subtitle' => 'subtitle_gemelo',
            ]
        ];

        //Inicialitzem valors que seran inputs i enviem arrays amb els camps buits a la vista
        $dades = [];
        $dades['con_costillar'] = [];
        $dades['sin_costillar'] = [];
        foreach ($pasos_costillar as $key => $paso) {
            $dades['con_costillar'][$paso['input']] = '';
        }
        foreach ($pasos_sin_costillar as $key => $paso) {
            $dades['sin_costillar'][$paso['input']] = '';
        }

        $measure_code = '';
        $step = 0;

        $costillar = 'sin_costillar';

        $name = '';
        $height = '';
        $weight = '';
        $age = '';
        $email = '';
        $gender = '';
        $lopd = false;

        $have_marina_suit = 'mono_marina_no';
        $marina_suit_size = '';
        $suit_fitting = '';

        return view('front.measures.measures-videos', compact('pasos_costillar', 'pasos_sin_costillar', 'dades', 'measure_code',
            'step', 'costillar', 'name', 'height', 'weight', 'age', 'email', 'gender', 'lopd', 'have_marina_suit', 'marina_suit_size', 'suit_fitting'));
    }

    //Funció per carregar mesura d'usuari guardada a la base de dades
    public function edit($measureCode)
    {
        //URL: /my-measures/{measureCode}
        $measure = Measures::where('measure_code', $measureCode)->first();

        //Definim les dades dels pasos/videos a mostrar a la interfície, diferenciant entre costillar i sin costillar
        //Establim el nom del video, el nom del input, la clau de traducció del títol i el subtítol, establirem traduccions desde backoffice
        $pasos_costillar = [
            1 => [
                'video' => '1. Hombros Animacio',
                'input' => 'shoulder',
                'title' => 'title_hombros',
                'subtitle' => 'subtitle_hombros',
            ],
            2 => [
                'video' => '2. Brazos',
                'input' => 'sleeve_length',
                'title' => 'title_brazos',
                'subtitle' => 'subtitle_brazos',
            ],
            3 => [
                'video' => '3. Interior Manga',
                'input' => 'sleeve_interior',
                'title' => 'title_interior_manga',
                'subtitle' => 'subtitle_interior_manga',
            ],
            4 => [
                'video' => '4. Cuello',
                'input' => 'neck',
                'title' => 'title_cuello',
                'subtitle' => 'subtitle_cuello',
            ],
            5 => [
                'video' => '5. Contorno Bíceps',
                'input' => 'biceps',
                'title' => 'title_biceps',
                'subtitle' => 'subtitle_biceps',
            ],
            6 => [
                'video' => '6. Contorno Antebrazo',
                'input' => 'forearm',
                'title' => 'title_antebrazo',
                'subtitle' => 'subtitle_antebrazo',
            ],
            //Canvia el video corresponent a la mesura segons si les mesures son preses amb costillar o sense
            7 => [
                'video' => '7. Pecho Costillar',
                'input' => 'rib_chest',
                'title' => 'title_pecho_costillar',
                'subtitle' => 'subtitle_pecho_costillar',
            ],
            //Mesura i video adicional per mesures amb costillar
            8 => [
                'video' => '8. Costillas Costillar',
                'input' => 'rib_rack',
                'title' => 'title_costillas_costillar',
                'subtitle' => 'subtitle_costillas_costillar',
            ],
            9 => [
                'video' => '10. Cintura',
                'input' => 'waist',
                'title' => 'title_cintura',
                'subtitle' => 'subtitle_cintura',
            ],
            10 => [
                'video' => '11. Cadera',
                'input' => 'hip',
                'title' => 'title_cadera',
                'subtitle' => 'subtitle_cadera',
            ],
            11 => [
                'video' => '12. Largo Talle',
                'input' => 'torso_length',
                'title' => 'title_largo_talle',
                'subtitle' => 'subtitle_largo_talle',
            ],
            12 => [
                'video' => '13. Espalda + Tiro',
                'input' => 'back_shot',
                'title' => 'title_espalda_tiro',
                'subtitle' => 'subtitle_espalda_tiro',
            ],
            13 => [
                'video' => '14. Torso',
                'input' => 'torso',
                'title' => 'title_torso',
                'subtitle' => 'subtitle_torso',
            ],
            14 => [
                'video' => '15. Largo Entero',
                'input' => 'total_length',
                'title' => 'title_largo_entero',
                'subtitle' => 'subtitle_largo_entero',
            ],
            15 => [
                'video' => '16. Pierna',
                'input' => 'leg',
                'title' => 'title_pierna',
                'subtitle' => 'subtitle_pierna',
            ],
            16 => [
                'video' => '17. Interior Pierna',
                'input' => 'interior_leg',
                'title' => 'title_interior_pierna',
                'subtitle' => 'subtitle_interior_pierna',
            ],
            17 => [
                'video' => '18. Contorno Pierna Muslo Arriba',
                'input' => 'leg_upper',
                'title' => 'title_pierna_muslo_arriba',
                'subtitle' => 'subtitle_pierna_muslo_arriba',
            ],
            18 => [
                'video' => '19. Contorno Pierna Muslo Bajo',
                'input' => 'leg_lower',
                'title' => 'title_pierna_muslo_bajo',
                'subtitle' => 'subtitle_pierna_muslo_bajo',
            ],
            19 => [
                'video' => '20. Gemelo',
                'input' => 'calf',
                'title' => 'title_gemelo',
                'subtitle' => 'subtitle_gemelo',
            ]
        ];

        $pasos_sin_costillar = [
            1 => [
                'video' => '1. Hombros Animacio',
                'input' => 'shoulder',
                'title' => 'title_hombros',
                'subtitle' => 'subtitle_hombros',
            ],
            2 => [
                'video' => '2. Brazos',
                'input' => 'sleeve_length',
                'title' => 'title_brazos',
                'subtitle' => 'subtitle_brazos',
            ],
            3 => [
                'video' => '3. Interior Manga',
                'input' => 'sleeve_interior',
                'title' => 'title_interior_manga',
                'subtitle' => 'subtitle_interior_manga',
            ],
            4 => [
                'video' => '4. Cuello',
                'input' => 'neck',
                'title' => 'title_cuello',
                'subtitle' => 'subtitle_cuello',
            ],
            5 => [
                'video' => '5. Contorno Bíceps',
                'input' => 'biceps',
                'title' => 'title_biceps',
                'subtitle' => 'subtitle_biceps',
            ],
            6 => [
                'video' => '6. Contorno Antebrazo',
                'input' => 'forearm',
                'title' => 'title_antebrazo',
                'subtitle' => 'subtitle_antebrazo',
            ],
            //Canvia el video corresponent a la mesura segons si les mesures son preses amb costillar o sense
            7 => [
                'video' => '9. Pecho Sin Costillar',
                'input' => 'chest',
                'title' => 'title_pecho_sin_costillar',
                'subtitle' => 'subtitle_pecho_sin_costillar',
            ],
            8 => [
                'video' => '10. Cintura',
                'input' => 'waist',
                'title' => 'title_cintura',
                'subtitle' => 'subtitle_cintura',
            ],

            9 => [
                'video' => '11. Cadera',
                'input' => 'hip',
                'title' => 'title_cadera',
                'subtitle' => 'subtitle_cadera',
            ],
            10 => [
                'video' => '12. Largo Talle',
                'input' => 'torso_length',
                'title' => 'title_largo_talle',
                'subtitle' => 'subtitle_largo_talle',
            ],
            11 => [
                'video' => '13. Espalda + Tiro',
                'input' => 'back_shot',
                'title' => 'title_espalda_tiro',
                'subtitle' => 'subtitle_espalda_tiro',
            ],
            12 => [
                'video' => '14. Torso',
                'input' => 'torso',
                'title' => 'title_torso',
                'subtitle' => 'subtitle_torso',
            ],
            13 => [
                'video' => '15. Largo Entero',
                'input' => 'total_length',
                'title' => 'title_largo_entero',
                'subtitle' => 'subtitle_largo_entero',
            ],
            14 => [
                'video' => '16. Pierna',
                'input' => 'leg',
                'title' => 'title_pierna',
                'subtitle' => 'subtitle_pierna',
            ],
            15 => [
                'video' => '17. Interior Pierna',
                'input' => 'interior_leg',
                'title' => 'title_interior_pierna',
                'subtitle' => 'subtitle_interior_pierna',
            ],
            16 => [
                'video' => '18. Contorno Pierna Muslo Arriba',
                'input' => 'leg_upper',
                'title' => 'title_pierna_muslo_arriba',
                'subtitle' => 'subtitle_pierna_muslo_arriba',
            ],
            17 => [
                'video' => '19. Contorno Pierna Muslo Bajo',
                'input' => 'leg_lower',
                'title' => 'title_pierna_muslo_bajo',
                'subtitle' => 'subtitle_pierna_muslo_bajo',
            ],
            18 => [
                'video' => '20. Gemelo',
                'input' => 'calf',
                'title' => 'title_gemelo',
                'subtitle' => 'subtitle_gemelo',
            ]
        ];

        //Inicialitzem inputs/valors i enviem arrays amb informació de la base de dades a la vista
        //Com la informació de la base de dades ha estat validada anteriorment, la considerem correcte i no cal validar-la de nou
        $dades = [];
        $dades['con_costillar'] = [];
        $dades['sin_costillar'] = [];

        if ($measure->rib_protector == 1) {
            foreach ($pasos_costillar as $key => $paso) {
                $dades['con_costillar'][$paso['input']] = $measure[$paso['input']];
            }
            foreach ($pasos_sin_costillar as $key => $paso) {
                $dades['sin_costillar'][$paso['input']] = '';
            }
            $step = 20;
        } else {
            foreach ($pasos_costillar as $key => $paso) {
                $dades['con_costillar'][$paso['input']] = '';
            }
            foreach ($pasos_sin_costillar as $key => $paso) {
                $dades['sin_costillar'][$paso['input']] = $measure[$paso['input']];
            }
            $step = 19;
        }

        $measure_code = $measure->measure_code;
        $name = $measure->name;
        $height = $measure->height;
        $weight = $measure->weight;
        $age = $measure->age;
        $gender = $measure->gender;

        $suit_fitting = $measure->suit_fitting;

        $height_size = $measure->height_size;
        $weight_size = $measure->weight_size;
        $chest_size = $measure->chest_size;
        $waist_size = $measure->waist_size;
        $hip_size = $measure->hip_size;
        $medium_size = $measure->medium_size;

        if ($measure->rib_protector == 1) {
            $costillar = 'con_costillar';
        } else {
            $costillar = 'sin_costillar';
        }

        if ($measure->have_marina_suit == 1) {
            $have_marina_suit = 'mono_marina_si';
            $marina_suit_size = $measure->marina_suit_size;
        } else {
            $have_marina_suit = 'mono_marina_no';
            $marina_suit_size = '';
        }

        return view('front.measures.measures-videos-review', compact('pasos_costillar', 'pasos_sin_costillar', 'dades', 'measure_code',
            'step', 'costillar', 'name', 'height', 'weight', 'age', 'gender', 'have_marina_suit', 'marina_suit_size', 'suit_fitting', 'height_size', 'weight_size', 'chest_size', 'waist_size', 'hip_size', 'medium_size'));

    }

    // Funció per validar i guardar una còpia de la informació enviada vía formulari a la base de dades.
    public function saveMeasures(Request $request)
    {
        //dd($request);
        //Dades de la portada
        $validatedFrontPageData = $request->validate([
            'nombre' => 'required|string|max:45',
            'altura' => 'required|numeric|min:0|max:300',
            'peso' => 'required|numeric|min:0|max:600',
            'edad' => 'required|numeric|min:0|max:199',
            'email' => 'required|email|max:45',
            'genero' => 'required|in:hombre,mujer',
            'mono_marina' => 'required|in:mono_marina_si,mono_marina_no',
            'talla_mono' => 'nullable|string|max:20',
            'costillar' => 'required|in:con_costillar,sin_costillar',
            'ajuste_mono' => 'required|in:mono_ajustado,mono_regular,mono_holgado',
        ]);

        //Dividim els valors de l'array general en un nou array segons el costillar seleccionat.
        //Talla mono es l'únic input opcional, per tant, si no s'ha introduït, li assignem un string buit
        if ($validatedFrontPageData['costillar'] == 'con_costillar') {
            $valors = $request->input('con_costillar');
        } else {
            $valors = $request->input('sin_costillar');
        }
        if ($request->input('talla_mono') != null) {
            $valors['talla_mono'] = $request->input('talla_mono');
        } else {
            $valors['talla_mono'] = '';
        }

        //Com a la vista deixem introduir comes i punts (per facilitat usuari), aquí hem de convertir al mateix format
        //Reemplacem la coma per un punt per convertir tots els valors a valors decimals/numerics en un nou array:
        $decimalMeasuresValues = array_map(function ($valors) {
            return str_replace(',', '.', $valors);
        }, $valors);

        //Validem les dades de les mesures introduïdes per l'usuari segons si les mesures son amb costillar o sense.
        //Com necessitem validar el valor de les dades una vegada convertides a decimals, no podem fer servir la validació per Request de Laravel
        //Per tant, creem un nou objecte Validator i li passem els valors a validar i les regles de validació.
        //Si les dades no son vàlides, retornem a la vista anterior amb els errors de validació.
        $rulesMeasuresCostillar = [
            'talla_mono' => 'string|max:20',
            'shoulder' => 'required|numeric|min:0|max:999',
            'sleeve_length' => 'required|numeric|min:0|max:999',
            'sleeve_interior' => 'required|numeric|min:0|max:999',
            'neck' => 'required|numeric|min:0|max:999',
            'biceps' => 'required|numeric|min:0|max:999',
            'forearm' => 'required|numeric|min:0|max:999',
            'waist' => 'required|numeric|min:0|max:999',
            'hip' => 'required|numeric|min:0|max:999',
            'torso_length' => 'required|numeric|min:0|max:999',
            'back_shot' => 'required|numeric|min:0|max:999',
            'torso' => 'required|numeric|min:0|max:999',
            'total_length' => 'required|numeric|min:0|max:999',
            'leg' => 'required|numeric|min:0|max:999',
            'interior_leg' => 'required|numeric|min:0|max:999',
            'leg_upper' => 'required|numeric|min:0|max:999',
            'leg_lower' => 'required|numeric|min:0|max:999',
            'calf' => 'required|numeric|min:0|max:999',
            'rib_chest' => 'required|numeric|min:0|max:999',
            'rib_rack' => 'required|numeric|min:0|max:999',
            'chest' => 'nullable|numeric|min:0|max:999'
        ];
        $rulesMeasuresSinCostillar = [
            'talla_mono' => 'string|max:20',
            'shoulder' => 'required|numeric|min:0|max:999',
            'sleeve_length' => 'required|numeric|min:0|max:999',
            'sleeve_interior' => 'required|numeric|min:0|max:999',
            'neck' => 'required|numeric|min:0|max:999',
            'biceps' => 'required|numeric|min:0|max:999',
            'forearm' => 'required|numeric|min:0|max:999',
            'waist' => 'required|numeric|min:0|max:999',
            'hip' => 'required|numeric|min:0|max:999',
            'torso_length' => 'required|numeric|min:0|max:999',
            'back_shot' => 'required|numeric|min:0|max:999',
            'torso' => 'required|numeric|min:0|max:999',
            'total_length' => 'required|numeric|min:0|max:999',
            'leg' => 'required|numeric|min:0|max:999',
            'interior_leg' => 'required|numeric|min:0|max:999',
            'leg_upper' => 'required|numeric|min:0|max:999',
            'leg_lower' => 'required|numeric|min:0|max:999',
            'calf' => 'required|numeric|min:0|max:999',
            'rib_chest' => 'nullable|numeric|min:0|max:999',
            'rib_rack' => 'nullable|numeric|min:0|max:999',
            'chest' => 'required|numeric|min:0|max:999'
        ];
        if ($validatedFrontPageData['costillar'] == 'con_costillar') {
            $validator = Validator::make($decimalMeasuresValues, $rulesMeasuresCostillar);
        }else {
            $validator = Validator::make($decimalMeasuresValues, $rulesMeasuresSinCostillar);
        }
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            $validatedMeasuresData = $validator->validated();
        }


        //Inserir informació a la base de dades mitjançant el model Measures
        //Dades Front Page
        $measures = new Measures();
        if (auth('customer')->check()) {
            $customer = auth('customer')->user();
            $measures->customer_id = $customer->id;
        } else {
            $measures->customer_id = null;
        }
        $measures->language = app()->getLocale();
        $measures->name = $validatedFrontPageData['nombre'];
        $measures->email = $validatedFrontPageData['email'];
        $measures->height = $validatedFrontPageData['altura'];
        $measures->weight = $validatedFrontPageData['peso'];
        $measures->age = $validatedFrontPageData['edad'];
        $measures->gender = $validatedFrontPageData['genero'];
        if ($validatedFrontPageData['mono_marina'] == 'mono_marina_si')
            $measures->have_marina_suit = true;
        else
            $measures->have_marina_suit = false;
        $measures->suit_fitting = $validatedFrontPageData['ajuste_mono'];
        $measures->marina_suit_size = $validatedFrontPageData['talla_mono'];
        //Dades de les mesures
        $measures->shoulder = $validatedMeasuresData['shoulder'];
        $measures->sleeve_length = $validatedMeasuresData['sleeve_length'];
        $measures->sleeve_interior = $validatedMeasuresData['sleeve_interior'];
        $measures->neck = $validatedMeasuresData['neck'];
        $measures->biceps = $validatedMeasuresData['biceps'];
        $measures->forearm = $validatedMeasuresData['forearm'];
        $measures->waist = $validatedMeasuresData['waist'];
        $measures->hip = $validatedMeasuresData['hip'];
        $measures->torso_length = $validatedMeasuresData['torso_length'];
        $measures->back_shot = $validatedMeasuresData['back_shot'];
        $measures->torso = $validatedMeasuresData['torso'];
        $measures->total_length = $validatedMeasuresData['total_length'];
        $measures->leg = $validatedMeasuresData['leg'];
        $measures->interior_leg = $validatedMeasuresData['interior_leg'];
        $measures->leg_upper = $validatedMeasuresData['leg_upper'];
        $measures->leg_lower = $validatedMeasuresData['leg_lower'];
        $measures->calf = $validatedMeasuresData['calf'];

        //Mesures que varien depenent del costillar (nullable)
        if ($request->input('costillar') == 'con_costillar') {
            $measures->rib_protector = true;
            $measures->rib_chest = $validatedMeasuresData['rib_chest'];
            $measures->rib_rack = $validatedMeasuresData['rib_rack'];
            $measures->chest = null;
        } else {
            $measures->rib_protector = false;
            $measures->rib_chest = null;
            $measures->rib_rack = null;
            $measures->chest = $validatedMeasuresData['chest'];
        }

        $measures->height_size = $request->input('talla_altura');
        $measures->weight_size = $request->input('talla_peso');
        $measures->chest_size = $request->input('talla_pecho');
        $measures->waist_size = $request->input('talla_cintura');
        $measures->hip_size = $request->input('talla_cadera');

        $measures->medium_size = $this->calculateMediumSize($measures->height_size, $measures->weight_size, $measures->chest_size, $measures->waist_size, $measures->hip_size);
        $measures->final_size = $this->calculateFinalSize($measures->height_size, $measures->weight_size, $measures->waist_size ,$measures->medium_size);

        $measures->measure_code = $measures->generateMeasureCode();
        $measures->save();

        return redirect()->away(route('measures-videos.edit', ['measureCode' => $measures->measure_code]));

    }

    // Funció que s'executa quan es fa click a descarregar PDF
    // L'objectiu d'aquesta funció és enviar les dades que ha introduït l'usuari en el formulari a l'acció MeasuresVideosToPdfAction per a que es generi el pdf amb les dades impreses
    // També cridem a la funció updateMesures per actualizar les dades que s'hagin modificat
    //Fem una validació de les dades introduïdes per l'usuari i si no són vàlides, tornem a la pàgina anterior amb els errors
    //Aquesta validació serveix tant pel procés measuresVideosToPdfAction com pel updateMesures.
    public function downloadPdf(Request $request, MeasuresVideosToPdfAction $measuresVideosToPdfAction)
    {

        if ($request->query()['costillar'] == 'con_costillar') {
            $valors = $request->input('con_costillar');
        } else {
            $valors = $request->input('sin_costillar');
        }
        //Talla mono es l'únic input opcional, per tant, si no s'ha introduït, li assignem un string buit
        if (isset($request->query()['talla_mono'])) {
            $valors['talla_mono'] = $request->query()['talla_mono'];
        } else {
            $valors['talla_mono'] = '';
        }

        //Com a la vista deixem introduir comes i punts (per facilitat usuari), aquí hem de convertir al mateix format
        //Reemplacem la coma per un punt per convertir tots els valors a valors decimals/numerics en un nou array:
        $decimalMeasuresValues = array_map(function ($valors) {
            return str_replace(',', '.', $valors);
        }, $valors);

        //Validem les dades de les mesures introduïdes per l'usuari segons si les mesures son amb costillar o sense.
        //Com necessitem validar el valor de les dades una vegada convertides a decimals, no podem fer servir la validació per Request de Laravel
        //Per tant, creem un nou objecte Validator i li passem els valors a validar i les regles de validació.
        //Si les dades no son vàlides, retornem a la vista anterior amb els errors de validació.
        $rulesMeasuresCostillar = [
            'talla_mono' => 'string|max:20',
            'shoulder' => 'required|numeric|min:0|max:999',
            'sleeve_length' => 'required|numeric|min:0|max:999',
            'sleeve_interior' => 'required|numeric|min:0|max:999',
            'neck' => 'required|numeric|min:0|max:999',
            'biceps' => 'required|numeric|min:0|max:999',
            'forearm' => 'required|numeric|min:0|max:999',
            'waist' => 'required|numeric|min:0|max:999',
            'hip' => 'required|numeric|min:0|max:999',
            'torso_length' => 'required|numeric|min:0|max:999',
            'back_shot' => 'required|numeric|min:0|max:999',
            'torso' => 'required|numeric|min:0|max:999',
            'total_length' => 'required|numeric|min:0|max:999',
            'leg' => 'required|numeric|min:0|max:999',
            'interior_leg' => 'required|numeric|min:0|max:999',
            'leg_upper' => 'required|numeric|min:0|max:999',
            'leg_lower' => 'required|numeric|min:0|max:999',
            'calf' => 'required|numeric|min:0|max:999',
            'rib_chest' => 'required|numeric|min:0|max:999',
            'rib_rack' => 'required|numeric|min:0|max:999',
            'chest' => 'nullable|numeric|min:0|max:999'
        ];
        $rulesMeasuresSinCostillar = [
            'talla_mono' => 'string|max:20',
            'shoulder' => 'required|numeric|min:0|max:999',
            'sleeve_length' => 'required|numeric|min:0|max:999',
            'sleeve_interior' => 'required|numeric|min:0|max:999',
            'neck' => 'required|numeric|min:0|max:999',
            'biceps' => 'required|numeric|min:0|max:999',
            'forearm' => 'required|numeric|min:0|max:999',
            'waist' => 'required|numeric|min:0|max:999',
            'hip' => 'required|numeric|min:0|max:999',
            'torso_length' => 'required|numeric|min:0|max:999',
            'back_shot' => 'required|numeric|min:0|max:999',
            'torso' => 'required|numeric|min:0|max:999',
            'total_length' => 'required|numeric|min:0|max:999',
            'leg' => 'required|numeric|min:0|max:999',
            'interior_leg' => 'required|numeric|min:0|max:999',
            'leg_upper' => 'required|numeric|min:0|max:999',
            'leg_lower' => 'required|numeric|min:0|max:999',
            'calf' => 'required|numeric|min:0|max:999',
            'rib_chest' => 'nullable|numeric|min:0|max:999',
            'rib_rack' => 'nullable|numeric|min:0|max:999',
            'chest' => 'required|numeric|min:0|max:999'
        ];

        if ($request->query()['costillar'] == 'con_costillar') {
            $validator = Validator::make($decimalMeasuresValues, $rulesMeasuresCostillar);
        }else {
            $validator = Validator::make($decimalMeasuresValues, $rulesMeasuresSinCostillar);
        }
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            $validatedMeasuresData = $validator->validated();
        }

        //Crida al procés d'impressió del pdf amb les dades introduïdes per l'usuari i el descarrega per l'usuari
        if ($request->query()['costillar'] == 'con_costillar') {
            $pdf = $measuresVideosToPdfAction(
                app()->getLocale(),
                $request->query()['measure_code'],
                $request->query()['nombre'],
                str_replace('.00', '', $request->query()['altura']),
                str_replace('.00', '', $request->query()['peso']),
                $request->query()['edad'],
                $request->query()['genero'],
                $request->query()['mono_marina'],
                $validatedMeasuresData['talla_mono'],
                $request->query()['costillar'],
                $request->query()['ajuste_mono'],
                $validatedMeasuresData['shoulder'],
                $validatedMeasuresData['sleeve_length'],
                $validatedMeasuresData['sleeve_interior'],
                $validatedMeasuresData['neck'],
                $validatedMeasuresData['biceps'],
                $validatedMeasuresData['forearm'],
                $validatedMeasuresData['waist'],
                $validatedMeasuresData['hip'],
                $validatedMeasuresData['torso_length'],
                $validatedMeasuresData['back_shot'],
                $validatedMeasuresData['torso'],
                $validatedMeasuresData['total_length'],
                $validatedMeasuresData['leg'],
                $validatedMeasuresData['interior_leg'],
                $validatedMeasuresData['leg_upper'],
                $validatedMeasuresData['leg_lower'],
                $validatedMeasuresData['calf'],
                $validatedMeasuresData['rib_chest'],
                $validatedMeasuresData['rib_rack'],
                '',
            );
        } elseif ($request->query()['costillar'] == 'sin_costillar') {
            $pdf = $measuresVideosToPdfAction(
                app()->getLocale(),
                $request->query()['measure_code'],
                $request->query()['nombre'],
                str_replace('.00', '', $request->query()['altura']),
                str_replace('.00', '', $request->query()['peso']),
                $request->query()['edad'],
                $request->query()['genero'],
                $request->query()['mono_marina'],
                $validatedMeasuresData['talla_mono'],
                $request->query()['costillar'],
                $request->query()['ajuste_mono'],
                $validatedMeasuresData['shoulder'],
                $validatedMeasuresData['sleeve_length'],
                $validatedMeasuresData['sleeve_interior'],
                $validatedMeasuresData['neck'],
                $validatedMeasuresData['biceps'],
                $validatedMeasuresData['forearm'],
                $validatedMeasuresData['waist'],
                $validatedMeasuresData['hip'],
                $validatedMeasuresData['torso_length'],
                $validatedMeasuresData['back_shot'],
                $validatedMeasuresData['torso'],
                $validatedMeasuresData['total_length'],
                $validatedMeasuresData['leg'],
                $validatedMeasuresData['interior_leg'],
                $validatedMeasuresData['leg_upper'],
                $validatedMeasuresData['leg_lower'],
                $validatedMeasuresData['calf'],
                '',
                '',
                $validatedMeasuresData['chest'],
            );
        }

        $main_sizes = [
            'height_size' => $request->input('talla_altura'),
            'weight_size' => $request->input('talla_peso'),
            'medium_size' => $request->input('talla_media'),
            'chest_size' => $request->input('talla_pecho'),
            'waist_size' => $request->input('talla_cintura'),
            'hip_size' => $request->input('talla_cadera'),
        ];

        //Important actualitzar les dades abans de descarregar el PDF (output), si es canvia l'ordre falla perquè interpreta un return i no crida a la funció
        $this->updateMesures($validatedMeasuresData, $request->query()['measure_code'], $main_sizes);

        //Descarrega del pdf editat
        if (app()->getLocale() == 'es') {
            $pdf->Output('Medidas ' . $request->query()['nombre'] . '.pdf', "D");
        } else {
            $pdf->Output('Measures ' . $request->query()['nombre'] . '.pdf', "D");
        }

    }

    // Funció per actualitzar la informació d'unes mesures existents a la base de dades.
    // Aquesta funció es crida des de la funció downloadPdf, des d'on validem les dades introduïdes per l'usuari (no fa falta validar-les de nou, utilitzem les dades ja validades)
    public function updateMesures(array $validatedMeasures, string $measure_code, array $main_sizes)
    {
        //Inserir informació a la base de dades mitjançant el model Measures
        $measures = Measures::where('measure_code', $measure_code)->first();
        if ($measures == null)
            return redirect()->route('measures-videos.index');

        if (auth('customer')->check()) {
            $customer = auth('customer')->user();
            $measures->customer_id = $customer->id;
        } else {
            $measures->customer_id = null;
        }
        $measures->shoulder = $validatedMeasures['shoulder'];
        $measures->sleeve_length = $validatedMeasures['sleeve_length'];
        $measures->sleeve_interior = $validatedMeasures['sleeve_interior'];
        $measures->neck = $validatedMeasures['neck'];
        $measures->biceps = $validatedMeasures['biceps'];
        $measures->forearm = $validatedMeasures['forearm'];
        $measures->waist = $validatedMeasures['waist'];
        $measures->hip = $validatedMeasures['hip'];
        $measures->torso_length = $validatedMeasures['torso_length'];
        $measures->back_shot = $validatedMeasures['back_shot'];
        $measures->torso = $validatedMeasures['torso'];
        $measures->total_length = $validatedMeasures['total_length'];
        $measures->leg = $validatedMeasures['leg'];
        $measures->interior_leg = $validatedMeasures['interior_leg'];
        $measures->leg_upper = $validatedMeasures['leg_upper'];
        $measures->leg_lower = $validatedMeasures['leg_lower'];
        $measures->calf = $validatedMeasures['calf'];

        //Mesures que varien depenent del costillar (nullable).
        //El costillar, aligual que les dades de l'usuari, no pot ser modificat, així que llegim el valor que hi havia guardat a la bd directament
        if ($measures->rib_protector == true) {
            $measures->rib_chest = $validatedMeasures['rib_chest'];
            $measures->rib_rack = $validatedMeasures['rib_rack'];
        } else {
            $measures->chest = $validatedMeasures['chest'];
        }

        $measures->height_size = $main_sizes['height_size'];
        $measures->weight_size = $main_sizes['weight_size'];
        $measures->medium_size = $this->calculateMediumSize($main_sizes['height_size'], $main_sizes['weight_size'], $main_sizes['chest_size'], $main_sizes['waist_size'], $main_sizes['hip_size']);
        $measures->final_size = $this->calculateFinalSize($main_sizes['height_size'], $main_sizes['weight_size'], $main_sizes['waist_size'], $measures->medium_size);
        $measures->chest_size = $main_sizes['chest_size'];
        $measures->waist_size = $main_sizes['waist_size'];
        $measures->hip_size = $main_sizes['hip_size'];

        $measures->update();
    }

    private function calculateMediumSize($height_size, $weight_size, $chest_size, $waist_size, $hip_size)
    {
        $values = [$height_size, $weight_size, $chest_size, $waist_size, $hip_size];
        sort($values);
        $count = count($values);
        $mid = (int)floor(($count - 1) / 2);
        if ($count % 2 == 0) {
            return ($values[$mid] + $values[$mid + 1]) / 2;
        } else {
            return $values[$mid];
        }
    }

    private function calculateFinalSize($height_size, $weight_size, $waist_size, $medium_size) : string
    {
        $final_size = $medium_size;
        if ($height_size > $medium_size) {
            $final_size .= 'L';
        }
        if ($weight_size < $waist_size) {
            $final_size .= 'EX';
        }
        if ($waist_size < $weight_size) {
            $final_size .= 'S';
        }
        return $final_size;
    }


}
