setInterval(() => {
    var hackathon_name=$('#hackathonName').val();
    $.post("updateonline.php",{hackathon:hackathon_name},function(data){     
        let update = document.getElementById('update');
        update.innerHTML= data;
        });


    var hackathon_name=$('#hackathonName').val();
    $.post("updatetableonline.php",{hackathon:hackathon_name},function(data){     
        let tableData = document.getElementById('tableData');
        tableData.innerHTML= data;
        });
  
    var hackathon_name=$('#hackathonName').val();
        $.post("updatesubmission.php",{hackathon:hackathon_name},function(data){     
            let submission = document.getElementById('submission');
            submission.innerHTML= data;
        }); 

},60000);   


let Refresh=document.getElementById('Refresh');
Refresh.addEventListener('click',function(){
    
    var hackathon_name=$('#hackathonName').val();
    $.post("updatesubmission.php",{hackathon:hackathon_name},function(data){     
        let submission = document.getElementById('submission');
        submission.innerHTML= data;
    });



    var hackathon_name=$('#hackathonName').val();
    $.post("updateonline.php",{hackathon:hackathon_name},function(data){     
        let update = document.getElementById('update');
        update.innerHTML= data;
        });


    var hackathon_name=$('#hackathonName').val();
    $.post("updatetableonline.php",{hackathon:hackathon_name},function(data){     
        let tableData = document.getElementById('tableData');
        tableData.innerHTML= data;
        });

    var hackathon_name=$('#hackathonName').val();
        $.post("recievemessage.php",{hackathon:hackathon_name},function(data){     
        let recievemessages = document.getElementById('recievemessages');
        recievemessages.innerHTML= data;
        });    
        


});

