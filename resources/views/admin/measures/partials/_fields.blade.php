@push('styles')
    <style>
        .select2-container--default .select2-selection--single {
            height: 37px;
            padding-top: 3px;
        }
    </style>
@endpush

<div class="row g-3">
    <div class="col-md-3 mb-3 form-group">
        <label for="measure_code" class="form-label">Measure Code</label>
        <input disabled type="text" class="form-control" id="measure_code" name="measure_code"
               value="{{old('measure_code', $measures->measure_code)}}">
    </div>

    <div class="col-md-3 mb-3 form-group">
        <label for="customer_id" class="form-label">Customer ID</label>
        <input disabled type="text" class="form-control" id="lastname" name="lastname"
               value="{{old('customer_id', $measures->customer_id)}}">
    </div>

    <div class="col-md-3 mb-3 form-group">
        <label for="language" class="form-label">Language</label>
        <input disabled type="text" class="form-control" id="language" name="language"
               value="{{old('language', $measures->language)}}">
    </div>

    <div class="col-md-3 mb-3 form-group">
        <label for="name" class="form-label">Name</label>
        <input disabled type="text" class="form-control" id="name" name="name"
               value="{{old('name', $measures->name)}}">
    </div>

</div>
<div class="row g-3">
    <div class="col-md-4 mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input disabled type="email" class="form-control" id="email" name="email"
               value="{{old('email', $measures->email)}}">
    </div>

    <div class="col-md-3 mb-3">
        <label for="height" class="form-label">Height</label>
        <input disabled type="number" class="form-control" id="height" name="height"
               value="{{old('email', $measures->height)}}">
    </div>

    <div class="col-md-3 mb-3">
        <label for="weight" class="form-label">Weight</label>
        <input disabled type="number" class="form-control" id="weight" name="weight"
               value="{{old('weight', $measures->weight)}}">
    </div>

    <div class="col-md-3 mb-3">
        <label for="gender" class="form-label">Gender</label>
        <input disabled type="text" class="form-control" id="gender" name="gender"
               value="{{old('gender', $measures->gender)}}">
    </div>

    <div class="col-md-3 mb-3">
        <label for="age" class="form-label">Age</label>
        <input disabled type="number" class="form-control" id="age" name="age"
               value="{{old('age', $measures->age)}}">
    </div>

    <div class="col-md-3 mb-3 form-group">
        <label for="rib_protector" class="form-label">Have marina suit?</label>
        @if($measures->have_marina_suit == '0')
            <input readonly type="text" class="form-control" id="have_marina_suit" name="have_marina_suit"
                   value="No">
        @else
            <input readonly type="text" class="form-control" id="have_marina_suit   " name="have_marina_suit"
                   value="Si">
        @endif
    </div>

    <div class="col-md-3 mb-3">
        <label for="age" class="form-label">Marina Suit Size</label>
        <input disabled type="text" class="form-control" id="age" name="age"
               value="{{old('age', $measures->marina_suit_size)}}">
    </div>

    <div class="col-md-3 mb-3 form-group">
        <label for="rib_protector" class="form-label">Costillar:</label>
        @if($measures->rib_protector == '0')
            <input readonly type="text" class="form-control" id="rib_protector" name="rib_protector"
                   value="No">
        @else
            <input readonly type="text" class="form-control" id="rib_protector" name="rib_protector"
                   value="Si">
        @endif

    </div>
    <div class="col-md-3 mb-3 form-group">
        <label for="suit_fitting" class="form-label">Suit fitting</label>
        <input readonly type="text" class="form-control" id="suit_fitting" name="suit_fitting"
               value="{{old('suit_fitting', str_replace("_"," ", $measures->suit_fitting))}}">
    </div>
</div>
    <hr>
<h4>Automatic Measures</h4>
<div class="row">
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>MAIN MEASURES</th>
                <th>CUSTOMER SIZES</th>
                <th>SIZE FOUND</th>
                <th>DIFFERENCES</th>
                <th>DIFFERENCE REGARDING THE MEDIUM SIZE</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>HEIGHT</td>
                <td>{{$measures->height}} cm</td>
                <td>{{$measures->height_size}}</td>
                <td></td>
                <td>{{$measures->medium_size - $measures->height_size}}</td>
                <td>{{$measures->height + ($measures->medium_size - $measures->height_size)}} cm</td>
            </tr>
            <tr>
                <td>WEIGHT</td>
                <td>{{$measures->weight}} cm</td>
                <td>{{$measures->weight_size}}</td>
                <td></td>
                <td>{{$measures->medium_size - $measures->weight_size}}</td>
                <td>{{$measures->weight + ($measures->medium_size - $measures->weight_size)}} cm</td>
            </tr>
            <tr>
                <td>CHEST</td>
                @if($measures->rib_protector == '0')
                    <td>{{$measures->chest}} cm</td>
                    <td>{{$measures->chest_size}}</td>
                    <td></td>
                    <td>{{$measures->medium_size - $measures->chest_size}}</td>
                    <td>{{$measures->chest + ($measures->medium_size - $measures->chest_size)}} cm</td>
                @else
                    <td>{{$measures->rib_chest}} cm</td>
                    <td>{{$measures->chest_size}}</td>
                    <td></td>
                    <td>{{$measures->medium_size - $measures->chest_size}}</td>
                    <td>{{$measures->rib_chest + ($measures->medium_size - $measures->chest_size)}} cm</td>

                @endif
            </tr>
            <tr>
                <td>WAIST</td>
                <td>{{$measures->waist}} cm</td>
                <td>{{$measures->waist_size}}</td>
                <td></td>
                <td>{{$measures->medium_size - $measures->waist_size}}</td>
                <td>{{$measures->waist + ($measures->medium_size - $measures->waist_size)}} cm</td>
            </tr>
            <tr>
                <td>HIP</td>
                <td>{{$measures->hip}} cm</td>
                <td>{{$measures->hip_size}}</td>
                <td></td>
                <td>{{$measures->medium_size - $measures->hip_size}}</td>
                <td>{{$measures->hip + ($measures->medium_size - $measures->hip_size)}} cm</td>

            </tr>
            <tr>
                <td>MEDIUM SIZE</td>
                <td colspan="6">
                    <div class="col-md-12 text-center">
                        <h4><strong>{{$measures->medium_size}} </strong></h4>
                    </div>
                </td>
            </tr>

            <tr>
                <td>FINAL SIZE</td>
                <td colspan="6">
                    <div class="col-md-12 text-center">
                        <h4><strong>{{$measures->final_size}} </strong></h4>
                        <p><em>Especificaciones:
                                @if (strpos($measures->final_size, 'L') !== false)
                                    Large
                                @endif
                                @if (strpos($measures->final_size, 'EX') !== false)
                                    Extrasize
                                @endif
                                @if (strpos($measures->final_size, 'S') !== false)
                                    Slim Fit
                                @endif
                            </em></p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>All measures</h4>
        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="{{$measures->shoulder}}" class="form-label">Shoulder</label>
                <input type="text" class="form-control" id="{{$measures->shoulder}}" disabled
                    value="{{$measures->shoulder}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="shoulder_wrong"
                           id="shoulder_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['shoulder'] == 1) checked @endif>
                    <label class="form-check-label" for="shoulder_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="sleeve_length" class="form-label">Sleeve Length</label>
                <input type="text" class="form-control" id="sleeve_length" disabled
                       value="{{$measures->sleeve_length}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="sleeve_length_wrong"
                           id="sleeve_length_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['sleeve_length'] == 1) checked @endif>
                    <label class="form-check-label" for="sleeve_length_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="sleeve_interior" class="form-label">Sleeve Interior</label>
                <input type="text" class="form-control" id="sleeve_interior" disabled
                       value="{{$measures->sleeve_interior}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="sleeve_interior_wrong"
                           id="sleeve_interior_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['sleeve_interior'] == 1) checked @endif>
                    <label class="form-check-label" for="sleeve_interior_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="neck" class="form-label">Neck</label>
                <input type="text" class="form-control" id="neck" disabled
                       value="{{$measures->neck}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="neck_wrong"
                           id="neck_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['neck'] == 1) checked @endif>
                    <label class="form-check-label" for="neck_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="biceps" class="form-label">Biceps</label>
                <input type="text" class="form-control" id="biceps" disabled
                       value="{{$measures->biceps}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="biceps_wrong"
                           id="biceps_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['biceps'] == 1) checked @endif>
                    <label class="form-check-label" for="biceps_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="forearm" class="form-label">Forearm</label>
                <input type="text" class="form-control" id="forearm" disabled
                       value="{{$measures->forearm}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="forearm_wrong"
                           id="forearm_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['forearm'] == 1) checked @endif>
                    <label class="form-check-label" for="forearm_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="waist" class="form-label">Waist</label>
                <input type="text" class="form-control" id="waist" disabled
                       value="{{$measures->waist}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="waist_wrong"
                           id="waist_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['waist'] == 1) checked @endif>
                    <label class="form-check-label" for="waist_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="hip" class="form-label">Hip</label>
                <input type="text" class="form-control" id="hip" disabled
                       value="{{$measures->hip}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hip_wrong"
                           id="hip_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['hip'] == 1) checked @endif>
                    <label class="form-check-label" for="hip_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="torso_length" class="form-label">Torso Length</label>
                <input type="text" class="form-control" id="torso_length" disabled
                       value="{{$measures->torso_length}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="torso_length_wrong"
                           id="torso_length_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['torso_length'] == 1) checked @endif>
                    <label class="form-check-label" for="torso_length_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="back_shot" class="form-label">Back Shot</label>
                <input type="text" class="form-control" id="back_shot" disabled
                       value="{{$measures->back_shot}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="back_shot_wrong"
                           id="back_shot_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['back_shot'] == 1) checked @endif>
                    <label class="form-check-label" for="back_shot_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="torso" class="form-label">Torso</label>
                <input type="text" class="form-control" id="torso" disabled
                       value="{{$measures->torso}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="torso_wrong"
                           id="torso_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['torso'] == 1) checked @endif>
                    <label class="form-check-label" for="torso_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="total_length" class="form-label">Total Length</label>
                <input type="text" class="form-control" id="total_length" disabled
                       value="{{$measures->total_length}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="total_length_wrong"
                           id="total_length_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['total_length'] == 1) checked @endif>
                    <label class="form-check-label" for="total_length_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="leg" class="form-label">Leg</label>
                <input type="text" class="form-control" id="leg" disabled
                       value="{{$measures->leg}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="leg_wrong"
                           id="leg_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['leg'] == 1) checked @endif>
                    <label class="form-check-label" for="leg_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <label for="interior_leg" class="form-label">Interior Leg</label>
                <input type="text" class="form-control" id="interior_leg" disabled
                       value="{{$measures->interior_leg}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="interior_leg_wrong"
                           id="interior_leg_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['interior_leg'] == 1) checked @endif>
                    <label class="form-check-label" for="interior_leg_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="leg_upper" class="form-label">Leg Upper</label>
                <input type="text" class="form-control" id="leg_upper" disabled
                       value="{{$measures->leg_upper}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="leg_upper_wrong"
                           id="leg_upper_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['leg_upper'] == 1) checked @endif>
                    <label class="form-check-label" for="leg_upper_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="leg_lower" class="form-label">Leg Lower</label>
                <input type="text" class="form-control" id="leg_lower" disabled
                       value="{{$measures->leg_lower}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="leg_lower_wrong"
                           id="leg_lower_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['leg_lower'] == 1) checked @endif>
                    <label class="form-check-label" for="leg_lower_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="calf" class="form-label">Calf</label>
                <input type="text" class="form-control" id="calf" disabled
                       value="{{$measures->calf}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="calf_wrong"
                           id="calf_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['calf'] == 1) checked @endif>
                    <label class="form-check-label" for="calf_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="rib_chest" class="form-label">Rib Chest</label>
                <input type="text" class="form-control" id="rib_chest" disabled
                       value="{{$measures->rib_chest}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="rib_chest_wrong"
                           id="rib_chest_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['rib_chest'] == 1) checked @endif>
                    <label class="form-check-label" for="rib_chest_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="rib_rack" class="form-label">Rib Rack</label>
                <input type="text" class="form-control" id="rib_rack" disabled
                       value="{{$measures->rib_rack}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="rib_rack_wrong"
                           id="rib_rack_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['rib_rack'] == 1) checked @endif>
                    <label class="form-check-label" for="rib_rack_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="chest" class="form-label">Chest</label>
                <input type="text" class="form-control" id="chest" disabled
                       value="{{$measures->chest}} cm">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="chest_wrong"
                           id="chest_wrong" value="1" @if(isset($measures->wrong_measurements) && json_decode($measures->wrong_measurements, true)['chest'] == 1) checked @endif>
                    <label class="form-check-label" for="chest_wrong">
                        {{__("Wrong measurement")}}
                    </label>
                </div>
            </div>
</div>


