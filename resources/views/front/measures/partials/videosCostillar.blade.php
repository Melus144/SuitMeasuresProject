{{-- VIDEOS AMB COSTILLAR --}}
@foreach($pasos_costillar as $key => $paso)
    <div id="step_costillar_{{$key}}"
         x-bind:class="{ 'hidden' : step != {{$key}} || costillar != 'con_costillar' }"
         class="hide h-[calc(100vh-42px)]">
        <div class="w-full h-[calc(100vh-140px)] bg-black">
            {{-- Indicador de progrés passos --}}
            <div class="step-indicator pt-2">
                <h4 class="text-white text-center">{{$key}}/{{count($pasos_costillar)}} {{__($paso['title'])}}</h4>
            </div>
            <div class="mb-1 text-base font-medium text-yellow-700 dark:text-yellow-500"></div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
                <div class="bg-brand-red h-2.5 rounded-full"
                     style="width: {{100/count($pasos_costillar)*$key}}%;"></div>
            </div>

            {{-- Reproductor de Video --}}
            <div
                class="video-player
                                relative container overflow-hidden h-[calc(100vh-179px)] max-w-6xl md:mx-auto flex flex-col justify-center items-center align-middle align-items-center">
                <video id="video_costillar_{{$key}}"
                       x-ref="con_costillar_{{$key}}_video"
                       muted
                       controls
                       class="h-[calc(100vh-179px)]">
                    <source src="{{asset('measures-videos/videos/'.$paso['video'].'.m4v')}}"
                            type="video/mp4">
                </video>

                <div
                    class="flex items-center bg-black bg-opacity-50 bottom-0 w-full text-center justify-center text-white mb-2 md:mb-14  p-3">
                    {{__($paso['subtitle'])}}
                </div>
            </div>

        </div>
        <div class="p-4">
            <div class="p-1 flex items-center justify-center">
                <div>
                    <a class="mx-auto text-center block transition button-red hover:bg-brand-red-dark w-14 h-14 py-3 px-4 text-lg"
                       x-on:click="previous_step()"
                       href="#">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="215.4px"
                             height="22px" viewBox="0 0 215.4 459.8"
                             style="overflow:visible;enable-background:new 0 0 215.4 459.8; width: 22px; margin-top:4px;"
                             xml:space="preserve">
                                            <defs>
                                            </defs>
                            <g>
                                <polygon class="st0"
                                         points="193.7,459.8 0,229.9 193.7,0 215.4,18.3 37.1,229.9 215.4,441.5     "/>
                            </g></svg>
                    </a>
                </div>
                <div>
                    <div class="flex mx-4" x-ref="con_costillar_{{$paso['input']}}">
                        <input name="con_costillar[{{$paso['input']}}]"
                               x-model="dades.con_costillar.{{$paso['input']}}"
                               @input="localStorage.setItem('dades', JSON.stringify(dades))" placeholder="0"
                               x-ref="con_costillar_{{$key}}_input"
                               type="text"
                               maxlength="5"
                               {{-- S'utiliza l'event "keypress" en comptes de "keydown" a causa de que "keydown" no detecta correctament alguns caràcters especials com la coma i el punt --}}
                               onkeypress="return isFloat(event)"
                               class="text-2xl text-right w-36 h-14 py-2 px-1 text-black leading-tight outline-none">
                        <span
                            class="h-14 w-32 bg-white text-md flex items-center pt-1.5">cm</span>
                        {{-- Si hi ha mes unitats de mesura en un futur, enviar-ho vía array controlador i llegir aqui la unitat de mesura --}}
                    </div>
                </div>
                <div>
                    <a class="mx-auto text-center block button-red transition-all hover:bg-brand-red-dark w-14 h-14 py-3 px-4 text-lg"
                       x-on:click="next_step('con_costillar', '{{$paso['input']}}')"
                       href="#">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="215.4px"
                             height="22px" viewBox="0 0 215.4 459.8"
                             style="overflow:visible;enable-background:new 0 0 215.4 459.8; width: 22px; margin-top: 4px;"
                             xml:space="preserve">
                                            <defs>
                                            </defs>
                            <polygon class="st0"
                                     points="21.7,0 215.4,229.9 21.7,459.8 0,441.5 178.3,229.9 0,18.3 "/>
                                        </svg>
                    </a>
                </div>
            </div>
                {{-- TODO In a future: Normally between   <p class="text-xs text-white text-center">Normally between</p>   --}}
        </div>
    </div>
@endforeach
