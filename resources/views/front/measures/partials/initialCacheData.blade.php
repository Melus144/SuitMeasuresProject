{{--Utilitzem localstorage(caché) per guardar la informació de l'usuari en el formulari. Inclou funcions alpine pel tractament de dades--}}
<div x-data="
            {
                measure_code: <?php echo str_replace('"', "'", json_encode($measure_code, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                step: localStorage.getItem('step') || <?php echo json_encode($step, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT); ?>,

                costillar: localStorage.getItem('costillar') || <?php echo str_replace('"', "'", json_encode($costillar, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                mono_marina: localStorage.getItem('mono_marina') || <?php echo str_replace('"', "'", json_encode($have_marina_suit, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_mono_marina: localStorage.getItem('talla_mono_marina') || <?php echo str_replace('"', "'", json_encode($marina_suit_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                ajuste_mono: localStorage.getItem('ajuste_mono') || <?php echo str_replace('"', "'", json_encode($suit_fitting, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,

                nombre: localStorage.getItem('nombre') || <?php echo str_replace('"', "'", json_encode($name, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                altura: localStorage.getItem('altura') || <?php echo str_replace('"', "'", json_encode($height, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                peso: localStorage.getItem('peso') || <?php echo str_replace('"', "'", json_encode($weight, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                edad: localStorage.getItem('edad') || <?php echo str_replace('"', "'", json_encode($age, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                email: localStorage.getItem('email') || <?php echo str_replace('"', "'", json_encode($email, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                genero: localStorage.getItem('genero') || <?php echo str_replace('"', "'", json_encode($gender, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                lopd: localStorage.getItem('lopd') || <?php echo str_replace('"', "'", json_encode($lopd, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,

                dades: JSON.parse(localStorage.getItem('dades')) || <?php echo str_replace('"', "'", json_encode($dades, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,

                addClassToMeasureInput(costillar_choice, myInput) {
                    let camp = this.$refs[costillar_choice + '_' + myInput];
                    camp.classList.add('measure-warning-input');
                },

                removeClassToMeasureInput(costillar_choice, myInput) {
                    let camp = this.$refs[costillar_choice + '_' + myInput];
                    camp.classList.remove('measure-warning-input');
                },

                addClassToFrontPageInput(myInput) {
                    let field = this.$refs[myInput];
                    field.classList.add('front-page-warning-input');
                },

                removeClassToFrontPageInput(myInput) {
                    let field = this.$refs[myInput];
                    field.classList.remove('front-page-warning-input');
                },

                addFocusToMeasureInput(costillar_choice, step_num) {
                    if((costillar_choice == 'con_costillar' && step_num != 20) || (costillar_choice == 'sin_costillar' && step_num != 19))
                        this.$refs[costillar_choice + '_' + step_num + '_input'].focus();
                },

                playNextVideo(costillar_choice, step_num){
                    if((costillar_choice == 'con_costillar' && step_num != 20) || (costillar_choice == 'sin_costillar' && step_num != 19))
                        this.$refs[costillar_choice + '_' + step_num + '_video'].play();
                },

                stopVideo(costillar_choice, step_num) {
                    this.$refs[costillar_choice + '_' + step_num + '_video'].pause();
                },

                rewindVideo() {
                    this.$refs.video.currentTime = this.$refs.video.currentTime - 10;
                },

                next_step(costillar_choice, step_name){
                    if(this.dades[costillar_choice][step_name] == '' || this.dades[costillar_choice][step_name] <= 0){
                        this.addClassToMeasureInput(costillar_choice, step_name);
                        return false;
                    }
                    else {
                        this.removeClassToMeasureInput(costillar_choice, step_name);
                        this.stopVideo(costillar_choice, this.step);
                        this.step++;
                        this.playNextVideo(costillar_choice, this.step);
                        this.addFocusToMeasureInput(costillar_choice, this.step);
                    }
                },

                previous_step() {
                    this.stopVideo(this.costillar, this.step);
                    this.step--;
                },

                goToStep(costillar_choice, step_num) {
                    this.step = step_num;
                    this.playNextVideo(costillar_choice, this.step);
                    this.addFocusToMeasureInput(costillar_choice, this.step);
                },

                FrontPageToVideos(){
                    correct = true;
                    if(this.nombre == ''){
                            this.addClassToFrontPageInput('nombre');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('nombre');
                    }
                    if(this.altura <= 0){
                            this.addClassToFrontPageInput('altura');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('altura');
                    }
                    if(this.peso <= 0){
                            this.addClassToFrontPageInput('peso');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('peso');
                    }
                    if(this.edad <= 0){
                            this.addClassToFrontPageInput('edad');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('edad');
                    }
                    if(this.email == '' || !this.email.includes('@') || !this.email.includes('.') || this.email.indexOf('@') > this.email.indexOf('.') || this.email.indexOf('@') == 0 || this.email.indexOf('.') == 0 || this.email.indexOf('.') == this.email.length - 1 || this.email.indexOf('@') == this.email.length - 1 || this.email.indexOf('@') == this.email.indexOf('.') - 1){
                            this.addClassToFrontPageInput('email');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('email');
                    }
                     if(this.genero == ''){
                            this.addClassToFrontPageInput('genero');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('genero');
                    }
                    if(this.lopd == false){
                            this.addClassToFrontPageInput('lopd');
                            correct = false;
                    }
                    else {
                        this.removeClassToFrontPageInput('lopd');
                    }
                    if(correct){
                        this.step = 1;
                        this.playNextVideo(this.costillar, this.step);
                    }
                    else {
                        return false;
                    }
                },
            }">
