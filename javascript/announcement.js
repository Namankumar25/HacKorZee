setInterval(() => {

    var hackathon_name=$('#hackathonName').val();
    var student_team=$('#studentTeam').val();
    $.post("studentQueryfetch.php",{hackathon:hackathon_name,studentteam:student_team},function(data){     
    let announcement = document.getElementById('announcement');
    announcement.innerHTML= data;
    });

},1000);   

