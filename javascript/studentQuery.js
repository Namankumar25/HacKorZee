let messageform = document.getElementById('messageform');
messageform.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('querySend.php', {
        method: "POST",
        body: formData
    }).then(function(response) {
        return response.text();
    }).then(function(DATA) {        
       
    })
    let inputMessage=document.getElementById('inputMessage');
    inputMessage.value="";
});    
