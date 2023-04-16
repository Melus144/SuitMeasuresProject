<div x-data="
            {
                measure_code: <?php echo str_replace('"', "'", json_encode($measure_code, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                step: <?php echo json_encode($step, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT); ?>,

                costillar: <?php echo str_replace('"', "'", json_encode($costillar, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                mono_marina: <?php echo str_replace('"', "'", json_encode($have_marina_suit, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_mono_marina: <?php echo str_replace('"', "'", json_encode($marina_suit_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                ajuste_mono: <?php echo str_replace('"', "'", json_encode($suit_fitting, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,

                nombre: <?php echo str_replace('"', "'", json_encode($name, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                altura: <?php echo str_replace('"', "'", str_replace('.00', '', json_encode($height, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT))); ?>,
                peso: <?php echo str_replace('"', "'", str_replace('.00', '', json_encode($weight, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT))); ?>,
                edad: <?php echo str_replace('"', "'", json_encode($age, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                genero: <?php echo str_replace('"', "'", json_encode($gender, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,

                dades: <?php echo str_replace('"', "'", str_replace('.00', '', json_encode($dades, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT))); ?>,

                currentUrl : window.location.href,
                showModal: false,

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

                playNextVideo(costillar_choice, step_num) {
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
                  if(this.email == '' || !this.email.includes('@')){
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
                  if(correct){
                      this.step = 1;
                      this.playNextVideo(this.costillar, this.step);
                  }
                  else {
                      return false;
                  }
                },

                backToReview(costillar_choice){
                  advance =this.areMeasuresCorrect(costillar_choice);

                  if(advance === true && costillar_choice == 'con_costillar'){
                      this.step = 20;
                  }
                  else if(advance === true && costillar_choice == 'sin_costillar'){
                      this.step = 19;
                  }
                  else {
                      return false;
                  }
                },

                areMeasuresCorrect(costillar_choice) {
                    correct=!(this.dades[costillar_choice]['shoulder'] === '' || this.dades[costillar_choice]['shoulder'] <= 0
                    || this.dades[costillar_choice]['sleeve_length'] === '' || this.dades[costillar_choice]['sleeve_length'] <= 0
                    || this.dades[costillar_choice]['sleeve_interior'] === '' || this.dades[costillar_choice]['sleeve_interior'] <= 0
                    || this.dades[costillar_choice]['neck'] === '' || this.dades[costillar_choice]['neck'] <= 0
                    || this.dades[costillar_choice]['biceps'] === '' || this.dades[costillar_choice]['biceps'] <= 0
                    || this.dades[costillar_choice]['forearm'] === '' || this.dades[costillar_choice]['forearm'] <= 0
                    || this.dades[costillar_choice]['waist'] == '' || this.dades[costillar_choice]['waist'] <= 0
                    || this.dades[costillar_choice]['hip'] === '' || this.dades[costillar_choice]['hip'] <= 0
                    || this.dades[costillar_choice]['torso_length'] === '' || this.dades[costillar_choice]['torso_length'] <= 0
                    || this.dades[costillar_choice]['back_shot'] === '' || this.dades[costillar_choice]['back_shot'] <= 0
                    || this.dades[costillar_choice]['torso'] === '' || this.dades[costillar_choice]['torso'] <= 0
                    || this.dades[costillar_choice]['total_length'] === '' || this.dades[costillar_choice]['total_length'] <= 0
                    || this.dades[costillar_choice]['leg'] === '' || this.dades[costillar_choice]['leg'] <= 0
                    || this.dades[costillar_choice]['interior_leg'] === '' || this.dades[costillar_choice]['interior_leg'] <= 0
                    || this.dades[costillar_choice]['leg_upper'] === '' || this.dades[costillar_choice]['leg_upper'] <= 0
                    || this.dades[costillar_choice]['leg_lower'] === '' || this.dades[costillar_choice]['leg_lower'] <= 0
                    || this.dades[costillar_choice]['calf'] === '' || this.dades[costillar_choice]['calf'] <= 0
                    || (costillar_choice == 'con_costillar' && (this.dades[costillar_choice]['rib_chest'] === '' || this.dades[costillar_choice]['rib_chest'] <= 0))
                    || (costillar_choice == 'con_costillar' && (this.dades[costillar_choice]['rib_rack'] === '' || this.dades[costillar_choice]['rib_rack'] <= 0))
                    || (costillar_choice == 'sin_costillar' && (this.dades[costillar_choice]['chest'] === '' || this.dades[costillar_choice]['chest'] <= 0)));
                    return correct;
                },

                copyUrlToClipboard() {
                  this.$refs.link.select()
                  this.$refs.link.setSelectionRange(0, 99999)
                  document.execCommand('copy')
                }
            }">
