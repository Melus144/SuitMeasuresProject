<?php

namespace Domain\Measures\Models;

use Illuminate\Database\Eloquent\Model;

class Measures extends Model
{
    protected $table = 'measures';
    protected $fillable = [
        'customer_id',
        'language',
        'name',
        'email',
        'height',
        'weight',
        'age',
        'gender',
        'have_marina_suit',
        'marina_suit_size',
        'rib_protector',
        'suit_fitting',
        'shoulder',
        'sleeve_length',
        'sleeve_interior',
        'neck',
        'biceps',
        'forearm',
        'waist',
        'hip',
        'torso_length',
        'back_shot',
        'torso',
        'total_length',
        'leg',
        'interior_leg',
        'leg_upper',
        'leg_lower',
        'calf',
        //Mesures amb costillar (nullable)
        'rib_chest',
        'rib_rack',
        //Mesures sense costillar (nullable)
        'chest'
    ];

    public function generateMeasureCode()
    {

        $codigo = '';
        $longitudCodigo = rand(8,12);
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        for ($i = 0; $i < $longitudCodigo; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        $existeCodigo = true;

        while ($existeCodigo) {
            $codigoExistente = Measures::where('measure_code', $codigo)->first();
            if ($codigoExistente) {
                $codigo = $this->generateMeasureCode();
            } else {
                $existeCodigo = false;
            }
        }

        return $codigo;
    }

}
