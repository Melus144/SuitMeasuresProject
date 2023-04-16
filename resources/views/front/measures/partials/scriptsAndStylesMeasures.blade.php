<!-- Alpine Plugins -->
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

<script defer type="text/javascript" src="{{asset('dist/front/js/klaro/klaroConfig.js')}}"></script>
<script defer type="text/javascript" src="https://cdn.kiprotect.com/klaro/v0.7/klaro.js"></script>

<!-- Styles -->
<link href="{{ asset('dist/front/css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.kiprotect.com/klaro/v0.7/klaro.min.css"/>
<style type="text/css">
    .st0 {
        fill: #FFFFFF;
    }

    html {
        height: --webkit-fill-available;
        max-height: -webkit-fill-available;
    }

    body, #app {
        font-family: 'Montserrat', sans-serif;
        font-style: normal;
        height: 100vh;
        height: --webkit-fill-available;
        max-height: -webkit-fill-available;
    }

    {{-- Clases para inputs de la portada --}}
         .input-front-page {
        border: 3px solid transparent;
        }

        .input-front-page:focus {
        border: 3px solid transparent;
        }

    .front-page-warning-input {
        animation: pulse 3s;
        border: 3px solid #b02a37;
    }

    @keyframes pulse {
        0% {
            border: 3px solid transparent;
        }
        25% {
            border: 3px solid #b02a37;
        }
        50% {
            border: 3px solid transparent;
        }
        100% {
            border: 3px solid #b02a37;
        }
    }

    {{-- Clase + Animacion de aviso en input de medidas. Clase activada desde funciones Alpine (addClassToMeasureInput) --}}
        .measure-warning-input {
        animation: shake 0.5s;
        box-shadow: 0 0 2px 4px #b02a37;
    }

    @keyframes shake {
        10%, 90% {
            transform: translate3d(-1px, 0, 0);
        }
        20%, 80% {
            transform: translate3d(2px, 0, 0);
        }
        30%, 50%, 70% {
            transform: translate3d(-2px, 0, 0);
        }
        40%, 60% {
            transform: translate3d(2px, 0, 0);
        }
    }

    .grid-container-columns {
        display: grid;
        grid-template-columns: auto auto auto;
        background-color: #2196F3;
        padding: 10px;
    }

    .grid-container-rows {
        display: grid;
        grid-template-rows: auto auto auto;
        background-color: #2196F3;
        padding: 10px;
        width: 33%;
    }

    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 20px;
        font-size: 30px;
        text-align: center;
    }

    @media (min-width: 1024px) {
        .column-20 {
            float: left;
            width: 20%;
        }

        .column-30 {
            float: left;
            width: 30%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    }

</style>

@livewireStyles

@livewireScripts
<script>
        function measures() {
        return {
            mobileShow: false,
            mobileBreadcrumb: [],
            mobileCurrentItem: null,
            showMenu: null,
            selectedItem: null,
            secondColumnItem: null,
            thirdColumnItem: null,
            picture: null,
            windowHeight: window.innerHeight,
            goOrHide(item) {
                if (this.showMenu == item) {
                    this.resetMenu();
                } else {
                    this.showMenu = item;
                    if (item === 'search') {
                        this.$nextTick(() => {
                            this.$refs.input.focus();
                        })
                    }
                }
            },
            resetMenu() {
                this.showMenu = null;
                this.selectedItem = null;
                this.secondColumnItem = null;
                this.thirdColumnItem = null;
                this.picture = null;
            },
        }
    }
    {{--Funció javascript per validar inputs numèrics (portada i mesures). També accepta comes i punts per decimals si s'utilitza l'event "keypress", però no si s'utilitza "keydown" --}}
    function isFloat(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        return !((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46 && charCode !== 44);
    }

</script>

