<?php 
    session_id("login-session");
    session_start();
	
    if (!isset($_SESSION['login-true']) || $_SESSION['login-true'] != true) {
        header("Location: ./index.php");
		die;
	}
	else{
        include '../comp/dbh.php';
    }

	if(isset($_GET['deconectare'])){
			$_SESSION['login-true']= false;
			session_destroy();
			header('Location: ../fundatia-speranta/index.php');
			die;
    }
    
    $paginationVar ="";
    // criteria values 
        $microcipVal ="";
        $dataCaptVal ="";
        $identVal    ="";
        $locCaptVal ="";
        $datsioraCazVal ="";
        $caracteristiciVal ="";
        $nrfisaVal ="";
        $dataDeparazVal ="";
        $dataVaccVal ="";
        $dataSterilVal ="";
        $decedatVal ="";
        $numeProprietarVal ="";

        $medDataVal ="";
        $medSemneVal ="";
        $medDiagnosticVal ="";
        $tratamentVal="";
        $medVaccVal ="";
        $medObsVal ="";

        $detalii_numeVal ="";
        $obsertatiiCaineVal ="";
        $nrMatricolVal ="";
        $nrTronsonVal ="";
        $cuscaVal ="";
        $anNastereVal ="";
        $sexCaineVal = "";
        $datUltDepVal ="";
        $datUltVaccVal ="";
    

        $tabelActivate = false;
        $detActivate = false;
        $detaliiActivate = false;
    
        /* error fixer */
        $sexCaine_inp='';


    if(isset($_POST['btn_search'])){

        // variables 
            $microcip = mysqli_real_escape_string($conn, $_POST['microcip_inp_val']);
            $ident = mysqli_real_escape_string($conn, $_POST['nrident_inp']);
            $dataCapt = mysqli_real_escape_string($conn, $_POST['datacapt_inp']);
            $dataCaptFrom = mysqli_real_escape_string($conn, $_POST['datacapt_inp_from']);
            $dataCaptTo = mysqli_real_escape_string($conn, $_POST['datacapt_inp_to']);
            $locCapt = mysqli_real_escape_string($conn, $_POST['loccapt_inp']);
            $datsioraCaz = mysqli_real_escape_string($conn, $_POST['datoracaz_inp']);
            $datsioraCazFrom = mysqli_real_escape_string($conn, $_POST['datoracaz_inp_from']);
            $datsioraCazTo = mysqli_real_escape_string($conn, $_POST['datoracaz_inp_to']);
            $caracteristici = mysqli_real_escape_string($conn, $_POST['caracter_inp']);
            $nrfisa = mysqli_real_escape_string($conn, $_POST['nrfisa_inp']);
            $dataDeparaz = mysqli_real_escape_string($conn, $_POST['datdeparazit_inp']);
            $dataDeparazFrom = mysqli_real_escape_string($conn, $_POST['datdeparazit_inp_from']);
            $dataDeparazTo = mysqli_real_escape_string($conn, $_POST['datdeparazit_inp_to']);
            $dataVacc = mysqli_real_escape_string($conn, $_POST['datvacc_inp']);
            $dataVaccFrom = mysqli_real_escape_string($conn, $_POST['datvacc_inp_from']);
            $dataVaccTo = mysqli_real_escape_string($conn, $_POST['datvacc_inp_to']);
            $dataSteril = mysqli_real_escape_string($conn, $_POST['datsteril_inp']);
            $dataSterilFrom = mysqli_real_escape_string($conn, $_POST['datsteril_inp_from']);
            $dataSterilTo = mysqli_real_escape_string($conn, $_POST['datsteril_inp_to']);
            $decedat = mysqli_real_escape_string($conn, $_POST['decedat_inp']);
            $decedatFrom = mysqli_real_escape_string($conn, $_POST['decedat_inp_from']);
            $decedatTo = mysqli_real_escape_string($conn, $_POST['decedat_inp_to']);
            
            // FISA MEDIACALA 
            $tratament = mysqli_real_escape_string($conn, $_POST['tratament_inp']);
            $medData = mysqli_real_escape_string($conn, $_POST['med_data_inp']);
            $medDataFrom = mysqli_real_escape_string($conn, $_POST['med_data_inp_from']);
            $medDataTo = mysqli_real_escape_string($conn, $_POST['med_data_inp_to']);
            $medSemne = mysqli_real_escape_string($conn, $_POST['med_semne_inp']); 
            $medDiagnostic = mysqli_real_escape_string($conn, $_POST['med_diagnostic_inp']);
            $medVacc = mysqli_real_escape_string($conn, $_POST['med_vaccin_inp']); 
            $medObs = mysqli_real_escape_string($conn, $_POST['med_obs_inp']);

            // FISA CATELULUI 
            $detalii_nume = mysqli_real_escape_string($conn, $_POST['nume_inp']);
            $numeProprietar = mysqli_real_escape_string($conn, $_POST['nume_proprietar_inp']);
            $obsertatiiCaine = mysqli_real_escape_string($conn, $_POST['observatii_caine_inp']);
            $nrMatricol = mysqli_real_escape_string($conn, $_POST['nr_matricol_inp']);
            $nrTronson = mysqli_real_escape_string($conn, $_POST['tronson_inp']);
            $cusca = mysqli_real_escape_string($conn, $_POST['cusca_inp']);
            $anNastere = mysqli_real_escape_string($conn, $_POST['anNastere_inp']);
            
            $datUltDep = mysqli_real_escape_string($conn, $_POST['datultdeparazit_inp']);
            $datUltDepFrom = mysqli_real_escape_string($conn, $_POST['datultdeparazit_inp_from']);
            $datUltDepTo = mysqli_real_escape_string($conn, $_POST['datultdeparazit_inp_to']);
            $datUltVacc = mysqli_real_escape_string($conn, $_POST['datultvacc_inp']);
            $datUltVaccFrom = mysqli_real_escape_string($conn, $_POST['datultvacc_inp_from']);
            $datUltVaccTo = mysqli_real_escape_string($conn, $_POST['datultvacc_inp_to']);

            /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                DE ADAUGAT VARIABILE TABEL SPECIAL
            !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

            
        // microcip
        if(isset($_POST['microcip_check'])){
            $tabelActivate = true;
            if(!empty($microcip)){
                $microcipVal = "`c_microcip` like '$microcip'";
            }
        }
        // nr. itent
        if(isset($_POST['nrident_check'])){
            $tabelActivate = true;
            if(!empty($ident)){
                $identVal = "`c_identificare` like '$ident'";
            }
        }
        // data capt.
        if(isset($_POST['datacapt_check'])){
            $tabelActivate = true;
            if(!empty($dataCapt) && empty($dataCaptFrom) && empty($dataCaptTo)){
                $dataCaptVal = "`c_datacapt` like '$dataCapt'";
            }
            if(empty($dataCapt) && !empty($dataCaptFrom) && !empty($dataCaptTo)){
                $dataCaptVal = "`c_datacapt` BETWEEN '$dataCaptFrom' AND '$dataCaptTo'";
            }
        }
        // loc. capt.
        if(isset($_POST['loccapt_check'])){
            $tabelActivate = true;
            if(!empty($locCapt)){
                $locCaptVal = "`c_loccapt` like '$locCapt'";
            }

            if(!empty($locCapt)){
                $locStr = $locCapt;
                $locStr = explode(' ', $locStr);
                $locCaptVal = "`c_loccapt` like ";
                $locArr = array();
                foreach ($locStr as $index => $val) {$locArr[] = " '%$locStr[$index]%'";}
                $loc_cond = join(" AND `c_loccapt` like ", $locArr);
                if ($loc_cond != '') $locCaptVal .= " $loc_cond";
            }
        }
        // data si ora cazare adapost
        if(isset($_POST['datoracaz_check'])){
            $tabelActivate = true;
            if(!empty($datsioraCaz) && empty($datsioraCazFrom) && empty($datsioraCazTo)){
                $datsioraCazVal = "`c_datcazare` like '$datsioraCaz'";
            }
            if(empty($datsioraCaz) && !empty($datsioraCazFrom) && !empty($datsioraCazTo)){
                $datsioraCazVal = "`c_datcazare` BETWEEN '$datsioraCazFrom' AND '$datsioraCazTo'";
            }
        }
        // caracteristici
        if(isset($_POST['caracter_check'])){
            $tabelActivate = true;
            if(!empty($caracteristici)){
                $caracterStr = $caracteristici;
                $caracterStr = explode(' ', $caracterStr);
                $caracteristiciVal = "`c_caracteristici` like ";
                $caracterArr = array();
                foreach ($caracterStr as $index => $val) {$caracterArr[] = " '%$caracterStr[$index]%'";}
                $caracter_cond = join(" AND `c_caracteristici` like ", $caracterArr);
                if ($caracter_cond != '') $caracteristiciVal .= " $caracter_cond";
            }
        }
        // nr. fisa
        if(isset($_POST['nrfisa_check'])){
            $tabelActivate = true;
            if(!empty($nrfisa)){
                $nrfisaVal = "`c_nrfisaadoptie` like '$nrfisa'";
            }
        }
        // data deparazitarii
        if(isset($_POST['datdeparazit_check'])){
            $tabelActivate = true;
            if(!empty($dataDeparaz) && empty($dataDeparazFrom) && empty($dataDeparazTo)){
                $dataDeparazVal = "`c_datdeparazit` like '$dataDeparaz'";
            }
            if(empty($dataDeparaz) && !empty($dataDeparazFrom) && !empty($dataDeparazTo)){
                $dataDeparazVal = "`c_datdeparazit` BETWEEN '$dataDeparazFrom' AND '$dataDeparazTo'";
            }
        }
        // data vacc
        if(isset($_POST['datvacc_check'])){
            $tabelActivate = true;
            if(!empty($dataVacc) && empty($dataVaccFrom) && empty($dataVaccTo)){
                $dataVaccVal = "`c_datvacc` like '$dataVacc'";
            }
            if(empty($dataVacc) && !empty($dataVaccFrom) && !empty($dataDeparazTo)){
                $dataVaccVal = "`c_datvacc` BETWEEN '$dataVaccFrom' AND '$dataVaccTo'";
            }
        }
        // data sterilizarii
        if(isset($_POST['datsteril_check'])){
            $tabelActivate = true;

            if(isset($_POST['datsterilNesteril_check'])){
                $dataSterilVal = "`c_steril` = 0";
            }
            if(isset($_POST['datsterilSteril_check'])){            
                if(!empty($dataSteril) && empty($dataSterilFrom) && empty($dataSterilTo)){
                    $dataSterilVal = "`c_steril` like '$dataSteril'";
                }
                if(empty($dataSteril) && !empty($dataSterilFrom) && !empty($dataSterilTo)){
                    $dataSterilVal = "`c_steril` BETWEEN '$dataSterilFrom' AND '$dataSterilTo'";
                }
            }
        }
        // decedat
        if(isset($_POST['decedati_check'])){
            $tabelActivate = true;
            if(!empty($decedat) && empty($decedatFrom) && empty($decedatTo)){
                $decedatVal = "`c_decedati` like '$decedat'";
            }
            if(empty($decedat) && !empty($decedatFrom) && !empty($decedatTo)){
                $decedatVal = "`c_decedati` BETWEEN '$decedatFrom' AND '$decedatTo'";
            }
        }
        
        
        // nume proprietar
        if(isset($_POST['numeProprietar_check'])){
            $tabelActivate = true;
            if(!empty($numeProprietar)){
                $proprietarStr = $numeProprietar;
                $proprietarStr = explode(' ', $proprietarStr);
                $numeProprietarVal = "`c_proprietar` like ";
                $proprietarArr = array();
                foreach ($proprietarStr as $index => $val) {$proprietarArr[] = " '%$proprietarStr[$index]%'";}
                $proprietar_cond = join(" AND `c_proprietar` like ", $proprietarArr);
                if ($proprietar_cond != '') $numeProprietarVal .= " $proprietar_cond";
            }
            
        }

        /*==============================
                 FISA MEDICALA  
        ==============================*/     

        // data
        if(isset($_POST['med_data_check'])){
            $detActivate = true;
            if(!empty($medData) && empty($medDataFrom) && empty($medDataTo)){
                $medDataVal = "`spec_data` like '$medData'";
            }
            if(empty($medData) && !empty($medDataFrom) && !empty($medDataTo)){
                $medDataVal = "`spec_data` BETWEEN '$medDataFrom' AND '$medDataTo'";
            }
        }
        // semne clinice
        if(isset($_POST['med_semne_check'])){
            $detActivate = true;
            if(!empty($medSemne)){
                $semneStr = $medSemne;
                $semneStr = explode(' ', $semneStr);
                $medSemneVal = "`spec_semneclinice` like ";
                $semneArr = array();
                foreach ($semneStr as $index => $val) {$semneArr[] = " '%$semneStr[$index]%'";}
                $semne_cond = join(" AND `spec_semneclinice` like ", $semneArr);
                if ($semne_cond != '') $medSemneVal .= " $semne_cond";
            }
        }
        // diagnostic
        if(isset($_POST['med_diagnostic_check'])){
            $detActivate = true;
            if(!empty($medDiagnostic)){
                $diagnosticStr = $medDiagnostic;
                $diagnosticStr = explode(' ', $diagnosticStr);
                $medDiagnosticVal = "`spec_diagnostic` like ";
                $diagnosticArr = array();
                foreach ($diagnosticStr as $index => $val) {$diagnosticArr[] = " '%$diagnosticStr[$index]%'";}
                $diagnostic_cond = join(" AND `spec_diagnostic` like ", $diagnosticArr);
                if ($diagnostic_cond != '') $medDiagnosticVal .= " $diagnostic_cond";
            }
        }
        // tratament
        if(isset($_POST['tratament_check'])){
            $detActivate = true;
            if(!empty($tratament)){
                $tratamentStr = $tratament;
                $tratamentStr = explode(' ', $tratamentStr);
                $tratamentVal = "`spec_tratament` like ";
                $tratamentArr = array();
                foreach ($tratamentStr as $index => $val) {$tratamentArr[] = " '%$tratamentStr[$index]%'";}
                $tratament_cond = join(" AND `spec_tratament` like ", $tratamentArr);
                if ($tratament_cond != '') $tratamentVal .= " $tratament_cond";
            }
        
        }
        // vaccin
        if(isset($_POST['med_vaccin_check'])){
            $detActivate = true;
            if(!empty($medVacc)){
                $vaccStr = $medVacc;
                $vaccStr = explode(' ', $vaccStr);
                $medVaccVal = "`spec_vaccin` like ";
                $vaccArr = array();
                foreach ($vaccStr as $index => $val) {$vaccArr[] = " '%$vaccStr[$index]%'";}
                $vacc_cond = join(" AND `spec_vaccin` like ", $vaccArr);
                if ($vacc_cond != '') $medVaccVal .= " $vacc_cond";
            }
        
        }
        // observatii
        if(isset($_POST['med_obs_check'])){
            $detActivate = true;
            if(!empty($medObs)){
                $obsStr = $medObs;
                $obsStr = explode(' ', $obsStr);
                $medObsVal = "`spec_observatii` like ";
                $obsArr = array();
                foreach ($obsStr as $index => $val) {$obsArr[] = " '%$obsStr[$index]%'";}
                $obs_cond = join(" AND `spec_observatii` like ", $obsArr);
                if ($obs_cond != '') $medObsVal .= " $obs_cond";
            }
        
        }


        /*==============================
                 FISA CATEL  
        ==============================*/     

        // nume
        if(isset($_POST['nume_check'])){
            $detaliiActivate = true;
            if(!empty($detalii_nume)){
                $detalii_numeVal = "`det_nume` like '$detalii_nume'";
            }
            
        }
        // observatii caine
        if(isset($_POST['obs_caine_check'])){
            $detaliiActivate = true;
            if(!empty($obsertatiiCaine)){
                $obsCaineStr = $obsertatiiCaine;
                $obsCaineStr = explode(' ', $obsCaineStr);
                $obsertatiiCaineVal = "`det_observatii` like ";
                $obsCaineArr = array();
                foreach ($obsCaineStr as $index => $val) {$obsCaineArr[] = " '%$obsCaineStr[$index]%'";}
                $obsCaine_cond = join(" AND `det_observatii` like ", $obsCaineArr);
                if ($obsCaine_cond != '') $obsertatiiCaineVal .= " $obsCaine_cond";
            }
        }
        // nr matricol
        if(isset($_POST['nr_matricol_check'])){
            $detaliiActivate = true;
            if(!empty($nrMatricol)){
                $nrMatricolStr = $nrMatricol;
                $nrMatricolStr = explode(' ', $nrMatricolStr);
                $nrMatricolVal = "`det_nrmatricol` like ";
                $nrMatricolArr = array();
                foreach ($nrMatricolStr as $index => $val) {$nrMatricolArr[] = " '%$nrMatricolStr[$index]%'";}
                $nrMatricol_cond = join(" AND `det_nrmatricol` like ", $nrMatricolArr);
                if ($nrMatricol_cond != '') $nrMatricolVal .= " $nrMatricol_cond";
            }
        }
        // tronson
        if(isset($_POST['tronson_check'])){
            $detaliiActivate = true;
            if(!empty($nrTronson)){
                $nrTronsonStr = $nrTronson;
                $nrTronsonStr = explode(' ', $nrTronsonStr);
                $nrTronsonVal = "`det_tronson` like ";
                $nrTronsonArr = array();
                foreach ($nrTronsonStr as $index => $val) {$nrTronsonArr[] = " '%$nrTronsonStr[$index]%'";}
                $nrTronson_cond = join(" AND `det_tronson` like ", $nrTronsonArr);
                if ($nrTronson_cond != '') $nrTronsonVal .= " $nrTronson_cond";
            }
        }
        // cusca
        if(isset($_POST['cusca_check'])){
            $detaliiActivate = true;
            if(!empty($cusca)){
                $cuscaStr = $cusca;
                $cuscaStr = explode(' ', $cuscaStr);
                $cuscaVal = "`det_cusca` like ";
                $cuscaArr = array();
                foreach ($cuscaStr as $index => $val) {$cuscaArr[] = " '%$cuscaStr[$index]%'";}
                $cusca_cond = join(" AND `det_cusca` like ", $cuscaArr);
                if ($cusca_cond != '') $cuscaVal .= " $cusca_cond";
            }
        }
        // an nastere
        if(isset($_POST['anNastere_check'])){
            $detaliiActivate = true;
            if(!empty($anNastere)){
                $anNastereStr = $anNastere;
                $anNastereStr = explode(' ', $anNastereStr);
                $anNastereVal = "`det_varsta` like ";
                $anNastereArr = array();
                foreach ($anNastereStr as $index => $val) {$anNastereArr[] = " '%$anNastereStr[$index]%'";}
                $anNastere_cond = join(" AND `det_varsta` like ", $anNastereArr);
                if ($anNastere_cond != '') $anNastereVal .= " $anNastere_cond";
            }
        }
        // sex caine
        if(isset($_POST['sex_caine_check'])){
            $detaliiActivate = true;
            $sexCaine = $_POST['sexCaine_inp'];
            if(isset($sexCaine)){
                $sexCaineVal = "`det_sex` like '$sexCaine'";
            }
        }
        // data ultim deparazit
        if(isset($_POST['datultdeparazit_check'])){
            $detaliiActivate = true;
            if(!empty($datUltDep) && empty($datUltDepFrom) && empty($datUltDepTo)){
                $datUltDepVal = "`det_datultdep` like '$datUltDep'";
            }
            if(empty($datUltDep) && !empty($datUltDepFrom) && !empty($datUltDepTo)){
                $datUltDepVal = "`det_datultdep` BETWEEN '$datUltDepFrom' AND '$datUltDepTo'";
            }
        }
        // data ultim vaccin
        if(isset($_POST['datultvacc_check'])){
            $detaliiActivate = true;
            if(!empty($datUltVacc) && empty($datUltVaccFrom) && empty($datUltVaccTo)){
                $datUltVaccVal = "`det_datultvacc` like '$datUltVacc'";
            }
            if(empty($datUltVacc) && !empty($datUltVaccFrom) && !empty($datUltVaccTo)){
                $datUltVaccVal = "`det_datultvacc` BETWEEN '$datUltVaccFrom' AND '$datUltVaccTo'";
            }
        }



        


        $closebracket = '';
        $detCloseBracket = '';
        $sql = "SELECT * FROM ";

        if ($tabelActivate == true && $detActivate == false) $sql .= "`catei_tabel_arhiva`";
        if ($detActivate == true && $tabelActivate == false) {
            $sql .= "catei_tabel_arhiva WHERE c_microcip IN (SELECT DISTINCT spec_serie FROM specific_details";
            $closebracket = ')';
        }
        if ($tabelActivate == true && $detActivate == true) {
            $sql .= "catei_tabel_arhiva WHERE c_microcip IN (SELECT DISTINCT spec_serie FROM specific_details";
            $closebracket = ') AND ';
        }
        if ((($tabelActivate == true && $detActivate == true) || ($tabelActivate == true && $detActivate == false) || ($tabelActivate == false && $detActivate == true)) && $detaliiActivate == true) {
            $closebracket .= "c_microcip IN (SELECT DISTINCT det_serie FROM details WHERE ";
            $detCloseBracket = ') AND ';
        }

        
        if (($tabelActivate == false && $detActivate == false) && $detaliiActivate == true) {
            $sql .= "catei_tabel_arhiva WHERE c_microcip IN (SELECT DISTINCT det_serie FROM details";
            $detCloseBracket = ')';
        }


        

        // conditions for `catei_tabel_arhiva`
        $conditions = array();

        if ($microcipVal != '') $conditions[] = " $microcipVal";
        if ($identVal != '') $conditions[] = " $identVal";
        if ($dataCaptVal != '') $conditions[] = " $dataCaptVal";
        if ($locCaptVal != '') $conditions[] = " $locCaptVal";
        if ($datsioraCazVal != '') $conditions[] = " $datsioraCazVal";
        if ($caracteristiciVal != '') $conditions[] = " $caracteristiciVal";
        if ($nrfisaVal != '') $conditions[] = " $nrfisaVal";
        if ($dataDeparazVal != '') $conditions[] = " $dataDeparazVal"; 
        if ($dataVaccVal != '') $conditions[] = " $dataVaccVal"; 
        if ($dataSterilVal != '') $conditions[] = " $dataSterilVal"; 
        if ($decedatVal != '') $conditions[] = " $decedatVal";
        if ($numeProprietarVal != '') $conditions[] = " $numeProprietarVal";
        $sql_cond = join(" AND ", $conditions);




        // conditions for `spec_tabel`
        $conditionsSpecDet = array();

        if ($medDataVal != '') $conditionsSpecDet[] = " $medDataVal";
        if ($medSemneVal != '') $conditionsSpecDet[] = " $medSemneVal";
        if ($medDiagnosticVal != '') $conditionsSpecDet[] = " $medDiagnosticVal";
        if ($tratamentVal != '') $conditionsSpecDet[] = " $tratamentVal";
        if ($medVaccVal != '') $conditionsSpecDet[] = " $medVaccVal";
        if ($medObsVal != '') $conditionsSpecDet[] = " $medObsVal";
        $sql_condSpecDet = join(" AND ", $conditionsSpecDet); 




        // conditions for `detalii`
        $detArray = array();

        if ($detalii_numeVal != '') $detArray[] = " $detalii_numeVal";
        if ($obsertatiiCaineVal != '') $detArray[] = " $obsertatiiCaineVal";
        if ($nrMatricolVal != '') $detArray[] = " $nrMatricolVal";
        if ($nrTronsonVal != '') $detArray[] = " $nrTronsonVal";
        if ($cuscaVal != '') $detArray[] = " $cuscaVal";
        if ($anNastereVal != '') $detArray[] = " $anNastereVal";
        if ($sexCaineVal != '') $detArray[] = " $sexCaineVal";
        if ($datUltDepVal != '') $detArray[] = " $datUltDepVal";
        if ($datUltVaccVal != '') $detArray[] = " $datUltVaccVal";
        $sql_detCond = join(" AND ", $detArray);
        

        if($tabelActivate == true && $detActivate == false){
            if ($sql_cond != '') $sql .= " WHERE $sql_cond";
        }

        if(($tabelActivate == true && $detActivate == true) || ($detActivate == true && $tabelActivate == false) || ($tabelActivate == true && $detActivate == true && $detaliiActivate == true)){
            if ($sql_condSpecDet != '') $sql .= " WHERE $sql_condSpecDet $closebracket $sql_detCond $detCloseBracket $sql_cond"; 
        }

        if(($tabelActivate == false && $detActivate == false)  && $detaliiActivate == true){
            if ($sql_detCond != '') $sql .= " WHERE $sql_detCond $detCloseBracket"; 
        }

        /*%%%%%%%%%%%%%%%   DEBUGGER   %%%%%%%%%%%%%%% */ echo $sql;


        $result = mysqli_query($conn, $sql);
        $howMany = mysqli_num_rows($result);
        
    }else{
        $sql = "SELECT COUNT(*) FROM catei_tabel_arhiva";
        $result = mysqli_query($conn, $sql);
        $r = mysqli_fetch_row($result);
        $numrows = $r[0];
        $rowsperpage = 15;
        $totalpages = ceil($numrows / $rowsperpage);

        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            $currentpage = (int) $_GET['currentpage'];
        } else {
            $currentpage = 1;
        }
        if ($currentpage > $totalpages) {
            $currentpage = $totalpages;
        } 
        if ($currentpage < 1) {
            $currentpage = 1;
        } 

        $offset = ($currentpage - 1) * $rowsperpage;
        $sql = "SELECT * FROM catei_tabel_arhiva LIMIT $offset, $rowsperpage";
        $result = mysqli_query($conn, $sql);
        $range = 2;

        $pagContent = "";
        $pagContent2 = "";
        $pagContent3 = "";
        $pagContent4 = "";
        $pagContent5 = "";
        $pagContent6 = "";
        if ($currentpage > 1) {
            $pagContent = " <li class='page-item'><a class='text-success page-link' href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a></li> ";
            $prevpage = $currentpage - 1;  
            $pagContent2 = " <li class='page-item'><a class='text-success page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous</a></li> ";
        }
        for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
        if (($x > 0) && ($x <= $totalpages)) {
            if ($x == $currentpage) {
                $pagContent3 = " <li class='page-item active'><a class='bg-success page-link'>$x</a></li> ";
            } else {
                $pagContent4 = " <li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li> ";
            } 
        } 
        } 
        if ($currentpage != $totalpages) {
            $nextpage = $currentpage + 1;
            $pagContent5 = " <li class='page-item'><a class='page-link text-success' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next</a></li> ";
            $pagContent6 = " <li class='page-item'><a class='page-link text-success' href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a></li> ";
        }
        
        $paginationVar = "<br>
        <center>
            <nav style='z-index:0'
			aria-label='Page navigation example'>
                <ul class='pagination justify-content-center'>
                    $pagContent
                    $pagContent2
                    $pagContent3
                    $pagContent4
                    $pagContent5
                    $pagContent6
                </ul>
            </nav>
        </center>
        <br>";
        
        $sqlTotal = "SELECT * FROM catei_tabel_arhiva";
        $resultTotal = mysqli_query($conn, $sqlTotal);
        $howMany = mysqli_num_rows($resultTotal);

    } 
	include 'comp/header.php';
?>
<head><link rel="stylesheet" href="style/style_home.css"></head>
<div class="top-wrapper row">
    <div class="left col-xs-12 col-md-6">
        <h1>Arhiva registru caini</h1>
    </div>  
    <div class="right col-xs-12 col-md-6">
        <!-- Button trigger modal -->
        <button  type="button" class="button-activate-search" data-toggle="modal" data-target="#exampleModal" id="buton-activate-search"><i class="fas fa-search"></i> CAUTARE</button>
    </div> 
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cautare:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-4">
    <!-- microcip -->
                    <label class="container">MICROCIP
                        <input type="checkbox" id="microcip_trigger" name="microcip_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="microcip_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="microcip" name="microcip_inp_val">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- nr. identificare -->
                    <label class="container">NR.IDENTIFICARE
                        <input type="checkbox" id="nrident_trigger" name="nrident_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="nrident_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="nr. identificare" name="nrident_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data capturarii -->
                    <label class="container">DATA.CAPTURARE
                        <input type="checkbox" id="datcapt_trigger" name="datacapt_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div id="datCapt_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="datacapt_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="datacapt_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="datacapt_inp_to">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- locul capturarii -->
                    <label class="container">LOC CAPTURARE
                        <input type="checkbox" id="loccapt_trigger" name="loccapt_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width:100%" id="loccapt_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check inp" type="text" placeholder="locul" name="loccapt_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data si ora cazarii -->
                    <label class="container">DATA SI ORA CAZARII
                        <input type="checkbox" id="datoracaz_trigger" name="datoracaz_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="datoracaz_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp datetime_picker_trigger" type="text" placeholder="data si ora fixa" name="datoracaz_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp datetime_picker_trigger" type="text" placeholder="de la" name="datoracaz_inp_from">
                        <input style="width: 30%" class="after-check inp datetime_picker_trigger" type="text" placeholder="pana la" name="datoracaz_inp_to">
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- caracterisici -->
                    <label class="container">CARACTERISTICI CAINE
                        <input type="checkbox" id="caracter_trigger" name="caracter_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="caracter_to_show" class="hidden text-center">
                        <textarea style="width: 100%" class="after-check inp" type="text" placeholder="caracteristici" name="caracter_inp"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- nr fisa adoptie -->
                    <label class="container">NR. FISA ADOPTIE
                        <input type="checkbox" id="nrfisa_trigger" name="nrfisa_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width:100%" id="nrfisa_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check inp" type="text" placeholder="numarul fisei" name="nrfisa_inp">        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data deparazitarii -->
                    <label class="container">DATA DEPARAZITARII
                        <input type="checkbox" id="datdeparazit_trigger" name="datdeparazit_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="datdeparazit_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="datdeparazit_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="datdeparazit_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="datdeparazit_inp_to">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data vaccinarii -->
                    <label class="container">DATA VACCINARII
                        <input type="checkbox" id="datvacc_trigger" name="datvacc_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="datvacc_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="datvacc_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="datvacc_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="datvacc_inp_to">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data sterilizarii -->
                    <label class="container">DATA STERILIZARII
                        <input type="checkbox" id="datsteril_trigger" name="datsteril_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="datsteril_to_show" class="hidden text-center">
                        <label class="container">Sterilizat
                            <input type="checkbox" id="datsterilSteril_trigger" name="datsterilSteril_check">
                            <span class="checkmark"></span>
                        </label>

                        <label class="container">Nesterilizat
                            <input type="checkbox" id="" name="datsterilNesteril_check">
                            <span class="checkmark"></span>
                        </label>

                        <div id="setr_to_show" class="hidden">
                            <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="datsteril_inp">        
                            <span style="width: 10%">sau</span>
                            <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="datsteril_inp_from">
                            <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="datsteril_inp_to">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- decedat -->
                    <label class="container">DECEDAT
                        <input type="checkbox" id="decedat_trigger" name="decedat_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="decedat_to_show" style="width: 100%" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="decedat_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="decedat_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="decedat_inp_to">
                    </div>
                </div>
            </div>

    <!-- FISA MEDICALA --><hr><p>FISA MEDICALA</p>


            <div class="row">
                <div class="col-md-4">
    <!-- 1 data  -->
                    <label class="container">DATA
                        <input type="checkbox" id="med_data_trigger" name="med_data_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="med_data_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="med_data_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="med_data_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="med_data_inp_to">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- 2 semne clinice  -->
                    <label class="container">SEMNE CLINICE
                        <input type="checkbox" id="med_semne_trigger" name="med_semne_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="med_semne_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check inp" type="text" placeholder="semnele clinice" name="med_semne_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- 3 diagnostic  -->
                    <label class="container">DIAGNOSTIC
                        <input type="checkbox" id="med_diagnostic_trigger" name="med_diagnostic_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="med_diagnostic_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check inp" type="text" placeholder="diagnostic" name="med_diagnostic_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- 4 tratament -->
                    <label class="container">TRATAMENT
                        <input type="checkbox" id="tratament_trigger" name="tratament_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="tratament_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="tratament" name="tratament_inp">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
    <!-- 5 vaccin  -->
                    <label class="container">VACCIN
                        <input type="checkbox" id="med_vaccin_trigger" name="med_vaccin_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="med_vaccin_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check inp" type="text" placeholder="vaccin" name="med_vaccin_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- 5 observatii  -->
                    <label class="container">OBSERVATII
                        <input type="checkbox" id="med_obs_trigger" name="med_obs_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="med_obs_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check inp" type="text" placeholder="observatii clinice" name="med_obs_inp">
                    </div>
                </div>
            </div>

            <hr>
            <p>FISA CATEL:</p>

            <div class="row">
                <div class="col-md-4">
    <!-- nume caine-->
                    <label class="container">NUME CAINE
                        <input type="checkbox" id="nume_trigger" name="nume_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="nume_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="numele cainelui" name="nume_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- observatii caine -->
                    <label class="container">OBSERVATII CAINE
                        <input type="checkbox" id="obs_caine_trigger" name="obs_caine_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="obs_caine_to_show" class="hidden text-center">
                        <textarea style="width: 100%" class="after-check inp" type="text" placeholder="observatii" name="observatii_caine_inp"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- nume proprietar-->
                    <label class="container">NUME PROPRIETAR
                        <input type="checkbox" id="numeProprietar_trigger" name="numeProprietar_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="numeProprietar_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="numele proprietarului" name="nume_proprietar_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- nr matricol -->
                    <label class="container">NR MATRICOL
                        <input type="checkbox" id="nr_matricol_trigger" name="nr_matricol_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="nr_matricol_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="nr. matricol" name="nr_matricol_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- tronson -->
                    <label class="container">TRONSON
                        <input type="checkbox" id="tronson_trigger" name="tronson_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="tronson_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="tronson" name="tronson_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- cusca -->
                    <label class="container">CUSCA
                        <input type="checkbox" id="cusca_trigger" name="cusca_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="cusca_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="cusca" name="cusca_inp">
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-md-4">
    <!-- an nastere -->
                    <label class="container">AN NASTERE
                        <input type="checkbox" id="anNastere_trigger" name="anNastere_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="anNastere_to_show" class="hidden text-center">
                        <input style="width: 100%" class="after-check" type="text" placeholder="an nastere" name="anNastere_inp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- sex caine -->
                    <label class="container">SEX CAINE
                        <input type="checkbox" id="sex_caine_trigger" name="sex_caine_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="sex_caine_to_show" class="hidden text-center">
                        <label class="container">Femela
                            <input type="checkbox" name="sexCaine_inp" value="Femela">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">Mascul
                            <input type="checkbox" name="sexCaine_inp" value="Mascul">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data ultimei deparazitari -->
                    <label class="container">DATA ULTIMEI DEPARAZITARI
                        <input type="checkbox" id="datultdeparazit_trigger" name="datultdeparazit_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="datultdeparazit_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="datultdeparazit_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="datultdeparazit_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="datultdeparazit_inp_to">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
    <!-- data ultimei vaccinari -->
                    <label class="container">DATA ULTIMEI VACCINARI
                        <input type="checkbox" id="datultvacc_trigger" name="datultvacc_check">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-md-8">
                    <div style="width: 100%" id="datultvacc_to_show" class="hidden text-center">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="data fixa" name="datultvacc_inp">        
                        <span style="width: 10%">sau</span>
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="de la" name="datultvacc_inp_from">
                        <input style="width: 30%" class="after-check inp date_picker_trigger" type="text" placeholder="pana la" name="datultvacc_inp_to">
                    </div>
                </div>
            </div>

            


        <div class="modal-footer">
            <input type="submit" name="btn_search" class="btn btn-success" value="Cautare">
            <input type="submit" name="btn_cancelAction" class="btn btn-danger" data-dismiss="modal" value="Inchide">
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Tabel -->
<div class="containers home-tabel">
    <form method="POST">
        <div style="overflow-x:auto; overflow-y:auto">
            <table>
            <thead>
                <tr>
                <th>Nr. Crt</th>
                <th>Nr. microcip</th>
                <th>Nr. unic de identificare</th>
                <th colspan='2'>Data si locul capturarii</th>
                <th>Data si ora cazarii in adapost</th>
                <th>Caracteristici individuale ale animalului</th>
                <th>Nr. de caini <br> fara stapan <br> prinsi</th>
                <th>Nr. de caini <br> fara stapan <br> revendicati</th>
                <th>Nr. de caini <br> fara stapan <br> adoptati</th>
                <th>Nr. de caini <br> mentinuti <br> in adapost</th>
                <th>Nr. de caini <br> adoptati <br> la distanta</th>
                <th>Nr. de caini <br> eutanasiati</th>
                <th style="padding: none;"><div style="padding: none; width: 80px; overflow-x: auto; overflow-y:hidden;">Motivul eutanasierii</div></th>
                <th style="padding: none;"><div style="padding: none; width: 80px; overflow-x: auto; overflow-y:hidden;">Substanta utilizata pentru eutanasiere</div></th>
                <th style="padding: none;"><div style="padding: none; width: 80px; overflow-x: auto; overflow-y:hidden;">Numele persoanei care realizeaza eutanasierea</div></th>
                <th>Nr. fisei de adoptie</th>
                <th>Data deparazitarii</th>
                <th>Data vaccinarii antirabice</th>
                <th>Data sterilizarii</th>
                <th style="padding: none;"><div style="padding: none; width: 100px; overflow-x: auto; overflow-y:hidden;">Persoanele care au instrumentat manoperele respective</div></th>
                <th>Decedati</th>
                <th>Data adaugarii pe site</th>
                </tr>
            </thead>
            <tbody>
            
                <?php while ($row = mysqli_fetch_assoc($result)):  ?>
                    <tr class="table-tr">
                        <style>
                            a{color:#000;}
                            a:hover{color:#fff;}
                        </style>
                        <td class='text-center'><?php echo $row['c_id']; ?></td>
                        <td class="p-1"><?php echo "<a href='details.php?microcip=".$row['c_microcip']."'>".$row['c_microcip']."</a>";?></td>
                        <td><?php echo "<a href='details.php?microcip=".$row['c_microcip']."'>".$row['c_identificare']."</a>";?></td>
                        <td colspan='1'><?php echo $row['c_datacapt'];?></td>
                        <td colspan='1'><?php echo $row['c_loccapt'];?></td>
                        <td><?php echo $row['c_datcazare'];?></td>
                        <td><?php echo $row['c_caracteristici'];?></td>
                        <td class='text-center'><?php echo $row['c_fsprinsi'];?></td>
                        <td class='text-center'><?php echo $row['c_fsrevendicati'];?></td>
                        <td class='text-center'><?php echo $row['c_fsadoptati'];?></td>
                        <td class='text-center'><?php echo $row['c_cmentinuti'];?></td>
                        <td class='text-center'><?php echo $row['c_cadoptati'];?></td>
                        <td class='text-center'><?php echo $row['c_eutanasiati'];?></td>
                        <td><?php echo $row['c_motiveutan'];?></td>
                        <td><?php echo $row['c_substeutan'];?></td>
                        <td><?php echo $row['c_numperseutan'];?></td>
                        <td class='text-center'><?php echo $row['c_nrfisaadoptie'];?></td>
                        <td class='text-center'><?php echo $row['c_datdeparazit'];?></td>
                        <td class='text-center'><?php echo $row['c_datvacc'];?></td>
                        <td class='text-center'><?php echo $row['c_steril'];?></td>
                        <td width="30px"><div style="padding: none; width: 100px; overflow-x: auto; overflow-y:hidden;"><?php echo $row['c_persmanopera'];?></div></td>
                        <td style="padding: none;"><?php echo $row['c_decedati'];?></td>
                        <td><?php echo $row['c_dataaddsite'];?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
        </div>
    </form>
</div>

<!-- Num. total -->
<div class="totals text-center m-2">
    <hr>
        <h2 style="font-family: 'Roboto'">Efectiv total: <?php echo $howMany; ?></h2>
    <hr>
</div>


<?php echo $paginationVar; ?>


<?php include '../comp/footer.php'; ?>