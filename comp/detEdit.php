<?php 
    session_id("login-session");
    session_start();
    include "dbh.php";
    
    $microcip = $_SESSION['microcip'];
    $currentUser = $_SESSION['utilizator'];

    // VARIABLES FOR USER HISTORY `initial values`:
    $dete_nrmatricol_initial ='';
    $dete_nume_initial ='';
    $dete_tronson_initial ='';
    $dete_cusca_initial='';
    $dete_semnpartic_initial ='';
    $dete_observatii_initial='';
    $dete_observatiiErase_initial ='';
    $dete_poza = false;

    $dete_dataadopt_initial='';
    $dete_numpersadopt_initial ='';
    $dete_datadecedat_initial='';

    $dete_datultdep_initial='';
    $dete_datultvacc_initial='';

    $ce_proprietar_initial ='';

    $sqlInitialValue = "SELECT * FROM details WHERE det_serie='$microcip'";
    $resultInitialValue = mysqli_query($conn, $sqlInitialValue);
    while($initialValue = mysqli_fetch_assoc($resultInitialValue)){
        $dete_nrmatricol_initial = $initialValue['det_nrmatricol'];
        $dete_nume_initial = $initialValue['det_nume'];
        $dete_tronson_initial = $initialValue['det_tronson'];
        $dete_cusca_initial = $initialValue['det_cusca'];
        $dete_varsta_initail = $initialValue['det_varsta'];
        $dete_sex_initial = $initialValue['det_sex'];
        $dete_semnpartic_initial = $initialValue['det_semnpartic'];
        $dete_observatii_initial = $initialValue['det_observatii'];
        $dete_observatiiErase_initial = $initialValue['det_observatii'];

        $dete_dataadopt_initial = $initialValue['det_dataadopt'];
        $dete_numpersadopt_initial = $initialValue['det_numpersadopt'];
        $dete_datadecedat_initial = $initialValue['det_datadecedat'];

        $dete_datultdep_initial = $initialValue['det_datultdep'];
        $dete_datultvacc_initial = $initialValue['det_datultvacc'];

    }
    $sqlInitialValue2 = "SELECT * FROM catei_tabel WHERE c_microcip='$microcip'";
    $resultInitialValue2 = mysqli_query($conn, $sqlInitialValue2);
    while($initialValue2 = mysqli_fetch_assoc($resultInitialValue2)){
        $ce_proprietar_initial = $initialValue2['c_proprietar'];
    }

    $sqlInitialValue3 = "SELECT * FROM catei_tabel WHERE c_microcip='$microcip'";
    $resultInitialValue3 = mysqli_query($conn, $sqlInitialValue3);
    while($initialValue3 = mysqli_fetch_assoc($resultInitialValue3)){
        $c_nrfisaadoptie_initial = $initialValue3['c_nrfisaadoptie'];
    }




    $dete_nrmatricol     = mysqli_real_escape_string($conn, $_POST['det_nrmatricol']);
    $dete_nume	  		 = mysqli_real_escape_string($conn, $_POST['deted_nume']);	
    $dete_tronson	  	 = mysqli_real_escape_string($conn, $_POST['det_tronson']);   
    $dete_cusca	         = mysqli_real_escape_string($conn, $_POST['det_cusca']);  
    
    $c_nrfisaadoptie     = mysqli_real_escape_string($conn, $_POST['c_nrfisaadoptie']);

    //$dete_varsta	     = mysqli_real_escape_string($conn, $_POST['det_varsta']);   

    $dete_sex	         = mysqli_real_escape_string($conn, $_POST['det_sex']);  

    //$dete_culoare	  	 = mysqli_real_escape_string($conn, $_POST['det_culoare']);    
    $dete_semnpartic     = mysqli_real_escape_string($conn, $_POST['det_semnpartic']);    
    //$dete_sterilizat     = mysqli_real_escape_string($conn, $_POST['det_sterilizat']);
    $dete_observatii   	 = mysqli_real_escape_string($conn, $_POST['det_observatii']);
    $dete_observatiiErase= mysqli_real_escape_string($conn, $_POST['det_observatii_erase']);  
    
    $dete_dataadopt      = mysqli_real_escape_string($conn, $_POST['det_dataadopt']);
    $dete_numpersadopt   = mysqli_real_escape_string($conn, $_POST['det_numpersadopt']);
    $dete_datadecedat    = mysqli_real_escape_string($conn, $_POST['det_datadecedat']);

    $dete_datultdep      = mysqli_real_escape_string($conn, $_POST['det_datultdep']);
    $dete_datultvacc     = mysqli_real_escape_string($conn, $_POST['det_datultvacc']);

    $ce_proprietar       = mysqli_real_escape_string($conn, $_POST['ce_proprietar']);

    /* imagini */
    $hasImg = 0;
    $file = $_FILES['img'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');


    if(isset($_POST['salvare'])){        
        $sqlCheck = "SELECT * FROM details WHERE det_serie='$microcip'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        $rowCheck = mysqli_fetch_array($resultCheck);
        
        if(is_array($rowCheck)){
            if(!empty($dete_nrmatricol)){
                $sql = "UPDATE details SET det_nrmatricol='$dete_nrmatricol' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_nume)){
                $sql = "UPDATE details SET det_nume='$dete_nume' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_tronson)){
                $sql = "UPDATE details SET det_tronson='$dete_tronson' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_cusca)){
                $sql = "UPDATE details SET det_cusca='$dete_cusca' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($c_nrfisaadoptie)){
                $sql = "UPDATE catei_tabel SET c_nrfisaadoptie='$c_nrfisaadoptie' WHERE c_microcip='$microcip'";
                mysqli_query($conn, $sql);
                $sql2 = "UPDATE tabel_adapost SET tab_nrfisa='$c_nrfisaadoptie' WHERE tab_nrident='$microcip'";
                mysqli_query($conn, $sql2);
            } else {}
            if(!empty($dete_varsta)){
                $sql = "UPDATE details SET det_varsta='$dete_varsta' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_sex)){
                $sql = "UPDATE details SET det_sex='$dete_sex' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_culoare)){
                $sql = "UPDATE details SET det_culoare='$dete_culoare' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_semnpartic)){
                $sql = "UPDATE details SET det_semnpartic='$dete_semnpartic' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(isset($dete_sterilizat)){
                $sql = "UPDATE details SET det_sterilizat='$dete_sterilizat' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_dataadopt) && !empty($dete_numpersadopt)){
                $sql = "UPDATE details SET det_dataadopt='$dete_dataadopt', det_numpersadopt='$dete_numpersadopt' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_datadecedat)){
                $sql = "UPDATE details SET det_datadecedat='$dete_datadecedat' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($ce_proprietar)){
                $sql = "UPDATE catei_tabel SET c_proprietar='$ce_proprietar' WHERE c_microcip='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_observatii)){
                $sql = "UPDATE details SET det_observatii= concat(det_observatii, ' $dete_observatii') WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_observatiiErase)){
                $sql = "UPDATE details SET det_observatii='$dete_observatiiErase' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_datultdep)){
                $sql = "UPDATE details SET det_datultdep='$dete_datultdep' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($dete_datultvacc)){
                $sql = "UPDATE details SET det_datultvacc='$dete_datultvacc' WHERE det_serie='$microcip'";
                mysqli_query($conn, $sql);
            } else {}
            if(!empty($file)){
                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($fileSize < 100000000){
                            $fileNameNew = "dog".$microcip.".".$fileActualExt;
                            $fileDestination = '../uploads/'.$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            $hasImg = 1;
                            $dete_poza = true;
                        } else {echo "Fisierul este prea mare ca sa poata fi incarcat pe server.";}
                    }
                    else {echo "A aparut o eroare. Code: img-01";}
    
                    $sql = "UPDATE details SET det_img='$hasImg' WHERE det_serie='$microcip'";
                    mysqli_query($conn, $sql); 
                }
            } else {} 
                

            // for user history
            $modificari = array();
            if($dete_nrmatricol != '') $modificari[] = "Nr. matricol (initial: ".$dete_nrmatricol_initial.", modificat: ".$dete_nrmatricol.""; 
            if($dete_nume != '') $modificari[] = "Nume caine: (initial: ".$dete_nume_initial.", modificat: ".$dete_nume."";
            if($dete_tronson != '') $modificari[] = "Tronson: (initial: ".$dete_tronson_initial.", modificat: ".$dete_tronson."";   
            if($dete_cusca != '') $modificari[] = "Cusca: (initial: ".$dete_cusca_initial.", modificat: ".$dete_cusca."";

            if($c_nrfisaadoptie != '') $modificari[] = "Nr. Fisa: (initial: ".$c_nrfisaadoptie_initial.", modificat: ".$c_nrfisaadoptie."";

            if($dete_varsta != '') $modificari[] = "An nastere: (initial: ".$dete_varsta_initial.", modificat: ".$dete_varsta."";
            if($dete_sex != '') $modificari[] = "Sex: (initial: ".$dete_sex_initial.", modificat: ".$dete_sex."";

            if($dete_semnpartic != '') $modificari[] = "Semne particulare: (initial: ".$dete_semnpartic_initial.", modificat: ".$dete_semnpartic."";
            if($dete_observatii != '') $modificari[] = "Observatii: (initial: ".$dete_observatii_initial.", modificat: ".$dete_observatii."";

            if($dete_dataadopt != '') $modificari[] = "Data ultimei deparazitari: (initial: ".$dete_datultdep_initial.", modificat: ".$dete_datultdep."";
            if($dete_datultvacc != '') $modificari[] = "Data ultimului vaccin: (initial: ".$dete_datultvacc_initial.", modificat: ".$dete_datultvacc."";

            if($dete_poza == true) $modificari[] = "Poza cainelui";

            if($dete_dataadopt != '') $modificari[] = "Data adoptarii: (initial: ".$dete_dataadopt_initial.", modificat: ".$dete_dataadopt."";
            if($dete_numpersadopt != '') $modificari[] = "Numele persoanei care adopta cainele: (initial: ".$dete_numpersadopt_initial.", modificat: ".$dete_numpersadopt."";
            if($dete_datadecedat != '') $modificari[] = "Data decedarii: (initial: ".$dete_datadecedat_initial.", modificat: ".$dete_datadecedat."";

            if($ce_proprietar != '') $modificari[] = "Numele proprietarului: (initial: ".$ce_proprietar_initial.", modificat: ".$ce_proprietar."";

            $modificariEditat = join(", ", $modificari);
            
            $currentAction = "A modificat fisa cainelui ".$microcip.": ".$modificariEditat.").";
            $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_modify) VALUES ('$currentUser', '$currentAction', 1)";
            mysqli_query($conn, $userHistorySql);
                


            header("Location: ../details.php?microcip=".$microcip."");
        }
        else{ 
         
            $sql = "INSERT INTO details (det_serie, det_nume, det_nrmatricol, det_tronson, det_cusca, det_varsta, det_culoare, det_semnpartic, det_sterilizat, det_observatii) VALUES ('$microcip', '$dete_nume', '$dete_nrmatricol', '$dete_tronson', '$dete_cusca', '$dete_varsta', '$dete_culoare', '$dete_semnpartic', '$dete_sterilizat', '$dete_observatii');";
            mysqli_query($conn, $sql);
            
            



            header("Location: ../details.php?microcip=".$microcip."");
        }



    }


        
        


        

    //    header("Location: ../details.php?microcip=".$microcip."");
    
    elseif(isset($_POST['stergere'])){
        $sql = "DELETE FROM details WHERE det_serie='$microcip'";
        mysqli_query($conn, $sql);
        $sql2 = "DELETE FROM catei_tabel WHERE c_microcip='$microcip'";
        mysqli_query($conn, $sql2);
        header("Location: ../home.php");
    }


    elseif(isset($_POST['btn_imp_adoptat'])){   
        $adoptat = $_POST['caine_adoptat'];
        if(!empty($adoptat)){
            // MODIFY `Tabel adapost - data iesirii`
            $sqlAdopt = "UPDATE tabel_adapost SET tab_datapredarii='$adoptat' WHERE tab_nrident='$microcip'"; 
            mysqli_query($conn, $sqlAdopt);

            // INSERT
            $sqlInsert = "INSERT INTO catei_tabel_arhiva (c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar) SELECT c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar FROM catei_tabel WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sqlInsert);
            // DELETE
            $sqlDelete = "DELETE FROM catei_tabel WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sqlDelete);
            // UPDATE             
            $sqlInsertArhive = "UPDATE catei_tabel_arhiva SET c_adopted=1, c_dead=0 WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sqlInsertArhive);


            // user history 
            $currentAction = "A mutat cainele ".$microcip." in arhiva (adoptat).";
            $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_arhive) VALUES ('$currentUser', '$currentAction', 1)";
            mysqli_query($conn, $userHistorySql);
                


        }

        header("Location: ../home.php");
    }


    elseif(isset($_POST['btn_imp_decedat'])){
        $decedat = mysqli_real_escape_string($conn, $_POST['caine_decedat']); 
        if(!empty($decedat)){            
            // MODIFY `Tabel adapost - data iesirii`
            $sqlDecedat = "UPDATE tabel_adapost SET tab_datapredarii='$decedat' WHERE tab_nrident='$microcip'";
            mysqli_query($conn, $sqlDecedat);
            
            // INSERT
            $sqlInsert = "INSERT INTO catei_tabel_arhiva (c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar, c_dataaddsite) SELECT c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar, c_dataaddsite FROM catei_tabel WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sqlInsert);
            // DELETE
            $sqlDelete = "DELETE FROM catei_tabel WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sqlDelete);
            // UPDATE             
            $sqlInsertArhive = "UPDATE catei_tabel_arhiva SET c_adopted=0, c_dead=1 WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sqlInsertArhive);

            
            // user history
            $currentAction = "A mutat cainele ".$microcip." in arhiva (decedat).";
            $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_arhive) VALUES ('$currentUser', '$currentAction', 1)";
            mysqli_query($conn, $userHistorySql);

        } 

        header("Location: ../home.php");
    }
    else {
        header("Location: ../details.php?microcip=".$microcip."");
    }

?>