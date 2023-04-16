{{-- PORTADA (STEP 0) --}}
<div id="step_0" x-bind:class="{ 'hidden' : step != 0 }" class="h-[calc(100vh-42px)]">
    <div class="bg-cover w-full h-[calc(100vh-125px)] bg-center"
         style="background-image: url('{{asset('measures-videos/images/main-background.jpg')}}')">
        <div
            class="container h-[calc(100vh-125px)] max-w-md md:mx-auto flex flex-col justify-center items-center
            align-middle align-items-center pl-8 pr-8 md:p-0">

            <input placeholder="{{__('Nombre Completo')}}" x-model="nombre"
                   @input="localStorage.setItem('nombre', $event.target.value)" x-ref="nombre" name="nombre"
                   maxlength="45"
                   type="text"
                   class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  lg:my-2 outline-none">
            <div style="white-space:nowrap; width: 100%;">
                <div style="width: 40%;display: inline-block;">
                    <input placeholder="{{__('Height (cm.)')}}" x-model="altura"
                           @input="localStorage.setItem('altura', $event.target.value)" x-ref="altura" name="altura"
                           maxlength="3" onkeydown="return isFloat(event)" type="text"
                           class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
                    <span class="inline text-white text-right" style="margin-left: 4px;">cm</span>
                </div>
                <div style="width: 40%;display: inline-block;margin-left: 12%;">
                    <input placeholder="{{__('Weight (kg.)')}}" x-model="peso"
                           @input="localStorage.setItem('peso', $event.target.value)" x-ref="peso"
                           onkeydown="return isFloat(event)" type="text" name="peso" maxlength="5"
                           class="input-type-text  input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
                    <span class="inline text-white text-right" style="margin-left: 4px;">kg</span>
                </div>
            </div>
            <input placeholder="{{__('Edad')}}" x-model="edad"
                   @input="localStorage.setItem('edad', $event.target.value)" x-ref="edad"
                   onkeydown="return isFloat(event)"
                   type="text" name="edad"
                   maxlength="3"
                   class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  outline-none">
            <input placeholder="{{__('E-mail')}}" x-model="email"
                   @input="localStorage.setItem('email', $event.target.value)" x-ref="email" type="email"
                   name="email"
                   maxlength="45"
                   class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1  outline-none">
            <select name="genero" x-model="genero" @change="localStorage.setItem('genero', $event.target.value)"
                    x-ref="genero" class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
                <option value="">{{__("Género")}}</option>
                <option value="hombre">{{__("Masculino")}}</option>
                <option value="mujer">{{__("Femenino")}}</option>
            </select>
            <label
                class="text-white text-center xl:text-lg text-sm bg-black">{{__("¿Tienes un mono Marina?")}}</label>
            <select x-model="mono_marina" @change="localStorage.setItem('mono_marina', $event.target.value)"
                    name="mono_marina" class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
                <option value="mono_marina_no">{{__("No")}}</option>
                <option value="mono_marina_si">{{__("Si")}}</option>
            </select>
            <input x-model="talla_mono_marina" @input="localStorage.setItem('talla_mono_marina', $event.target.value)"
                   x-bind:class="{ 'hidden' : mono_marina != 'mono_marina_si' }"
                   placeholder="{{__('Talla')}}"
                   maxlength="20"
                   name="talla_mono" type="text" class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
            <label
                class="text-white text-center xl:text-lg text-sm bg-black">{{__("¿Medidas tomadas con costillar? (Karting)")}}</label>
            <select x-model="costillar" @change="localStorage.setItem('costillar', $event.target.value)"
                    name="costillar" class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
                <option value="con_costillar">{{__("Si")}}</option>
                <option value="sin_costillar">{{__("No")}}</option>
            </select>
            <label
                class="text-white text-center xl:text-lg text-sm bg-black">{{__("Ajuste del mono")}}</label>
            <select x-model="ajuste_mono" name="ajuste_mono" @change="localStorage.setItem('ajuste_mono', $event.target.value)"
                    class="input-type-text input-front-page pt-1 xl:pb-1  !pb-1 my-1  my-1 lg:my-2 outline-none">
                <option value="mono_ajustado">{{__("Ajustado (Slimfit)")}}</option>
                <option value="mono_regular">{{__("Regular")}}</option>
                <option value="mono_holgado">{{__("Holgado")}}</option>
            </select>
            <div class="mb-3 flex items-center text-xs input-front-page" x-ref="lopd">
                <input type="checkbox" @change="localStorage.setItem('lopd', $event.target.value)" required name="lopd"
                       id="lopd" x-model="lopd">
                <label class="ml-2" for="lopd">
                    <span class="tracking-normal text-sm text-white">{{ __("I have read and accept the") }}</span>
                    <a class="underline tracking-normal text-white text-sm"
                       href="{{ route('external', ['slug' => app()->getLocale() === 'es' ? 'informacion#privacidad' : 'information#privacy-policy']) }}"
                       target="_blank">
                        {{  __('Data Protection information') }}
                    </a>
                </label>
            </div>
        </div>
    </div>
    <div class="p-4 bg-black" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;">
        <a class="mx-auto text-center block button-red hover:bg-brand-red-dark w-52 py-3 px-4 text-lg"
           x-on:click="FrontPageToVideos()"
           href="#">{{__('Continuar')}}</a>
    </div>
</div>
