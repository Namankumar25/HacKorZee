setInterval(() => {

    var hackathon_name=$('#hackathonName').val();
    $.post("recievemessage.php",{hackathon:hackathon_name},function(data){     
    let recievemessages = document.getElementById('recievemessages');
    recievemessages.innerHTML= data;
    });
    
},1000);   

