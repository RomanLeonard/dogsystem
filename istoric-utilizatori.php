<?php 

    session_id("login-session");

    session_start();

	

    if (!isset($_SESSION['login-true']) || $_SESSION['login-true'] != true) {

        header("Location: ./index.php");

		die;

    }

    elseif($_SESSION['utilizator'] != 'admin'){

        $_SESSION['login-true']= false;

        session_destroy();

        header('Location: ../fundatia-speranta/index.php');

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





    // search system

    $dataVal='';

    $userVal='';

        // actions

    $u_add='';

    $u_modify='';

    $u_trat='';

    $u_arhive='';







    if(isset($_POST['btn_search'])){



        $data = mysqli_real_escape_string($conn, $_POST['data_inp']);

        $dataFrom = mysqli_real_escape_string($conn, $_POST['data_inp_dela']);

        $dataTo = mysqli_real_escape_string($conn, $_POST['data_inp_panala']);

        $user = mysqli_real_escape_string($conn, $_POST['user_name']);



        // date

        if(!empty($dataFrom) && !empty($dataTo) && empty($data)){

            $dataVal = "`user_date` BETWEEN '$dataFrom' AND '$dataTo'";

        }

        if(!empty($data) && empty($dataFrom) && empty($dataTo)){

            $dataVal = "`user_date` like '$data'";

        }

        // name

        if(!empty($user)){

            $userVal = "`user_name` like '$user'";

        }

        // actions

        if(isset($_POST['u_add'])){

            $u_add = "`user_add`=1";

        }

        if(isset($_POST['u_modify'])){

            $u_modify = "`user_modify`=1";

        }

        if(isset($_POST['u_trat'])){

            $u_trat = "`user_trat`=1";

        }

        if(isset($_POST['u_arhive'])){

            $u_arhive = "`user_arhive`=1";

        }

        

        



        // database

        $sql = "SELECT * FROM utilizatori_istoric";

        

        $conditions = array();

        if ($dataVal != '') $conditions[] = " $dataVal";

        if ($userVal != '') $conditions[] = " $userVal";

        if ($u_add != '') $conditions[] = " $u_add";

        if ($u_modify != '') $conditions[] = " $u_modify";

        if ($u_trat != '') $conditions[] = " $u_trat";

        if ($u_arhive != '') $conditions[] = " $u_arhive";



        

        $sql_cond = join(" AND ", $conditions);

        if($sql_cond != '') $sql .= " WHERE $sql_cond";





        $result = mysqli_query($conn, $sql);



    }

    else{

        $sql = "SELECT * FROM utilizatori_istoric";

        $result = mysqli_query($conn, $sql);

    }

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">



    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Thasadith" rel="stylesheet">

      

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link href="../fundatia-speranta/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">



    <link rel="stylesheet" href="./style/istoricUtilizatori.css">

    <title>Istoric utilizatori - SPERANTA</title>

</head>

<body>

<style>

    .contain{

        width: 98%;

        margin-top: 50px;

        margin-left: 0;

    }

    .contain table{

        width: 100%;

    }

    .contain table, th, td {

        border: 1px solid black;

        border-collapse: collapse;

    }

    th, td{

        padding: 5px;

    }



    .wrapper-search{

        width: 100%;

        height: 50vh;

        border-top: 1px solid #000;

        border-bottom: 1px solid #000;

    }

    .wrapper-search .search-title{

        margin: auto;

        padding: 10px;

    }



    .procese-efectuate{

        margin: 10px;

        display: grid;

        grid-template-columns: 1fr 1fr;

        padding-bottom: 10px;

    }

    .procese-btns{

        text-align: left;

    }

    .procese-btns input{

        padding: 15px;

        margin: auto;

        background: #fff;

        border: 1px solid #000;

        color: #000;

        font-weight: 800;

        border-radius: 20px;

    }

    .procese-btns input:hover{

        background: #000;

        color: #ffffff;

        border-color: #fff;

        transition-duration: 150ms;

    }



    .nume-utilizator{

        margin: 10px;

        display: grid;

        grid-template-columns: 1fr 1fr;

        padding-bottom: 10px;

    }

    .nume-utilizatori{

        text-align: left;

    }

    .nume-utilizatori input{

        padding: 10px;

        border: 1px solid #000;

    }   

    .nume-utilizatori input:nth-last-child():hover{

        background: #fff;

        color: #000;



    }

</style>



    <center>

    <header>

        <a href="./home.php">Inapoi la platforma</a>

        <button type="button" class="button-activate-search" data-toggle="modal" data-target="#exampleModal" id="buton-activate-search">Cautare</button>

    </header>



    <h1 style="margin: 20px;">Istoricul utilizatorilor</h1>

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

                <!-- data  -->

                <div class="row">

                    <div class="input-group col-md-12">

                        <div class="input-group-prepend">

                            <span class="input-group-text">Data</span>

                        </div>

                        <div class="input-append date form_datetime">

                            <input type="text" name="data_inp" class="form-control datetime_picker_trigger" id="basic-url" placeholder="data fixa" readonly style="background:#fff">

                            <span class="add-on"><i class="icon-remove"></i></span>

                            <span class="add-on"><i class="icon-calendar"></i></span>

                        </div>

                        <div class="input-group-prepend">

                            <span class="input-group-text">sau</span>

                        </div>

                        <div class="input-append date form_datetime">

                            <input type="text"  name="data_inp_dela" class="form-control date_picker_trigger" placeholder="interval de la data" readonly style="background:#fff">

                            <span class="add-on"><i class="icon-remove"></i></span>

                            <span class="add-on"><i class="icon-calendar"></i></span>

                        </div>

                        <div class="input-append date form_datetime">

                            <input type="text"  name="data_inp_panala" class="form-control date_picker_trigger" placeholder="pana la data" readonly style="background:#fff">

                            <span class="add-on"><i class="icon-remove"></i></span>

                            <span class="add-on"><i class="icon-calendar"></i></span>

                        </div>

                    </div>

                </div>

                <hr>

                <!-- nume  -->

                <div class="row">

                    <div class="input-group col-md-12">

                        <div class="input-group-prepend">

                            <span class="input-group-text" id="basic-addon3">Nume</span>

                        </div>

                        <input type="text" name="user_name" class="form-control" placeholder="numele utilizatorului">

                    </div>

                </div>

                <hr>s

                <!-- procesul  -->

                <div class="row">

                    <div class="col-md-12"><label for="proc">Procesul efectuat</label></div>

                        <div class="col-md-12" id="proc">

                        

                            <div class="col-auto my-1">

                                <div class="custom-control custom-checkbox mr-sm-2">

                                    <input type="checkbox" name="u_add" class="custom-control-input" id="add">

                                    <label class="custom-control-label btn btn-primary" for="add" style="width: 150px">Adaugari</label>

                                </div>

                            </div>



                            <div class="col-auto my-1">

                                <div class="custom-control custom-checkbox mr-sm-2">

                                    <input type="checkbox" name="u_modify" class="custom-control-input" id="modify">

                                    <label class="custom-control-label btn btn-primary" for="modify" style="width: 150px">Modificari</label>

                                </div>

                            </div>



                            <div class="col-auto my-1">

                                <div class="custom-control custom-checkbox mr-sm-2">

                                    <input type="checkbox" name="u_trat" class="custom-control-input" id="trat">

                                    <label class="custom-control-label btn btn-primary" for="trat" style="width: 150px">Tratament</label>

                                </div>

                            </div>



                            <div class="col-auto my-1">

                                <div class="custom-control custom-checkbox mr-sm-2">

                                    <input type="checkbox" name="u_arhive" class="custom-control-input" id="arhive">

                                    <label class="custom-control-label btn btn-primary" for="arhive" style="width: 150px">Arhiva</label>

                                </div>

                            </div>



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







    <!-- tabel -->

    <div class="contain">

        <table>

            <thead>

                <tr style="text-align:center; background: #d3d3d3">

                    <th>Data si ora</th>

                    <th>Utilizatorul</th>

                    <th>Procesele efectuate</th>

                </tr>

            </thead>

            <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)):  ?>

                <tr style="border-bottom: 1px solid #000;">

                    <th><?php echo $row['user_date'];?></th>

                    <th style="text-align: center"><span><?php echo $row['user_name'];?></span></th>

                    <th><?php echo $row['user_actions'];?></th>

                </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>



    </center>

   

<!-- footer -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <!-- datetimepicker functions -->

    <script type="text/javascript" src="../fundatia-speranta/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

    <script type="text/javascript" src="../fundatia-speranta/js/locales/bootstrap-datetimepicker.ro.js" charset="UTF-8"></script>

   

   <script type="text/javascript">

        $(".form_datetime").datetimepicker({

            format: "yyyy-mm-dd hh:ii",

            language: 'ro',

            autoclose: false,

            todayBtn: true,

            minuteStep: 0

        });

    </script>

  



    <!-- activate input fields -->

    <script>

        window.onload=function(){

            document.getElementById("microcip_trigger").addEventListener('change', check);

            

            function check(){

                if(document.getElementById('microcip_trigger').checked == true){

                    document.getElementById("microcip_to_show").style.display='block';

                }else{document.getElementById("microcip_to_show").style.display='none';}

            }

        }

    </script>





</body>

</html>

</body>

</html>