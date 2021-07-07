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
        $tratamentVal ="";
        $detalii_numeVal ="";
	
    if(isset($_POST['btn_search'])){
       

        // variables 
            $microcip = mysqli_real_escape_string($conn, $_POST['microcip_inp_val']);

            $dataCapt = mysqli_real_escape_string($conn, $_POST['datacapt_inp']);
            $dataCaptFrom = mysqli_real_escape_string($conn, $_POST['datacapt_inp_from']);
            $dataCaptTo = mysqli_real_escape_string($conn, $_POST['datacapt_inp_to']);

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
            
            $tratament = mysqli_real_escape_string($conn, $_POST['tratament_inp']);

            
        // microcip
        if(isset($_POST['microcip_check'])){
            $tabelActivate = true;
            if(!empty($microcip)){
                $microcipVal = "`tab_nrident` like '$microcip'";
            }
        }
        // data capt.
        if(isset($_POST['datacapt_check'])){
            $tabelActivate = true;
            if(!empty($dataCapt) && empty($dataCaptFrom) && empty($dataCaptTo)){
                $dataCaptVal = "`tab_data` like '$dataCapt'";
            }
            if(empty($dataCapt) && !empty($dataCaptFrom) && !empty($dataCaptTo)){
                $dataCaptVal = "`tab_data` BETWEEN '$dataCaptFrom' AND '$dataCaptTo'";
            }
        }
        // data cazare adapost
        if(isset($_POST['datoracaz_check'])){
            $tabelActivate = true;
            if(!empty($datsioraCaz) && empty($datsioraCazFrom) && empty($datsioraCazTo)){
                $datsioraCazVal = "`tab_datacazarii` like '$datsioraCaz'";
            }
            if(empty($datsioraCaz) && !empty($datsioraCazFrom) && !empty($datsioraCazTo)){
                $datsioraCazVal = "`tab_datacazarii` BETWEEN '$datsioraCazFrom' AND '$datsioraCazTo'";
            }
        }
        // caracteristici
        if(isset($_POST['caracter_check'])){
            $tabelActivate = true;
            if(!empty($caracteristici)){
                $caracterStr = $caracteristici;
                $caracterStr = explode(' ', $caracterStr);
                $caracteristiciVal = "`tab_caracteristici` like ";
                $caracterArr = array();
                foreach ($caracterStr as $index => $val) {$caracterArr[] = " '%$caracterStr[$index]%'";}
                $caracter_cond = join(" AND `tab_caracteristici` like ", $caracterArr);
                if ($caracter_cond != '') $caracteristiciVal .= " $caracter_cond";
            }
        }
        // nr. fisa
        if(isset($_POST['nrfisa_check'])){
            $tabelActivate = true;
            if(!empty($nrfisa)){
                $nrfisaVal = "`tab_nrfisa` like '$nrfisa'";
            }
        }
        // data deparazitarii
        if(isset($_POST['datdeparazit_check'])){
            $tabelActivate = true;
            if(!empty($dataDeparaz) && empty($dataDeparazFrom) && empty($dataDeparazTo)){
                $dataDeparazVal = "`tab_datadeparat` like '$dataDeparaz'";
            }
            if(empty($dataDeparaz) && !empty($dataDeparazFrom) && !empty($dataDeparazTo)){
                $dataDeparazVal = "`tab_datadeparat` BETWEEN '$dataDeparazFrom' AND '$dataDeparazTo'";
            }
        }
        // data vacc
        if(isset($_POST['datvacc_check'])){
            $tabelActivate = true;
            if(!empty($dataVacc) && empty($dataVaccFrom) && empty($dataVaccTo)){
                $dataVaccVal = "`tab_datavacc` like '$dataVacc'";
            }
            if(empty($dataVacc) && !empty($dataVaccFrom) && !empty($dataDeparazTo)){
                $dataVaccVal = "`tab_datavacc` BETWEEN '$dataVaccFrom' AND '$dataVaccTo'";
            }
        }
        // data sterilizarii
        if(isset($_POST['datsteril_check'])){
            $tabelActivate = true;

            if(isset($_POST['datsterilNesteril_check'])){
                $dataSterilVal = "`tab_datasteril` = 0";
            }
            if(isset($_POST['datsterilSteril_check'])){            
                if(!empty($dataSteril) && empty($dataSterilFrom) && empty($dataSterilTo)){
                    $dataSterilVal = "`tab_datasteril` like '$dataSteril'";
                }
                if(empty($dataSteril) && !empty($dataSterilFrom) && !empty($dataSterilTo)){
                    $dataSterilVal = "`tab_datasteril` BETWEEN '$dataSterilFrom' AND '$dataSterilTo'";
                }
            }

        }

        // nume medic
        if(isset($_POST['tratament_check'])){
            if(!empty($tratament)){
                $tratamentStr = $tratament;
                $tratamentStr = explode(' ', $tratamentStr);
                $tratamentVal = "`tab_medic` like ";
                $tratamentArr = array();
                foreach ($tratamentStr as $index => $val) {$tratamentArr[] = " '%$tratamentStr[$index]%'";}
                $tratament_cond = join(" AND `tab_medic` like ", $tratamentArr);
                if ($tratament_cond != '') $tratamentVal .= " $tratament_cond";
            }
        
        }
        // predare
        if(isset($_POST['decedati_check'])){
            $tabelActivate = true;
            if(!empty($decedat) && empty($decedatFrom) && empty($decedatTo)){
                $decedatVal = "`tab_datapredarii` like '$decedat'";
            }
            if(empty($decedat) && !empty($decedatFrom) && !empty($decedatTo)){
                $decedatVal = "`tab_datapredarii` BETWEEN '$decedatFrom' AND '$decedatTo'";
            }
        }


        $sql = "SELECT * FROM tabel_adapost";

        

        // conditions for `tabel_adapost`
        $conditions = array();

        if ($microcipVal != '') $conditions[] = " $microcipVal";
        if ($identVal != '') $conditions[] = " $identVal";
        if ($dataCaptVal != '') $conditions[] = " $dataCaptVal";
        if ($datsioraCazVal != '') $conditions[] = " $datsioraCazVal";
        if ($caracteristiciVal != '') $conditions[] = " $caracteristiciVal";
        if ($nrfisaVal != '') $conditions[] = " $nrfisaVal";
        if ($dataDeparazVal != '') $conditions[] = " $dataDeparazVal"; 
        if ($dataVaccVal != '') $conditions[] = " $dataVaccVal"; 
        if ($dataSterilVal != '') $conditions[] = " $dataSterilVal"; 
        if ($decedatVal != '') $conditions[] = " $decedatVal";
        if ($tratamentVal != '') $conditions[] = " $tratamentVal"; 
        $sql_cond = join(" AND ", $conditions);


        if ($sql_cond != '') $sql .= " WHERE $sql_cond";
        

       /* if(($tabelActivate == true && $detActivate == true) || ($detActivate == true && $tabelActivate == false) || ($tabelActivate == true && $detActivate == true && $detaliiActivate == true)){
            if ($sql_condSpecDet != '') $sql .= " WHERE $sql_condSpecDet $closebracket $sql_detCond $detCloseBracket $sql_cond"; 
        }

        if(($tabelActivate == false && $detActivate == false)  && $detaliiActivate == true){
            if ($sql_detCond != '') $sql .= " WHERE $sql_detCond $detCloseBracket"; 
        } */
        
        /*%%%%%%%%%%%%%%%   DEBUGGER   %%%%%%%%%%%%%%%*/ echo $sql;


        $result = mysqli_query($conn, $sql);
        $howMany = mysqli_num_rows($result);
        
    }
    else{
        $sql = "SELECT COUNT(*) FROM tabel_adapost;";
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
        $sql = "SELECT * FROM tabel_adapost LIMIT $offset, $rowsperpage;";
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
            <nav aria-label='Page navigation example'>
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
    } 


    $efectivprinsiSql = "SELECT * FROM `catei_tabel` WHERE `c_fsprinsi` != 0";
    $efectivprinsiResult = mysqli_query($conn, $efectivprinsiSql);
    $efectivprinsi = mysqli_num_rows($efectivprinsiResult);

    $efectivrevendicSql = "SELECT * FROM `catei_tabel` WHERE `c_fsrevendicati` != 0";
    $efectivrevendicResult = mysqli_query($conn, $efectivrevendicSql);
    $efectivrevendic = mysqli_num_rows($efectivrevendicResult);

    // caini adoptati sau caini fara stapan adoptati?
    $efectivadoptSql = "SELECT * FROM `catei_tabel` WHERE `c_cadoptati` != 0";
    $efectivadoptResult = mysqli_query($conn, $efectivadoptSql);
    $efectivadopt = mysqli_num_rows($efectivadoptResult);

    $efectivmentinSql = "SELECT * FROM `catei_tabel` WHERE `c_cmentinuti` != 0";
    $efectivmentinResult = mysqli_query($conn, $efectivmentinSql);
    $efectivmentin = mysqli_num_rows($efectivmentinResult);

    $efectivdecedatiSql = "SELECT * FROM `catei_tabel` WHERE `c_decedati` != 0";
    $efectivdecedatiResult = mysqli_query($conn, $efectivdecedatiSql);
    $efectivdecedati = mysqli_num_rows($efectivdecedatiResult);

    $efectivSql = "SELECT * FROM `catei_tabel`";
    $efetivResult = mysqli_query($conn, $efectivSql);
    $efectivTotal = mysqli_num_rows($efetivResult);




    $efectivSql = "SELECT * FROM `catei_tabel`";
    $efetivResult = mysqli_query($conn, $efectivSql);
    $efectivTotal = mysqli_num_rows($efetivResult);
	include 'comp/header.php';
?>

<head>
    <link rel="stylesheet" href="style/style_tabel.css">
    <link rel="stylesheet" href="style/style_home.css">
</head>

<div class="top-wrapper row">
    <div class="left col-xs-12 col-md-3">
        <h1>Tabel adapost</h1>
    </div>  
    <div class="right col-xs-12 col-md-3 text-center">
        <button id="calendar-btn" class="button-activate-search"><i class="far fa-calendar-alt"></i> Calendar</button>  
    </div>    
    <div class="right col-xs-12 col-md-6">
        <!-- Button trigger modal -->
        <button  type="button" class="button-activate-search" data-toggle="modal" data-target="#exampleModal" id="buton-activate-search"><i class="fas fa-search"></i> CAUTARE</button>
    </div> 
</div>



<div id="calendar-body" class="calendar"style="width: 100%;position: absolute; height: 100vh;background: rgba(0,0,0,1);top: 0;bottom: 0; display:none";>
<button style="position: absolute;
        top: 2px;
        left: 50%;
        transform: translate(-50%, 0);
        padding: 5px 10px 5px 10px;
        background-color: #198b3f;        
        border: solid #198b3f 1px;
        border-radius: 10px;
        color: #fff;
        box-shadow: 0px 2px 5px rgba(0,0,0,0.25);
        display:none;" id="close-calendar"><i class="far fa-times-circle"></i> Inchidere</button>
    <iframe src="https://calendar.google.com/calendar/b/1/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=adapost.speranta%40gmail.com&amp;color=%231B887A&amp;ctz=Europe%2FBucharest" style="border-width:0" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
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
                    <label class="container">NR. IDENTIFICARE
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
    <!-- data capturarii -->
                    <label class="container">DATA
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
    <!-- data si ora cazarii -->
                    <label class="container">DATA CAZARII
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
                    <label class="container">CARACTERISTICI INDIVIDUALE CAINE
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
                    <label class="container">DATA PREDARII
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
            <div class="row">
                <div class="col-md-4">
    <!-- 4 tratament -->
                    <label class="container">NUME MEDIC
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


        <div class="modal-footer">
            <input type="submit" name="btn_search" class="btn btn-success" value="Cautare">
            <input type="submit" name="btn_cancelAction" class="btn btn-danger" data-dismiss="modal" value="Inchide">
        </div>
        </form>
      </div>
    </div>
  </div>
</div> 


<div class="containers">
    <form method="POST">
        <div style="overflow-x:auto; overflow-y:auto">
            <table>
            <thead>
                <tr>
                <th>Nr. Crt</th>
                <th>Data</th>
                <th>Data cazarii</th>
                <th>Caracteristici individuale</th>
                <th>Nr. caini prinsi</th>
                <th>Nr. caini revendicati</th>
                <th>Nr. caini adoptati</th>
                <th>Nr. caini mentinuti</th>
                <th>Nr. caini decedati</th>
                <th>Motiv deces/<br>Subst. folosita</th>
                <th>Nr. identificare</th>
                <th>Nr. fisa</th>
                <th>Data vaccinarii antirabice</th>
                <th>Data deparazitarii</th>
                <th>Data sterilizarii</th>
                <th>Medic/asistent/tehnician</th>
                <th>Data predarii</th>
                <th>Efectiv total</th>
                </tr>
            </thead>
            <tbody>
            
                <?php while ($row = mysqli_fetch_assoc($result)):  ?>
                    <tr>
                        <style>
                            a{color:#000;}
                            a:hover{color:#fff;}
                        </style>
                        <td class='text-center'><?php echo $row['id'];?></td>
                        <td><?php echo $row['tab_data'];?></td>
                        <td><?php echo $row['tab_datacazarii'];?></td>
                        <td><?php echo $row['tab_caracteristici'];?></td>
                        <td><?php echo $row['tab_nrcprinsi'];?></td>
                        <td><?php echo $row['tab_nrcrevendic'];?></td>
                        <td><?php echo $row['tab_nrcadopt'];?></td>
                        <td><?php echo $row['tab_nrcmentin'];?></td>
                        <td><?php echo $row['tab_nrcdecedati'];?></td>
                        <td><?php echo $row['tab_motiv'];?></td>
                        <td><?php echo "<a href='details.php?microcip=".$row['tab_nrident']."'>".$row['tab_nrident']."</a>";?></td>
                        <td><?php echo $row['tab_nrfisa'];?></td>
                        <td><?php echo $row['tab_datavacc'];?></td>
                        <td><?php echo $row['tab_datadeparat'];?></td>
                        <td><?php echo $row['tab_datasteriliz'];?></td>
                        <td><?php echo $row['tab_medic'];?></td>
                        <td><?php echo $row['tab_datapredarii'];?></td>
                        <td style="border-bottom: none; border-top: none"> </td>
                <?php endwhile; ?>
                    </tr>
                    <tr>
                        <td style="border-right: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="padding:40px;text-align:center; font-weight: 800;" class="text-center"><?php echo $efectivprinsi;?></td>
                        <td style="padding:40px;text-align:center; font-weight: 800;" class="text-center"><?php echo $efectivrevendic;?></td>
                        <td style="padding:40px;text-align:center; font-weight: 800;" class="text-center"><?php echo $efectivadopt;?></td>
                        <td style="padding:40px;text-align:center; font-weight: 800;" class="text-center"><?php echo $efectivmentin;?></td>
                        <td style="padding:40px;text-align:center; font-weight: 800;" class="text-center"><?php echo $efectivdecedati;?></td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td style="border-right: none; border-left: none;"> </td>
                        <td class="text-center" style="border-top: none; font-weight: 800;"><?php echo $efectivTotal;?></td>
                    </tr>
            </tbody>
            </table>
        </div>
    </form>
</div>


    <br>

    <?php echo $paginationVar; ?>

<?php include 'comp/footer.php'; ?>