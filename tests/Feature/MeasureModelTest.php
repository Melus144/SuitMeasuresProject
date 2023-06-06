<?php
use PHPUnit\Framework\TestCase;
use Domain\Measures\Models\Measures;

class MeasureModelTest extends TestCase
{
    public function testGuardarRegistroDeMedida()
    {
        // Crea una instancia del modelo Measures
        $measure = new Measures();

        // Genera un código de medida
        $measureCode = $measure->generateMeasureCode();

        // Crea un nuevo registro de medida con datos de prueba
        $data = [
            'customer_id' => 1,
            'language' => 'es',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'height' => '180 cm',
            'weight' => '75 kg',
            'age' => '30 años',
            'gender' => 'hombre',
            'have_marina_suit' => 'mono_marina_si',
            'marina_suit_size' => 'M',
            'rib_protector' => 'con_costillar',
            'suit_fitting' => 'mono_ajustado',
            'shoulder' => '50 cm',
            'sleeve_length' => '40 cm',
            'sleeve_interior' => '60 cm',
            'neck' => '38 cm',
            'biceps' => '30 cm',
            'forearm' => '25 cm',
            'waist' => '80 cm',
            'hip' => '100 cm',
            'torso_length' => '70 cm',
            'back_shot' => '50 cm',
            'torso' => '60 cm',
            'total_length' => '110 cm',
            'leg' => '80 cm',
            'interior_leg' => '75 cm',
            'leg_upper' => '55 cm',
            'leg_lower' => '50 cm',
            'calf' => '35 cm',
            'rib_chest' => '90 cm',
            'rib_rack' => '85 cm',
            'chest' => '95 cm',
        ];

        $measure->fill($data);
        $measure->measure_code = $measureCode;
        $measure->save();

        // Verifica si se guardó el registro correctamente
        $this->assertTrue($measure->exists);
    }
}

