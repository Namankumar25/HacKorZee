let edits = document.getElementsByClassName('edit');

Array.from(edits).forEach(function(element) {
    element.addEventListener('click', function(e) {
        let tr = e.target.parentNode.parentNode;
        let title = tr.getElementsByTagName('td')[1].innerText;
        let titleEmail = tr.getElementsByTagName('td')[2].innerText;
    
        let edittitle = document.getElementById('Edittitle');
        let editEmail = document.getElementById('editEmail');
       
        edittitle.value = title;
        editEmail.value = titleEmail;
        $('#assignmodal').modal('toggle');
       
    });
});