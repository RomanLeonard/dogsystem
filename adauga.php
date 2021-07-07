<?php
    
    session_id("login-session");
    session_start();
	
    if (!isset($_SESSION['login-true']) || $_SESSION['login-true'] != true) {
        header("Location: ./index.php");
		die;
	}
	else{
        include 'comp/dbh.php';
    }

	if(isset($_GET['deconectare'])){
			$_SESSION['login-true']= false;
			session_destroy();
			header('Location: ../fundatia-speranta/index.php');
			die;
	}
	include 'comp/header.php';
?>
<head><link rel="stylesheet" href="style/style_adauga.css"></head>


<div class="adauga-text">
    <h1>Adauga caini:</h1>
</div>


<div class="adauga-form">
    <!-- success! -->
    <?php 
        if(isset($_GET['success'])){
            echo '<div class="alert alert-success alert-dismissible fade show p-5" role="alert">
            <strong>SUCCES !!!</strong> Cainele a fost adaugat.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else if(isset($_GET['error'])){
            echo '<div class="alert alert-danger alert-dismissible fade show p-5" role="alert">
            <strong>EROARE !!!</strong> Campurile nu au fost completate.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    ?>
    <!-- success messge -->
    <form action="./comp/add.php" method="POST" enctype="multipart/form-data">
        <div class="add-wrapper	">
            <div class="d-block">  
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. microcip:</span>
                    </div>
                    <input type="text" class="form-control" name="c_microcip" aria-label="Sizing example input" placeholder="000000000000000" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. identificare:</span>
                    </div>
                    <input type="text" class="form-control" name="c_identificare" placeholder="000/000/0000" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Data capturarii:</span>
                    </div>
                    <input type="text" class="form-control date_picker_trigger" name="c_datacapt" placeholder="2000-01-01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Locul capturarii:</span>
                    </div>
                    <input type="text" class="form-control" name="c_loccapt" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

<!-- adauga si ora la data -->
                <div class="input-group input-group-md mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Data si ora cazarii in adapost:</span>
                    </div>
                    <input type="text" class="form-control date_picker_trigger" name="c_datcazare" placeholder="2000-01-01 10:55" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Caracteristici individuale ale animalului:</span>
                    </div>
                    <textarea type="text" class="form-control" name="c_caracteristici" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. de caini fara stapan prinsi:</span>
                    </div>
                    <input type="text" class="form-control" name="c_fsprinsi" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. de caini fara stapan revendicati:</span>
                    </div>
                    <input type="text" class="form-control" name="c_fsrevendicati" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. de caini fara stapan adoptati:</span>
                    </div>
                    <input type="text" class="form-control" name="c_fsadoptati" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. de caini mentinuti in adapost:</span>
                    </div>
                    <input type="text" class="form-control" name="c_cmentinuti" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. de caini adoptati la distanta:</span>
                    </div>
                    <input type="text" class="form-control" name="c_cadoptati" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nr. de caini eutanasiati:</span>
                    </div>
                    <input type="text" class="form-control" name="c_eutanasiati" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Motivul eutanasierii:</span>
                    </div>
                    <textarea type="text" class="form-control" name="c_motiveutan" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Substanta utilizata pentru eutanasiere:</span>
                    </div>
                    <input type="text" class="form-control" name="c_substeutan" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Numele persoanei care realizeaza eutanasierea:</span>
                    </div>
                    <input type="text" class="form-control" name="c_numperseutan" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Numarul fisei de adoptie:</span>
                    </div>
                    <input type="text" class="form-control" name="c_nrfisaadoptie" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Data deparazitarii:</span>
                    </div>
                    <input type="text" class="form-control date_picker_trigger" name="c_datdeparazit" placeholder="2000-01-01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Data vaccinarii antirabice:</span>
                    </div>
                    <input type="text" class="form-control date_picker_trigger" name="c_datvacc" placeholder="2000-01-01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Data sterilizarii:</span>
                    </div>
                    <input type="text" class="form-control date_picker_trigger" name="c_steril" placeholder="2000-01-01" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Persoanele care au instrumentat manoperele respective:</span>
                    </div>
                    <input type="text" class="form-control" name="c_persmanopera" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Decedati:</span>
                    </div>
                    <input type="text" class="form-control" name="c_decedati" placeholder="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>


            
            </div>
            <!-- visible on small 
            <div class="d-block d-md-none">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_microcip" aria-label="Sizing example input" placeholder="Nr. microcip:" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_identificare" placeholder="Nr. identificare:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_capturare" placeholder="Data si locul capturarii:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_cazareadapost" placeholder="Data si ora cazarii in adapost:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <textarea type="text" class="form-control" name="c_caracteristici" placeholder="Caracteristici individuale ale animalului:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_fsprinsi" placeholder="Nr. de caini fara stapan prinsi:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_fsrevendicati" placeholder="Nr. de caini fara stapan revendicati:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_fsadoptati" placeholder="Nr. de caini fara stapan adoptati:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_cmentinuti" placeholder="Nr. de caini mentinuti in adapost:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_cadoptati" placeholder="Nr. de caini adoptati la distanta:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_eutanasiati" placeholder="Nr. de caini eutanasiati:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <textarea type="text" class="form-control" name="c_motiveutan" placeholder="Motivul eutanasierii:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_substeutan" placeholder="Substanta utilizata pentru eutanasiere:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_numperseutan" placeholder="Numele persoanei care realizeaza eutanasierea:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_nrfisaadoptie" placeholder="Numarul fisei de adoptie:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_depsivacc" placeholder="Data deparazitarii si data vaccinarii antiarabice:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_steril" placeholder="Data sterilizarii:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_persmanopera" placeholder="Persoanele care au instrumentata manoperele respective:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="c_decedati" placeholder="Decedati:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>-->
    
    
    <br><br><br>   
    <div class="text-detalii-fisa-caine">
        <hr>    
        <!-- text detalii fisa catel --><h3 class="mx-2">Detalii pentru fisa cainelui:</h3>
        <hr>
    </div>
    <br><br><br>



    <div>
    
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="c_proprietar" placeholder="Proprietar:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <br>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="det_nume" placeholder="Numele cainelui:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="det_nrmatricol" placeholder="Numar matricol:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="det_tronson" placeholder="Tronson:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="det_cusca" placeholder="Cusca:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="det_varsta" placeholder="An nastere:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <fieldset class="form-group mb-2">
            <div class="steril-details-modal">
            <legend class="col-form-label pt-0">
                Sex: 
            </legend>
            <div class="radio">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sex1" name="det_sex" class="custom-control-input" value="Mascul">
                    <label class="custom-control-label" for="sex1">MASCUL</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sex2" name="det_sex" class="custom-control-input" value="Femela">
                    <label class="custom-control-label" for="sex2">FEMELA</label>
                </div>
            </div>

            </div>
        </fieldset>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="det_culoare" placeholder="Culoarea:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group mb-2">
            <textarea class="form-control" name="det_semnpartic" placeholder="Semne particulare:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
        </div>
        <fieldset class="form-group mb-2">
            <div class="steril-details-modal">
                  
            <legend class="col-form-label pt-0">
                Sterilizat: 
            </legend>
            <div class="radio">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="det_sterilizat" class="custom-control-input" value="0" checked>
                    <label class="custom-control-label" for="customRadioInline1">NU</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="det_sterilizat" class="custom-control-input" value="1">
                    <label class="custom-control-label" for="customRadioInline2">DA</label>
                </div>
            </div>

            </div>
        </fieldset>
        <div class="input-group mb-2">
            <textarea type="text" class="form-control" name="det_observatii" placeholder="Observatii:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"></textarea>
        </div>

        <div class="custom-file">
            <input type="file" class="custom-file-input" name="img" id="customFile">
            <label class="custom-file-label" for="customFile">Imagine caine</label>
        </div>

     </div>


     <br><br><br>
        
        <div class="text-detalii-fisa-caine">
            <hr>    
                <h3 class="mx-2">Detalii pentru rubrica in tabelul adapostului:</h3>
            <hr>
        </div>
        
        <br><br>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="tab_medic" placeholder="Medic/Asistent/Tehnician:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="tab_datapredarii" placeholder="Data predarii:" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <br><br><br>
        
        <br><br>
        <div class="buttons">
            <input type="submit" name="adauga" class="btn1 addbtn" value="Adauga"></input>
            <input type="submit" name="anuleaza" action="cancel()" class="btn1 anulare" value="Anulare"></input> 
        </div>
        </div>
    </form>  
</div>


<script>
    function cancel(){
        window.reload();    
    }
</script>


<?php include 'comp/footer.php'; ?>