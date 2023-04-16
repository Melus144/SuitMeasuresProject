{{-- PORTADA (STEP 0) --}}
<div id="step_0" x-bind:class="{ 'hidden' : step != 0 }" class="h-[calc(100vh-42px)]">
    <div class="bg-cover w-full h-[calc(100vh-125px)] bg-center">
        {{--TODO: MILLORES RESPONSIVE: AFEGIR MÉS CLASSES RESPONSIVE PER ALTURA (S'HA ADAPTAT AMPLADA AMB PADDINGS I SELECTOR MD (TOT LO QUE NO ES MOVIL)--}}
        <div
            class="container h-[calc(100vh-125px)] max-w-md md:mx-auto flex flex-col justify-center items-center align-middle align-items-center pl-8 pr-8 md:p-0">

            <div class="text-center pt-6 leading-7 lg:hidden">
                <h3 class="text-white text-2xl font-semibold">{{__("Your measures review")}}</h3>
                <p class="text-white text-base mx-4 mt-2">{{__("Measure code:") }} {{$measure_code}}</p>
            </div>
            <div class="text-center pt-6 leading-7 hidden lg:block">
                <h3 class="text-white text-2xl font-semibold">{{__("Your measures review")}}</h3>
                <p class="text-white text-base mx-4 mt-2">{{__("Measure code:") }} {{$measure_code}}</p>
            </div>

            <div class="p-4 bg-black">
                <a class="mx-auto text-center block button-red hover:bg-brand-red-dark w-52 py-3 px-4 text-lg"
                   x-on:click="step=1;"
                   href="#">{{__('Continuar')}}</a>
            </div>
            <div class="p-4 bg-black">

                <a class="mx-auto text-center block button-red hover:bg-brand-red-dark w-52 py-3 px-4 text-lg"
                   x-on:click="backToReview(costillar)"
                   href="#">{{__('Volver al resumen')}}</a>
            </div>
        </div>
    </div>
</div>
