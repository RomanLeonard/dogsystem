
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- datetimepicker functions -->
<script type="text/javascript" src="../fundatia-speranta/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../fundatia-speranta/js/locales/bootstrap-datetimepicker.ro.js" charset="UTF-8"></script>
<script type="text/javascript">
  $('.date_picker_trigger').datetimepicker({
      format: 'yyyy-mm-dd',
      language: 'ro',
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0
  }); 
  $('.datetime_picker_trigger').datetimepicker({
      format: 'yyyy-mm-dd hh:ii:ss',
      language: 'ro',
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0  
  });
  $('#med_date_picker_trigger').datetimepicker({
      format: 'yyyy-mm-dd',
      language: 'ro',
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0
  }); 
  

</script>

<!-- tabel functions -->
<script>
  $(document).ready(function(){
    $(".table-tr").click(function() {
      var selected = $(this).hasClass("selected");
      $(".table-tr").removeClass("selected");
      if(!selected){
        $(this).addClass("selected");
      }
    })
  })
</script>

<!-- navigation functions -->
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


<!-- activate input fields -->
<script>
  window.onload=function(){
    document.getElementById("microcip_trigger").addEventListener('change', check);
    document.getElementById("datcapt_trigger").addEventListener('change', check);
    document.getElementById("nrident_trigger").addEventListener('change', check);
    document.getElementById("loccapt_trigger").addEventListener('change', check);
    document.getElementById("datoracaz_trigger").addEventListener('change', check);
    document.getElementById("caracter_trigger").addEventListener('change', check);
    document.getElementById("nrfisa_trigger").addEventListener('change', check);
    document.getElementById("datdeparazit_trigger").addEventListener('change', check);
    document.getElementById("datvacc_trigger").addEventListener('change', check);
    document.getElementById("datsteril_trigger").addEventListener('change', check);
    document.getElementById("datsterilSteril_trigger").addEventListener('change', check);
    document.getElementById("decedat_trigger").addEventListener('change', check);
    document.getElementById("numeProprietar_trigger").addEventListener('change', check);

    // fisa medicala
    document.getElementById("med_data_trigger").addEventListener('change', check);
    document.getElementById("med_semne_trigger").addEventListener('change', check)
    document.getElementById("tratament_trigger").addEventListener('change', check);;
    document.getElementById("med_diagnostic_trigger").addEventListener('change', check);
    document.getElementById("med_vaccin_trigger").addEventListener('change', check);
    document.getElementById("med_obs_trigger").addEventListener('change', check);
    // fisa catelului
    document.getElementById("nume_trigger").addEventListener('change', check);
    document.getElementById("obs_caine_trigger").addEventListener('change', check);
    document.getElementById("nr_matricol_trigger").addEventListener('change', check);
    document.getElementById("tronson_trigger").addEventListener('change', check);
    document.getElementById("cusca_trigger").addEventListener('change', check);
    document.getElementById("anNastere_trigger").addEventListener('change', check);
    document.getElementById("sex_caine_trigger").addEventListener('change', check);

    document.getElementById("datultdeparazit_trigger").addEventListener('change', check);
    document.getElementById("datultvacc_trigger").addEventListener('change', check);

    
    function check(){
        if(document.getElementById('microcip_trigger').checked == true){
            document.getElementById("microcip_to_show").style.display='block';
        }else{document.getElementById("microcip_to_show").style.display='none';}
        if(document.getElementById('datcapt_trigger').checked == true){
            document.getElementById("datCapt_to_show").style.display='block';
        }else{document.getElementById("datCapt_to_show").style.display='none';}
        if(document.getElementById('nrident_trigger').checked == true){
            document.getElementById("nrident_to_show").style.display='block';
        }else{document.getElementById("nrident_to_show").style.display='none';} 
        if(document.getElementById('loccapt_trigger').checked == true){
            document.getElementById("loccapt_to_show").style.display='block';
        }else{document.getElementById("loccapt_to_show").style.display='none';} 
        if(document.getElementById('datoracaz_trigger').checked == true){
            document.getElementById("datoracaz_to_show").style.display='block';
        }else{document.getElementById("datoracaz_to_show").style.display='none';}     
        if(document.getElementById('caracter_trigger').checked == true){
            document.getElementById("caracter_to_show").style.display='block';
        }else{document.getElementById("caracter_to_show").style.display='none';} 
        if(document.getElementById('nrfisa_trigger').checked == true){
            document.getElementById("nrfisa_to_show").style.display='block';
        }else{document.getElementById("nrfisa_to_show").style.display='none';} 
        if(document.getElementById('datdeparazit_trigger').checked == true){
            document.getElementById("datdeparazit_to_show").style.display='block';
        }else{document.getElementById("datdeparazit_to_show").style.display='none';} 
        if(document.getElementById('datvacc_trigger').checked == true){
            document.getElementById("datvacc_to_show").style.display='block';
        }else{document.getElementById("datvacc_to_show").style.display='none';} 
        if(document.getElementById('datsteril_trigger').checked == true){
            document.getElementById("datsteril_to_show").style.display='block';
        }else{document.getElementById("datsteril_to_show").style.display='none';}
        if(document.getElementById('datsterilSteril_trigger').checked == true){
            document.getElementById("setr_to_show").style.display='block';
        }else{document.getElementById("setr_to_show").style.display='none';} 
        if(document.getElementById('decedat_trigger').checked == true){
            document.getElementById("decedat_to_show").style.display='block';
        }else{document.getElementById("decedat_to_show").style.display='none';} 

        if(document.getElementById('numeProprietar_trigger').checked == true){
            document.getElementById("numeProprietar_to_show").style.display='block';
        }else{document.getElementById("numeProprietar_to_show").style.display='none';} 

        // fisa medicala
        if(document.getElementById('tratament_trigger').checked == true){
            document.getElementById("tratament_to_show").style.display='block';
        }else{document.getElementById("tratament_to_show").style.display='none';}
        if(document.getElementById('med_data_trigger').checked == true){
            document.getElementById("med_data_to_show").style.display='block';
        }else{document.getElementById("med_data_to_show").style.display='none';}
        if(document.getElementById('med_semne_trigger').checked == true){
            document.getElementById("med_semne_to_show").style.display='block';
        }else{document.getElementById("med_semne_to_show").style.display='none';}
        if(document.getElementById('med_diagnostic_trigger').checked == true){
            document.getElementById("med_diagnostic_to_show").style.display='block';
        }else{document.getElementById("med_diagnostic_to_show").style.display='none';}
        if(document.getElementById('tratament_trigger').checked == true){
            document.getElementById("tratament_to_show").style.display='block';
        }else{document.getElementById("tratament_to_show").style.display='none';}
        if(document.getElementById('med_vaccin_trigger').checked == true){
            document.getElementById("med_vaccin_to_show").style.display='block';
        }else{document.getElementById("med_vaccin_to_show").style.display='none';}
        if(document.getElementById('med_obs_trigger').checked == true){
            document.getElementById("med_obs_to_show").style.display='block';
        }else{document.getElementById("med_obs_to_show").style.display='none';}

        // fisa catelului
        if(document.getElementById('nume_trigger').checked == true){
            document.getElementById("nume_to_show").style.display='block';
        }else{document.getElementById("nume_to_show").style.display='none';}
        if(document.getElementById('obs_caine_trigger').checked == true){
            document.getElementById("obs_caine_to_show").style.display='block';
        }else{document.getElementById("obs_caine_to_show").style.display='none';}

        if(document.getElementById('nr_matricol_trigger').checked == true){
            document.getElementById("nr_matricol_to_show").style.display='block';
        }else{document.getElementById("nr_matricol_to_show").style.display='none';}
        if(document.getElementById('tronson_trigger').checked == true){
            document.getElementById("tronson_to_show").style.display='block';
        }else{document.getElementById("tronson_to_show").style.display='none';}
        if(document.getElementById('cusca_trigger').checked == true){
            document.getElementById("cusca_to_show").style.display='block';
        }else{document.getElementById("cusca_to_show").style.display='none';}
        if(document.getElementById('anNastere_trigger').checked == true){
            document.getElementById("anNastere_to_show").style.display='block';
        }else{document.getElementById("anNastere_to_show").style.display='none';}
        if(document.getElementById('sex_caine_trigger').checked == true){
            document.getElementById("sex_caine_to_show").style.display='block';
        }else{document.getElementById("sex_caine_to_show").style.display='none';}
        if(document.getElementById('datultdeparazit_trigger').checked == true){
            document.getElementById("datultdeparazit_to_show").style.display='block';
        }else{document.getElementById("datultdeparazit_to_show").style.display='none';}
        if(document.getElementById('datultvacc_trigger').checked == true){
            document.getElementById("datultvacc_to_show").style.display='block';
        }else{document.getElementById("datultvacc_to_show").style.display='none';}
    }
  }
</script>

<!-- calendar functions -->
<script>
  var button = $( '#calendar-btn' )[0];
  var elem = $( '#calendar-body' )[0];
  var closelem = $( '#close-calendar' )[0];

  $( button ).on( 'click', function ( e ) {
      $( elem ).show();
      $( closelem ).show();
      e.stopPropagation();
  });
                  
  $( closelem ).on( 'click', function ( e ) {
      $( elem ).hide();
      $( closelem ).hide();
      e.stopPropagation();
  });
  
</script>


</body>
</html>