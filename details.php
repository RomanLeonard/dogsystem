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
	
    elseif(isset($_GET['microcip'])){
	
    $microcipRaw = mysqli_real_escape_string($conn, $_GET['microcip']);
    $_SESSION['microcip'] = $microcipRaw;
    $microcip = $_SESSION['microcip'];

    // VARIABLES FOR TABLES: tabel `catei_tabel`
        $c_id             = '';
        $c_microcip       ="";
        $c_identificare   ="";
        $c_datacapt     = "";
        $c_loccapt = "";
        $c_datcazare = "";
        $c_caracteristici = "";
        $c_fsprinsi = "";
        $c_fsrevendicati = "";
        $c_fsadoptati = "";
        $c_cmentinuti = "";
        $c_cadoptati ="";
        $c_eutanasiati ="";
        $c_motiveutan = "";
        $c_substeutan ="";
        $c_numperseutan ="";
        $c_nrfisaadoptie ="";
        $c_datdeparazit ="";
        $c_datvacc = "";
        $c_steril ="";
        $c_persmanopera ="";
        $c_decedati ="";
        $c_dataaddsite ="";
        $c_proprietar = "";

        $sql = "SELECT * FROM catei_tabel WHERE c_microcip='$microcip'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $c_id              = $row['c_id'];
            $c_microcip        = $row['c_microcip'];
            $c_identificare    = $row['c_identificare'];
            $c_datacapt        = $row['c_datacapt'];
            $c_loccapt         = $row['c_loccapt'];
            $c_datcazare       = $row['c_datcazare'];
            $c_caracteristici  = $row['c_caracteristici'];
            $c_fsprinsi        = $row['c_fsprinsi'];
            $c_fsrevendicati   = $row['c_fsrevendicati'];
            $c_fsadoptati      = $row['c_fsadoptati'];
            $c_cmentinuti      = $row['c_cmentinuti'];
            $c_cadoptati       = $row['c_cadoptati'];
            $c_eutanasiati     = $row['c_eutanasiati'];
            $c_motiveutan      = $row['c_motiveutan'];
            $c_substeutan      = $row['c_substeutan'];
            $c_numperseutan    = $row['c_numperseutan'];
            $c_nrfisaadoptie   = $row['c_nrfisaadoptie'];
            $c_datdeparazit    = $row['c_datdeparazit'];
            $c_datvacc         = $row['c_datvacc'];
            $c_steril          = $row['c_steril'];
            $c_persmanopera    = $row['c_persmanopera'];
            $c_decedati        = $row['c_decedati'];
            $c_dataaddsite     = $row['c_dataaddsite'];
            $c_proprietar      = $row['c_proprietar'];
        }

    // VARIABLES FOR TABLES: tabel `tabel_dapost`
        $id                  = '';
        $tab_data            = '';
        $tab_datacazarii     = '';
        $tab_caracteristici  = '';
        $tab_nrcprinsi       = '';
        $tab_nrcrevendic     = '';
        $tab_nrcadopt        = '';
        $tab_nrcmentin       = '';
        $tab_nrcdecedati     = '';
        $tab_motiv           = '';
        $tab_nrident         = '';
        $tab_nrfisa          = '';
        $tab_datavacc        = '';
        $tab_datadeparat     = '';
        $tab_datasteriliz    = '';
        $tab_medic           = '';
        $tab_datapredarii    = '';


        $sqlAdap = "SELECT * FROM tabel_adapost WHERE tab_nrident='$microcip'";
        $resultAdap = mysqli_query($conn, $sqlAdap);
        while($rowAdap = mysqli_fetch_assoc($resultAdap)){
            $id                     = $rowAdap['id'];
            $tab_data               = $rowAdap['tab_data'];
            $tab_datacazarii        = $rowAdap['tab_datacazarii'];
            $tab_caracteristici     = $rowAdap['tab_caracteristici'];
            $tab_nrcprinsi          = $rowAdap['tab_nrcprinsi'];
            $tab_nrcrevendic        = $rowAdap['tab_nrcrevendic'];
            $tab_nrcadopt           = $rowAdap['tab_nrcadopt'];
            $tab_nrcmentin          = $rowAdap['tab_nrcmentin'];
            $tab_nrcdecedati        = $rowAdap['tab_nrcdecedati'];
            $tab_motiv              = $rowAdap['tab_motiv'];
            $tab_nrident            = $rowAdap['tab_nrident'];
            $tab_nrfisa             = $rowAdap['tab_nrfisa'];
            $tab_datavacc           = $rowAdap['tab_datavacc'];
            $tab_datadeparat        = $rowAdap['tab_datadeparat'];
            $tab_datasteriliz       = $rowAdap['tab_datasteriliz'];
            $tab_medic              = $rowAdap['tab_medic'];
            $tab_datapredarii       = $rowAdap['tab_datapredarii'];
        }

    // VARIABLES FOR TABLES: tabel `details`
        $det_serie	  		 = '';     
        $det_nume	  		 = '';         
        $det_img  	         = '';   
        $det_nrmatricol	  	 = '';	
        $det_tronson	  	 = '';   
        $det_cusca	         = '';   
        $det_varsta	         = '';   
        $det_sex             = '';
        $det_culoare	  	 = '';    
        $det_semnpartic	  	 = $c_caracteristici;    
        $det_sterilizat	  	 = ''; 
        $det_observatii   	 = '';
        $det_datUltVacc      = '';
        $det_datUltDep       = '';

        $det_dataadopt = '';
        $det_numpersadopt ='';
        $det_datadecedat = '';

        $sqlDet = "SELECT * FROM details WHERE det_serie='$microcip'";
        $resultDet = mysqli_query($conn, $sqlDet);
        while ($rowDet = mysqli_fetch_assoc($resultDet)){
            $det_serie	  		 = $rowDet['det_serie'];     
            $det_nume	  		 = $rowDet['det_nume'];         
            $det_img  	         = $rowDet['det_img'];   
            $det_nrmatricol	  	 = $rowDet['det_nrmatricol'];	
            $det_tronson	  	 = $rowDet['det_tronson'];   
            $det_cusca	         = $rowDet['det_cusca'];   
            $det_varsta	         = $rowDet['det_varsta'];   
            $det_sex             = $rowDet['det_sex'];
            $det_culoare	  	 = $rowDet['det_culoare'];    
            //$det_semnpartic	  	 = $rowDet['det_semnpartic'];    
            $det_sterilizat	  	 = $rowDet['det_sterilizat'];
            
            $det_dataadopt       = $rowDet['det_dataadopt'];
            $det_numpersadopt    = $rowDet['det_numpersadopt'];
            $det_datadecedat     = $rowDet['det_datadecedat'];

            $det_observatii   	 = $rowDet['det_observatii'];  
            $det_datUltDep       = $rowDet['det_datultdep'];  
            $det_datUltVacc      = $rowDet['det_datultvacc']; 
        }


        // print sterilizat text
        $checkSterilSql = "SELECT * FROM catei_tabel WHERE c_microcip='$microcip' AND c_steril != 0";
        $checkSterilQuery = mysqli_query($conn, $checkSterilSql);
        $sterilResults = mysqli_num_rows($checkSterilQuery);
        if($sterilResults != 0){
            $checkSterilizat = 1;
        }
        else{
            $checkSterilizat = 0;
        }

        $checkSexSql = "SELECT * FROM details WHERE det_serie='$microcip' AND det_sex like 'Mascul'";
        $checkSexSqlQuery = mysqli_query($conn, $checkSexSql);
        $sexResult = mysqli_num_rows($checkSexSqlQuery);
        if($sexResult != 0){
            $checkSex = 'Mascul';
        }
        else{
            $checkSex = 'Femela';
        }


        // print predat text
        $predatCheckSql = "SELECT * FROM tabel_adapost WHERE tab_serie='$microcip' AND tab_datapredarii != 0";
        $predatCheckQuery = mysqli_query($conn, $predatCheckSql);
        $predatResult = mysqli_num_rows($predatCheckQuery);
        if($predatResult != 0){
            $caine_predat_text = "DA";


            $predatDataAdd = '';
            $predatSql = "SELECT * FROM tabel_adapost WHERE tab_serie='$microcip'";
            $predatQuery = mysqli_query($conn, $predatSql);
            while($predatData = mysqli_fetch_assoc($predatQuery)){
                $predatDataAdd = $predatData['tab_datapredarii']; 
            }
            $caine_predat_text .= ", la data: '$predatDataAdd'";
        }
        else{
            $caine_predat_text = "NU";
        }
        
    
    
    $sqlShowSpec = "SELECT * FROM specific_details WHERE spec_serie='$microcip'";
    $resultSpec = mysqli_query($conn, $sqlShowSpec); 


    



    // for printier
    $sqlShowSpec2 = "SELECT * FROM specific_details WHERE spec_serie='$microcip'";
    $resultSpec2 = mysqli_query($conn, $sqlShowSpec2); 

    $dataPredarii = $tab_datapredarii;
    } else{}
	include 'comp/header.php'; 
?>
<head><link rel="stylesheet" href="style/style_details.css"></head>


<div id="full_page">
    <div class="top-text-info row p-2">
        <div class="text col-xs-12 col-md-6">
            <h1 class="my-1">Detalii despre caine:</h1>
        </div>
        <div class="col-xs-12 col-md-6 btn-print">
            <button id="btn-print" onclick="createPrint()"><i class="fas fa-print"></i> Imprimare</button>
        </div>
    </div>


<!-- debugger 
<div class="debugger">
    <h1>
        <?php echo $dataPredarii;?>
    </h1>
</div>
-->

    <div class="container detcatel-wrapper">
        <div class="row">
            <div class="col-md-6">
                <?php if($det_img == 1): ?>
                    <?php
                    $filename = "uploads/dog".$microcip."*";
                    $fileinfo = glob($filename);
                    $fileext = explode(".", $fileinfo[0]);
                    $fileactualext = $fileext[1];
                    
                    echo "<img style='max-height: 480px; max-width: 600px;' class='rounded img-fluid border-img' src='uploads/dog".$microcip.".".$fileactualext."?".mt_rand()."'>"; ?>
                    <?php elseif ($det_img == 0) : ?>
                        <img class='rounded img-fluid border-img' src="uploads/dogDefault.jpg">
                <?php endif; ?>
                <div class="left-val">
                    <li class="list-group-item"><b>DATA ULTIMULUI VACCIN:</b>                         <span> <?php echo $det_datUltVacc; ?></span></li>
                    <li class="list-group-item"><b>DATA ULTIMEI DEPARAZITARI:</b>                         <span> <?php echo $det_datUltDep; ?></span></li>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="list-group list-details1">
                    <li class="list-group-item" style="background: #198e40; color: #fff;"><b>Nr. Fisa:</b> <span> <?php echo $c_nrfisaadoptie; ?></span></li>
                    <li class="list-group-item"><b>NUME:</b>                           <span> <?php echo $det_nume; ?></span></li>
                    <li class="list-group-item"><b>MICROCIP:</b>                      <span> <?php echo $det_serie;?></span></li>
                    <li class="list-group-item"><b>PROPRIETAR:</b>                   <span> <?php echo $c_proprietar ; ?></span></li>
                    <li class="list-group-item"><b>NR. MATRICOL:</b>                   <span> <?php echo $det_nrmatricol; ?></span></li>
                    <li class="list-group-item"><b>TRONSON:</b>                        <span> <?php echo $det_tronson; ?></span></li>
                    <li class="list-group-item"><b>CUSCA:</b>                          <span> <?php echo $det_cusca; ?></span></li>
                    <li class="list-group-item"><b>AN NASTERE:</b>                         <span> <?php echo $det_varsta; ?></span></li>
                    <li class="list-group-item"><b>SEX:</b>                         <span> <?php echo $det_sex; ?></span></li>
                    <li class="list-group-item responsivness"><b>SEMNE PARTICULARE:</b>              <span> <?php echo $det_semnpartic; ?></span></li>
                    <li class="list-group-item" style="border-bottom:none; border-bottom-right-radius: 0; border-bottom-left-radius: 0;"><b>STERILIZAT:</b> <span><?php if($checkSterilizat == 1){ echo "DA";} else { echo "NU"; }?></span></li>
                    <?php 
                        if($det_dataadopt != '' && $det_numpersadopt != '') {
                            echo "<li class='list-group-item'><b>ADOPTAT:</b>
                                    <span> $det_dataadopt de $det_numpersadopt </span></li>"; 
                        } 
                        elseif($det_datadecedat != 0) {
                            echo "<li class='list-group-item'><b>DECEDAT:</b>
                                    <span> $det_datadecedat</span></li>"; 
                        }
                    ?>
                    <li class="list-group-item list-details responsivness" style="border-top-right-radius: 0;"><b>OBSERVATII:</b> <span><?php echo $det_observatii; ?></span></li>
                </ul>
            </div>
        </div>
    </div>

    <center><br><br><br><br><br><br>
        <div class="custom-tabel" style="margin-top:-20px;">
            <form action="comp/specDet.php" method="POST">
                <div style="overflow-x:auto; overflow-y: auto;">
                    <table style="width:100%; table-layout: fixed;">
                        <thead>
                            <tr style="background-color: #1da54b; text-align: center; padding: 10px;">
                                <th style="border-right: 1px solid #fff; padding: 20px"><a style="color: #000">DATA</a></th>
                                <th style="border-right: 1px solid #fff; padding: 20px"><a style="color: #000">SEMNE CLINICE</a></th>
                                <th style="border-right: 1px solid #fff; padding: 20px"><a style="color: #000">DIAGNOSTIC</a></th>
                                <th style="border-right: 1px solid #fff; padding: 20px"><a style="color: #000">TRATAMENT</a></th>
                                <th style="border-right: 1px solid #fff; padding: 20px"><a style="color: #000">VACCIN</a></th>
                                <th style="padding: 20px"><a style="color: #000">OBSERVATII</a></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php while($rowSpec = mysqli_fetch_assoc($resultSpec)): ?>
                            <tr style="border:1px solid #1da54b">
                                <td style="border:1px solid #1da54b; word-wrap:break-word;"><?php echo $rowSpec['spec_data'];?></td>
                                <td style="border:1px solid #1da54b; word-wrap:break-word;"><?php echo $rowSpec['spec_semneclinice'];?></td>
                                <td style="border:1px solid #1da54b; word-wrap:break-word;"><?php echo $rowSpec['spec_diagnostic'];?></td>
                                <td style="border:1px solid #1da54b; word-wrap:break-word;"><?php echo $rowSpec['spec_tratament'];?></td>
                                <td style="border:1px solid #1da54b; word-wrap:break-word;"><?php echo $rowSpec['spec_vaccin'];?></td>
                                <td style="border:1px solid #1da54b; word-wrap:break-word;"><?php echo $rowSpec['spec_observatii'];?></td>
                            </tr>
                            <?php endwhile; ?>
                            <tr class="custom-table-item-wrapper">
                                <td style="border-right: 1px solid #fff;" class="custom-table-items"><input id="med_date_picker_trigger" class="date_picker_trigger" style="width: 100%;" type="text" name="spec_data" placeholder="Data"></td>
                                <td style="border-right: 1px solid #fff;" class="custom-table-items"><input style="width: 100%" type="text" name="spec_semneclinice" placeholder="Semne clinice"></td>
                                <td style="border-right: 1px solid #fff;" class="custom-table-items"><input style="width: 100%" type="text" name="spec_diagnostic" placeholder="Diagnostic"></td>
                                <td style="border-right: 1px solid #fff;" class="custom-table-items"><input style="width: 100%" type="text" name="spec_tratament" placeholder="Tratament"></td>
                                <td style="border-right: 1px solid #fff;" class="custom-table-items"><input style="width: 100%" type="text" name="spec_vaccin" placeholder="Vaccin"></td>
                                <td class="custom-table-items"><input style="width: 100%" type="text" name="spec_observatii" placeholder="Observatii"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                <input class="special-button" type="submit" name="add_spec2" value="ADAUGA">
            </form>
        </div>
    </center> 


    <br><br><br><br><br>
    <div class="tabel-text-info">
        <h1>Rubrica dedicata din registru:</h1>
    </div>
    <div class="containers">
        <div style="overflow-x:auto; overflow-y:auto">
                <table>
                <thead>
                    <tr>
                    <th></th>
                    <th>Nr. Crt</th>
                    <th>Nr. microcip</th>
                    <th>Nr. unic de identificare</th>
                    <th colspan='2'>Data si locul capturarii</th>
                    <th>Data si ora cazarii in adapost</th>
                    <th>Caracteristici individuale ale animalului</th>
                    <th>Nr. de caini fara stapan prinsi</th>
                    <th>Nr. de caini fara stapan revendicati</th>
                    <th>Nr. de caini fara stapan adoptati</th>
                    <th>Nr. de caini mentinuti in adapost</th>
                    <th>Nr. de caini adoptati la distanta</th>
                    <th>Nr. de caini eutanasiati</th>
                    <th>Motivul eutanasierii</th>
                    <th>Substanta utilizata pentru eutanasiere</th>
                    <th>Numele persoanei care realizeaza eutanasierea</th>
                    <th>Numarul fisei de adoptie</th>
                    <th>Data deparazitarii</th>
                    <th>Data vaccinarii antirabice</th>
                    <th>Data sterilizarii</th>
                    <th>Persoanele care au instrumentat manoperele respective</th>
                    <th>Decedati</th>
                    <th>Data adaugarii pe site</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="table-tr">
                            <td style="padding: 0; border-right-color: #fff;"><button onclick="fullCancel()" style="background: #198e40; color: #fff; padding: 20px 2px; border: none;">editare</button></td>  
                            <td class='text-center'><?php echo $c_id; ?></td>
                            <td class="p-1"><?php echo $c_microcip?></td>
                            <td><?php echo $c_identificare;?></td>
                            <td colspan='1'><?php echo $c_datacapt;?></td>
                            <td colspan='1'><?php echo $c_loccapt;?></td>
                            <td><?php echo $c_datcazare;?></td>
                            <td><?php echo $c_caracteristici;?></td>
                            <td class='text-center'><?php echo $c_fsprinsi;?></td>
                            <td class='text-center'><?php echo $c_fsrevendicati;?></td>
                            <td class='text-center'><?php echo $c_fsadoptati;?></td>
                            <td class='text-center'><?php echo $c_cmentinuti;?></td>
                            <td class='text-center'><?php echo $c_cadoptati;?></td>
                            <td class='text-center'><?php echo $c_eutanasiati;?></td>
                            <td><?php echo $c_motiveutan;?></td>
                            <td><?php echo $c_substeutan;?></td>
                            <td><?php echo $c_numperseutan;?></td>
                            <td class='text-center'><?php echo $c_nrfisaadoptie;?></td>
                            <td class='text-center'><?php echo $c_datdeparazit;?></td>
                            <td class='text-center'><?php echo $c_datvacc;?></td>
                            <td class='text-center'><?php echo $c_steril;?></td>
                            <td><?php echo $c_persmanopera;?></td>
                            <td class='text-center'><?php echo $c_decedati;?></td>
                            <td><?php echo $c_dataaddsite;?></td>
                        </tr>
                </tbody>
                </table>
            </div>
    </div>

    <div class="fulltabel-edit set-smalltext" id="fulltabel-edit">
        <h1 class="p-2">Editare 'Rubrica dedicata din registru':</h1>
        <form action="comp/fulEdit.php" method="POST"><div class="d-block">  
                    <div class="input-group input-group-sm mb-3" style="background: rgba(100,0,0,0.4)">
                        <div class="input-group-prepend">
                            <span style="background: rgba(100,0,0,0.4); color: #fff" class="input-group-text" id="inputGroup-sizing-sm">Nr. microcip:</span>
                        </div>
                        <input style="background: rgba(100,0,0,0.4)" type="text" class="form-control" name="c_microcip" aria-label="Sizing example input" placeholder="<?php echo $c_microcip;?>" aria-describedby="inputGroup-sizing-sm">
                    </div>

                    <div class="input-group input-group-sm mb-3" style="background: rgba(100,0,0,0.4)">
                        <div class="input-group-prepend">
                            <span style="background: rgba(100,0,0,0.4); color: #fff" class="input-group-text" id="inputGroup-sizing-sm">Nr. identificare:</span>
                        </div>
                        <input style="background: rgba(100,0,0,0.4)" type="text" class="form-control" name="c_identificare" placeholder="000/000/0000" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                        <input type="text" class="form-control date_picker_trigger" name="c_datcazare" placeholder="2000-01-01 10:55:00" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                        <input type="text" class="form-control date_picker_trigger" name="c_steril" placeholder="<?php echo $c_steril; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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

            <div class="buttons p-5">
                <input id="f-save" type="submit" name="full_save" value="Salveaza">
                <input id="f-cancel" type="submit" name="full_cancel" value="Anulare">
            </div>
        </form>
    </div>

    <div class="container-fluid editare-wrapper" id="tabel-adapost">
        <div class="col-s-12 my-5 p-2 editare-text text-center set-smalltexts">
            <h3>Editare "Rubrica cainelui din tabelul adapostului": </h3>
        </div>
        <form action="comp/adapostEdit.php" method="POST">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Data</span>
                </div>
                <input type="text" class="form-control" name="tab_data" placeholder="<?php echo $tab_data;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Data cazarii</span>
            </div>
            <input type="text" class="form-control" name="tab_datacazarii" placeholder="<?php echo $tab_datacazarii;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. fisa</span>
            </div>
            <input type="text" class="form-control" name="tab_nrfisa"  placeholder="<?php echo $tab_nrfisa;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Caracteristici individuale</span>
            </div>
            <input type="text" class="form-control" name="tab_caracteristici" placeholder="<?php echo $tab_caracteristici;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. caini prinsi</span>
            </div>
            <input type="text" class="form-control" name="tab_nrcprinsi" placeholder="<?php echo $tab_nrcprinsi;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. caini revendicati</span>
            </div>
            <input type="text" class="form-control" name="tab_nrcrevendic"  placeholder="<?php echo $tab_nrcrevendic;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. caini adoptati</span>
            </div>
            <input type="text" class="form-control" name="tab_nrcadopt"  placeholder="<?php echo $tab_nrcadopt;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. caini mentinuti</span>
            </div>
            <input type="text" class="form-control" name="tab_nrcmentin"  placeholder="<?php echo $tab_nrcmentin;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. caini decedati</span>
            </div>
            <input type="text" class="form-control" name="tab_nrcdecedati"  placeholder="<?php echo $tab_nrcdecedati;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-md mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-md">Motiv deces/<br>Subst. folosita</span>
            </div>
            <input type="text" class="form-control" name="tab_motiv"  placeholder="<?php echo $tab_motiv;?>" aria-describedby="inputGroup-sizing-md">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Data vaccinarii antiarabice</span>
            </div>
            <input type="text" class="form-control" name="tab_datavacc"  placeholder="<?php echo $tab_datavacc;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Data deparazitarii</span>
            </div>
            <input type="text" class="form-control" name="tab_datadeparat"  placeholder="<?php echo $tab_datadeparat;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Data sterilizarii</span>
            </div>
            <input type="text" class="form-control" name="tab_datasteriliz"  placeholder="<?php echo $tab_datasteriliz;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Medic/asistent/tehnician</span>
            </div>
            <input type="text" class="form-control" name="tab_medic"  placeholder="<?php echo $tab_medic;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Data predarii</span>
            </div>
            <input type="text" class="form-control" name="tab_datapredarii"  placeholder="<?php echo $tab_datapredarii;?>" aria-describedby="inputGroup-sizing-sm">
            </div>


            <div class="buttons p-5">
                <!-- cele doua butone se numeau ADAUGA SI ANULEAZA -->
                <input class="mx-3 mb-3" id="salvare" type="submit" name="salvare-tabAdapost" value="Salvare">
                <input class="mx-3 mb-3" id="anulare" type="submit" name="anulare-tabAdapost" value="Anulare" onclick="exitEdit()">
            </div>
        </form>
    </div>

    <div class="container-fluid editare-wrapper" id="edit-table">
        <div class="col-s-12 my-5 p-2 editare-text text-center set-smalltext">
            <h3>Editare "Fisa cainelui": </h3>
        </div>
        <form action="comp/detEdit.php" method="POST" enctype="multipart/form-data">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Proprietar</span>
                </div>
                <input type="text" class="form-control" name="ce_proprietar" placeholder="<?php echo $c_proprietar;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <br>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nume</span>
                </div>
                <input type="text" class="form-control" name="deted_nume" placeholder="<?php echo $det_nume;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nr. Matricol</span>
            </div>
            <input type="text" class="form-control" name="det_nrmatricol" placeholder="<?php echo $det_nrmatricol;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Tronson</span>
            </div>
            <input type="text" class="form-control" name="det_tronson" placeholder="<?php echo $det_tronson;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Cusca</span>
            </div>
            <input type="text" class="form-control" name="det_cusca" placeholder="<?php echo $det_cusca;?>" aria-describedby="inputGroup-sizing-sm">
            </div>


            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Numarul fisei de adoptie:</span>
                </div>
                <input type="text" class="form-control" name="c_nrfisaadoptie" placeholder="<?php echo $c_nrfisaadoptie;?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>


            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">An nastere</span>
            </div>
            <input type="text" class="form-control" name="det_varsta"  placeholder="<?php echo $det_varsta;?>" aria-describedby="inputGroup-sizing-sm">
            </div>
            <fieldset class="form-group mb-2">
            <div class="sex-details" style="
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 50%;
                text-align: center;
                background: #E9ECEF;
                border-radius: 4px;
                border: solid #CED4DA 1px;
            ">
            <legend class="col-form-label pt-0" style="border-right:solid #CED4DA 1px; padding: 2px 0 0 0">
                Sex: 
            </legend>
            <div class="radio">
                <div class="custom-control custom-radio custom-control-inline" style="border-right:solid #CED4DA 1px; padding-right: 20px;">
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
            <!--<div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Culoare</span>
            </div>
            <input type="text" class="form-control" name="det_culoare"  placeholder="<?php echo $det_culoare;?>" aria-describedby="inputGroup-sizing-sm">
            </div>-->
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Semne particulare</span>
            </div>
            <input type="text" class="form-control" name="det_semnpartic"  placeholder="<?php echo $det_semnpartic;?>" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Adoptat</span>
            </div>
            <input type="text" class="form-control" name="det_dataadopt"  placeholder="Data (exemplu: 2000-01-30)" aria-describedby="inputGroup-sizing-sm">
            <input type="text" class="form-control" name="det_numpersadopt"  placeholder="Numele persoanei" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Decedat</span>
            </div>
            <input type="text" class="form-control date_picker_trigger" name="det_datadecedat" placeholder="Data (exemplu: 2005-06-29)" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Observatii</span>
            </div>
            <input type="text" class="form-control" name="det_observatii"  placeholder="Adauga la observatiile actuale" aria-describedby="inputGroup-sizing-sm">
            <input type="text" class="form-control" name="det_observatii_erase"  placeholder="Sterge observatiile actuale si adauga observatiile noi" aria-describedby="inputGroup-sizing-sm">
            </div>
            <!-- 1 -->
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="data-ultim-vaccin">Data ultimului vaccin:</span>
            </div>
            <input type="text" class="form-control date_picker_trigger" name="det_datultvacc" placeholder="Data (exemplu: 2005-06-29)" aria-describedby="data-ultim-vaccin">
            </div>
            <!-- x 1 -->
            <!-- 2 -->
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="data-ultim-deparazitare">Data ultimei deparazitari:</span>
            </div>
            <input type="text" class="form-control date_picker_trigger" name="det_datultdep" placeholder="Data (exemplu: 2006-12-30)" aria-describedby="data-ultim-deparazitare">
            </div>
            <!-- x 2 -->

            <div class="custom-file">
                <input type="file" class="custom-file-input" name="img" id="customFile">
                <label class="custom-file-label" for="customFile" value='false'>Imagine caine</label>  
            </div>

            <br><br><br><br>
            

            <div style="margin-top: 30px" class="buttons">
                <input class="mx-3 mb-3" id="salvare" type="submit" name="salvare" value="Salvare">
                <input class="mx-3 mb-3" id="anulare" type="submit" name="anulare" value="Anulare" onclick="cancelEdit()">

            </div>
            <!-- archive reference buttons -->
            <div class="arhive-bg" style="width:100%; background: #d1d1d1; padding: 3px 0; margin-top: 20px">     
                <div class="my-5 archive_btn">
                    <center><p>Arhiva:</p></center>
                    <button id="btn_decedat" type="button" class="btn btn_archive" data-toggle="modal" data-target="#arhiveModalDecedat">
                        DECEDAT
                    </button>
                    <button id="btn_adoptat" type="button" class="btn btn_archive" data-toggle="modal" data-target="#arhiveModalAdoptat">
                        ADOPTAT
                    </button>

                </div>
            </div>

            <!-- modal decedati -->
                <div class="modal fade" id="arhiveModalDecedat" tabindex="-1" role="dialog" aria-labelledby="arhiveModalDecedatCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="arhiveModalDecedatLongTitle">Data iesirii din adapost:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control date_picker_trigger" name="caine_decedat" placeholder="exemplu: 2000-01-01">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchidere</button>
                        <input type="submit" class="btn btn-success" name="btn_imp_decedat" value="Salveaza">
                    </div>
                    </div>
                </div>
                </div>
            <!-- x modal -->

            <!-- modal adoptat -->
                <div class="modal fade" id="arhiveModalAdoptat" tabindex="-1" role="dialog" aria-labelledby="arhiveModalAdoptatCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="arhiveModalAdoptatLongTitle">Data iesirii din adapost:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control date_picker_trigger" name="caine_adoptat" placeholder="exemplu: 2000-01-01">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchidere</button>
                        <button type="submit" class="btn btn-success" name="btn_imp_adoptat">Salveaza</button>
                    </div>
                    </div>
                </div>
                </div>
            <!-- x modal -->


        </form>
    </div>

    <style>
        .archive_btn{
            width: 100%;
            text-align: center;
        }
        .archive_btn .btn_archive{
            background: blue;
            padding: 0.8em 3.5em 0.8em 3.5em;
        }
        #btn_decedat{
            margin-right: 40px;
            background: #6d6d6d;
            font-weight: 800;
            color: #fff;

            border: 2px solid #6d6d6d;
            border-radius: 15px;
            box-shadow: 0px 1px 5px rgba(0,0,0,0.4);

        }
        #btn_decedat:hover{
            background: #545454;
            border-color: #F3F3F3;
            box-shadow: none;
        }
        #btn_adoptat{
            margin-left: 40px;
            background: #286db7;
            font-weight: 800;
            color: #fff;
            
            border: 2px solid #286db7;
            border-radius: 15px;
            box-shadow: 0px 1px 5px rgba(0,0,0,0.4);
        }
        #btn_adoptat:hover{
            background: #1f5996;
            border-color: #F3F3F3;
            box-shadow: none;
        }



        #stergere {
            width: 100%;
            margin-top: 50px;
            color: #fff;
            background: #e82929;
            border-color: #e82929;
            padding: 1em;
            border-style: none;
            transition-duration: 150ms;
        }
        #stergere:hover {
            color: #f3f3f3;
            border-color: #f3f3f3;
            box-shadow: none;
            background: #8f1818;
        }

    </style>

    <div class="activate-edit" id="edit-table-trigger">
        <button onclick="activeEdit()"><i class="far fa-edit"></i>EDITARE FISA</button>
    </div>
</div>

<style>
    .btn-print{
        width: 100%;
        text-align: center;
    }
    #btn-print{
        margin-top: 10px;
        padding: 5px 25px 5px 25px;
        background: #198b3f;
        border: solid 1px #fff;
        font-weight: 888;
        color: #fff;
        border-radius: 10px;
        transition-duration: 200ms;
    }
    #btn-print:hover{
        color: #198b3f;
        border: solid 1px #198b3f;
        background: #fff;
    }

    /* print pages */
    .print-container{
        font-family: 'Arial';
        width: 100%;
        background: #fff;
    }
    .pag1 .list{
        margin-left: 30px;
        list-style-type: none;
        font-size: 200%;
    }
    .list li {
    }
    .list li span{
        background: green;
        text-transform: underline;
        width: 100%;
    }
    .pag1{
        margin: auto;
        
        width: 90%;
        height: 100%;
    }
    .pag2{
        margin: auto;
        width: 95%;
        height: 100%;
    }
</style>

<div id="print-body" class="print-container" style="display: none">
    <div class="pag1">     
        <h6>FUNDATIA SPERANTA <?php echo date("Y"); ?></h6>
        <br><br>

        <ul class="list">
            <li style="font-weight: 800; margin-bottom: 20px;">
            
            
            <div class="row">
                    <div class="col-6">
                        <b>Nr. Fisa:</b>  <?php echo $c_nrfisaadoptie; ?>    
                    </div>
                    <div class="col-6 text-right">
                        <b>NUME: </b> <?php echo $det_nume; ?> 
                    </div>       
                </div><br><br>
            <li>
                           
            </li>
            <li>
                <div class="row">
                    <div class="col-3">
                        <b>MICROCIP:</b>
                    </div>
                    <div class="col-9 text-right">
                        <?php echo $det_serie;?>                 
                    </div>
                </div> <hr>          
            </li>
            <li>
                <div class="row">
                    <div class="col-3">
                        <b>NR.MATRICOL:</b> 
                    </div>
                    <div class="col-9 text-right">
                        <?php echo $det_nrmatricol; ?>
                    </div> 
                </div> <hr>       
            </li>
            <li>
                <div class="row">
                    <div class="col-3">
                        <b>TRONSON:</b>  
                    </div>
                    <div class="col-9 text-right">
                        <?php echo $det_tronson; ?>
                    </div>
                </div> <hr>        
            </li>
            <li>
                <div class="row">
                    <div class="col-3">
                        <b>CUSCA:</b>
                    </div>
                    <div class="col-9 text-right">
                        <?php echo $det_cusca; ?>   
                    </div>
                </div> <hr>
            </li>
            <li>
                <div class="row">
                    <div class="col-6">
                        <b>AN NASTERE:</b>
                    </div>
                    <div class="col-6 text-right">
                        <?php echo $det_varsta; ?>   
                    </div>
                </div> <hr> 
            </li>

            <li>
                <div class="row">
                    <div class="col-6">
                        <b>SEX:</b>
                    </div>
                    <div class="col-6 text-right">
                        <?php echo $det_sex; ?>   
                    </div>
                </div> <hr> 
            </li>    

            <li>
                <div class="row">
                    <div class="col-3">
                        <b>SEMNE PARTICULARE:</b>     
                    </div>
                    <div class="col-9 text-right">
                        <?php echo $det_semnpartic; ?>
                    </div>
                </div> <hr> 
            </li>
            <li>
                <div class="row">
                    <div class="col-3">
                        <b>STERILIZAT:</b>
                    </div>
                    <div class="col-9 text-right">
                        <?php if($checkSterilizat == 1){ echo "DA";} else { echo "NU"; }?>  
                    </div>
                </div> <hr>
            </li>
            <li>
                <div class="row">
                    <div class="col-12">
                        <b>OBSERVATII:</b> 
                    </div>

                    <div class="col-12">
                        <?php echo $det_observatii; ?>
                    </div>
                </div>
            
            </li>
        </ul>

        <br><br>
    </div>

    <div class="pag2">
        <div>
            <table style="width:100%; table-layout: fixed;">
                <thead>
                    <tr style="border: 1px solid #000; text-align: center; padding: 10px;">
                        <th style="border-right: 1px solid #000; padding: 20px"><a style="color: #000">DATA</a></th>
                        <th style="border-right: 1px solid #000; padding: 20px"><a style="color: #000">SEMNE CLINICE</a></th>
                        <th style="border-right: 1px solid #000; padding: 20px"><a style="color: #000">DIAGNOSTIC</a></th>
                        <th style="border-right: 1px solid #000; padding: 20px"><a style="color: #000">TRATAMENT</a></th>
                        <th style="border-right: 1px solid #000; padding: 20px"><a style="color: #000">VACCIN</a></th>
                        <th style="padding: 20px"><a style="color: #000">OBSERVATII</a></th>
                    </tr>
                </thead>
                <tbody> 
                    <?php while($rowSpec2 = mysqli_fetch_assoc($resultSpec2)): ?>
                    <tr style="border:1px solid #000">
                        <td style="border:1px solid #000; word-wrap:break-word;"><?php echo $rowSpec2['spec_data'];?></td>
                        <td style="border:1px solid #000; word-wrap:break-word;"><?php echo $rowSpec2['spec_semneclinice'];?></td>
                        <td style="border:1px solid #000; word-wrap:break-word;"><?php echo $rowSpec2['spec_diagnostic'];?></td>
                        <td style="border:1px solid #000; word-wrap:break-word;"><?php echo $rowSpec2['spec_tratament'];?></td>
                        <td style="border:1px solid #000; word-wrap:break-word;"><?php echo $rowSpec2['spec_vaccin'];?></td>
                        <td style="border:1px solid #000; word-wrap:break-word;"><?php echo $rowSpec2['spec_observatii'];?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    document.getElementById("salvare").addEventListener("click", alert1);
    document.getElementById("anulare").addEventListener("click", reload);


    function createPrint(){
        document.getElementById("full_page").style.display='none';
        document.getElementById("top-header").style.display='none';
        document.getElementById("mySidenav").style.display='none';
        document.getElementById("print").style.display='block';
    }
    

    function reload(){
        window.reload();
    }
    function activeEdit(){
        document.getElementById("edit-table").style.display="block";
        document.getElementById("edit-table-trigger").style.display="none";
    }
    function cancelEdit(){
        document.getElementById("edit-table").style.display="none";
        document.getElementById("edit-table-trigger").style.display="block";
    }
    function fullCancel(){
        document.getElementById("fulltabel-edit").style.display="block";
    }
    function adapEdit(){
        document.getElementById("tabel-adapost").style.display="block";
    }
    function exitEdit(){
        document.getElementById("tabel-adapost").style.display="none";
    }

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    
    function openNav() {
    document.getElementById("mySidenav").style.width = "270px";
    document.getElementById("overlay").style.display = "block";
    document.getElementById("text").style.width = "270px";
    document.getElementById("copyright").style.display="block";
    }

    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("overlay").style.display = "none";
    document.getElementById("text").style.width = "-50px";
    document.getElementById("copyright").style.display="none";
    }

  

</script>

<script>
    document.getElementById('btn-print').addEventListener('click', revealOpen);

    function revealOpen(){
        document.getElementById('print-body').style.display='block';
        
        document.getElementById('full_page').style.display='none';
    }
</script>

</body>
</html>