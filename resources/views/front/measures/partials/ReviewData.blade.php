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

                talla_altura: <?php echo str_replace('"', "'", json_encode($height_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_peso: <?php echo str_replace('"', "'", json_encode($weight_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_media: <?php echo str_replace('"', "'", json_encode($medium_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_pecho: <?php echo str_replace('"', "'", json_encode($chest_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_cintura: <?php echo str_replace('"', "'", json_encode($waist_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                talla_cadera: <?php echo str_replace('"', "'", json_encode($hip_size, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); ?>,
                guia_tallas: {
                    42: {
                      peso: {min: 45, max: 50},
                      altura: {min: 161, max: 164},
                      pecho: {min: 72, max: 80},
                      cintura: {min: 68, max: 72},
                      cadera: {min: 80, max: 84}
                    },
                    44: {
                      peso: {min: 50, max: 55},
                      altura: {min: 164, max: 167},
                      pecho: {min: 80, max: 88},
                      cintura: {min: 72, max: 76},
                      cadera: {min: 84, max: 88}
                    },
                   46: {
                      peso: {min: 55, max: 60},
                      altura: {min: 167, max: 170},
                      pecho: {min: 88, max: 92},
                      cintura: {min: 76, max: 80},
                      cadera: {min: 88, max: 92}
                    },
                    48: {
                      peso: {min: 60, max: 68},
                      altura: {min: 170, max: 173},
                      pecho: {min: 92, max: 96},
                      cintura: {min: 80, max: 84},
                      cadera: {min: 92, max: 96}
                    },
                    50: {
                      peso: {min: 68, max: 72},
                      altura: {min: 173, max: 176},
                      pecho: {min: 96, max: 100},
                      cintura: {min: 84, max: 88},
                      cadera: {min: 96, max: 100}
                    },
                    52: {
                      peso: {min: 72, max: 78},
                      altura: {min: 176, max: 179},
                      pecho: {min: 100, max: 104},
                      cintura: {min: 88, max: 92},
                      cadera: {min: 100, max: 104}
                    },
                    54: {
                      peso: {min: 78, max: 84},
                      altura: {min: 179, max: 182},
                      pecho: {min: 104, max: 108},
                      cintura: {min: 92, max: 96},
                      cadera: {min: 104, max: 108}
                    },
                    56: {
                      peso: {min: 84, max: 90},
                      altura: {min: 182, max: 185},
                      pecho: {min: 108, max: 112},
                      cintura: {min: 96, max: 100},
                      cadera: {min: 108, max: 112}
                    },
                    58: {
                      peso: {min: 90, max: 96},
                      altura: {min: 185, max: 188},
                      pecho: {min: 112, max: 116},
                      cintura: {min: 100, max: 104},
                      cadera: {min: 112, max: 116}
                    },
                    60: {
                      peso: {min: 96, max: 102},
                      altura: {min: 188, max: 191},
                      pecho: {min: 116, max: 120},
                      cintura: {min: 104, max: 108},
                      cadera: {min: 116, max: 120}
                    },
                    62: {
                      peso: {min: 102, max: 108},
                      altura: {min: 191, max: 194},
                      pecho: {min: 120, max: 124},
                      cintura: {min: 108, max: 112},
                      cadera: {min: 120, max: 124}
                    },
                    64: {
                      peso: {min: 108, max: 114},
                      altura: {min: 194, max: 197},
                      pecho: {min: 124, max: 128},
                      cintura: {min: 112, max: 116},
                      cadera: {min: 124, max: 128}
                    },
                    66: {
                      peso: {min: 114, max: 120},
                      altura: {min: 197, max: 200},
                      pecho: {min: 128, max: 132},
                      cintura: {min: 116, max: 120},
                      cadera: {min: 128, max: 132}
                    },
                    68: {
                      peso: {min: 120, max: 124},
                      altura: {min: 200, max: 203},
                      pecho: {min: 132, max: 136},
                      cintura: {min: 120, max: 124},
                      cadera: {min: 132, max: 134}
                    }
                },

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
                      this.calculateChestSize(costillar_choice, this.step);
                      this.calculateHipSize(costillar_choice, this.step);
                      this.calculateWaistSize(costillar_choice, this.step);
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
                  if(this.email == '' || !this.email.includes('@') || this.email.indexOf('@') > this.email.lastIndexOf('.') || this.email.indexOf('@') == 0 || this.email.indexOf('.') == 0 || this.email.indexOf('.') == this.email.length - 1 || this.email.indexOf('@') == this.email.length - 1 || this.email.indexOf('@') == this.email.indexOf('.') - 1){
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
                      this.calculateHeightWeightSizes();
                      this.step = 1;
                      this.playNextVideo(this.costillar, this.step);
                  }
                  else {
                      return false;
                  }
                },

                calculateHeightWeightSizes() {
                    Object.keys(this.guia_tallas).forEach(talla => {
                        const pesoMin = this.guia_tallas[talla].peso.min;
                        const pesoMax = this.guia_tallas[talla].peso.max;
                        const alturaMin = this.guia_tallas[talla].altura.min;
                        const alturaMax = this.guia_tallas[talla].altura.max;

                        // Verificar si los valores de peso y altura están dentro del rango de esta talla
                        if (this.peso > pesoMin && this.peso <= pesoMax) {
                            this.talla_peso = talla;
                        }
                        if (this.altura > alturaMin && this.altura <= alturaMax) {
                            this.talla_altura = talla;
                        }
                    });

                    if(this.talla_peso == '') {
                        if(this.peso <= this.guia_tallas['42'].peso.min) {
                            this.talla_peso = '42';
                        }
                        else if(this.peso > this.guia_tallas['68'].peso.max) {
                            this.talla_peso = '68';
                        }
                    }
                    if(this.talla_altura == '') {
                        if(this.altura <= this.guia_tallas['42'].altura.min) {
                            this.talla_altura = '42';
                        }
                        else if(this.altura > this.guia_tallas['68'].altura.max) {
                            this.talla_altura = '68';
                        }
                    }
                    this.talla_media = this.talla_peso == this.talla_altura ? this.talla_peso : 'no_talla';
                },

                calculateChestSize(costillar_choice, step_num) {
                    if(step_num == 8) {
                        if(costillar_choice == 'con_costillar'){
                            if(this.dades[costillar_choice]['rib_chest'] > 0) {
                                Object.keys(this.guia_tallas).forEach(talla => {
                                    const pechoMin = this.guia_tallas[talla].pecho.min;
                                    const pechoMax = this.guia_tallas[talla].pecho.max;
                                    // Verificar si valor introducido del pecho está dentro del rango de esta talla
                                    if (this.dades[costillar_choice]['rib_chest'] > pechoMin && this.dades[costillar_choice]['rib_chest'] <= pechoMax) {
                                        this.talla_pecho = talla;
                                    }
                                });
                                if(this.talla_pecho == '') {
                                    if(this.dades[costillar_choice]['rib_chest'] <= this.guia_tallas['42'].pecho.min) {
                                        this.talla_pecho = '42';
                                    }
                                    else if(this.dades[costillar_choice]['rib_chest'] > this.guia_tallas['68'].pecho.max) {
                                        this.talla_pecho = '68';
                                    }
                                }
                            }
                        }
                        else {
                            if(this.dades[costillar_choice]['chest'] > 0) {
                                Object.keys(this.guia_tallas).forEach(talla => {
                                    const pechoMin = this.guia_tallas[talla].pecho.min;
                                    const pechoMax = this.guia_tallas[talla].pecho.max;
                                    // Verificar si valor introducido del pecho está dentro del rango de esta talla
                                    if (this.dades[costillar_choice]['chest'] > pechoMin && this.dades[costillar_choice]['chest'] <= pechoMax) {
                                        this.talla_pecho = talla;
                                    }
                                });
                                if(this.talla_pecho == '') {
                                    if(this.dades[costillar_choice]['chest'] <= this.guia_tallas['42'].pecho.min) {
                                        this.talla_pecho = '42';
                                    }
                                    else if(this.dades[costillar_choice]['chest'] > this.guia_tallas['68'].pecho.max) {
                                        this.talla_pecho = '68';
                                    }
                                }
                            }
                        }
                        this.talla_media = this.talla_pecho == this.talla_media ? this.talla_pecho : 'no_talla';
                    }
                },

                calculateWaistSize(costillar_choice, step_num) {
                    if((costillar_choice == 'con_costillar' && step_num == 10) || (costillar_choice == 'sin_costillar' && step_num == 9)) {
                        if(this.dades[costillar_choice]['waist'] > 0) {
                            Object.keys(this.guia_tallas).forEach(talla => {
                                const cinturaMin = this.guia_tallas[talla].cintura.min;
                                const cinturaMax = this.guia_tallas[talla].cintura.max;
                                // Verificar si valor introducido de la cintura está dentro del rango de esta talla
                                if (this.dades[costillar_choice]['waist'] > cinturaMin && this.dades[costillar_choice]['waist'] <= cinturaMax) {
                                    this.talla_cintura = talla;
                                }
                            });
                            if(this.talla_cintura == '') {
                                if(this.dades[costillar_choice]['waist'] <= this.guia_tallas['42'].cintura.min) {
                                    this.talla_cintura = '42';
                                }
                                else if(this.dades[costillar_choice]['waist'] > this.guia_tallas['68'].cintura.max) {
                                    this.talla_cintura = '68';
                                }
                            }
                            this.talla_media = this.talla_cintura == this.talla_media ? this.talla_cintura : 'no_talla';
                        }
                    }
                },

                calculateHipSize(costillar_choice, step_num) {
                    if((costillar_choice == 'con_costillar' && step_num == 11) || (costillar_choice == 'sin_costillar' && step_num == 10)) {
                        if(this.dades[costillar_choice]['hip'] > 0) {
                            Object.keys(this.guia_tallas).forEach(talla => {
                                const caderaMin = this.guia_tallas[talla].cadera.min;
                                const caderaMax = this.guia_tallas[talla].cadera.max;
                                // Verificar si valor introducido de la cadera está dentro del rango de esta talla
                                if (this.dades[costillar_choice]['hip'] > caderaMin && this.dades[costillar_choice]['hip'] <= caderaMax) {
                                    this.talla_cadera = talla;
                                }
                            });
                            if(this.talla_cadera == '') {
                                if(this.dades[costillar_choice]['hip'] <= this.guia_tallas['42'].cadera.min) {
                                    this.talla_cadera = '42';
                                }
                                else if(this.dades[costillar_choice]['hip'] > this.guia_tallas['68'].cadera.max) {
                                    this.talla_cadera = '68';
                                }
                            }
                            this.talla_media = this.talla_cadera == this.talla_media ? this.talla_cadera : 'no_talla';
                        }
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
