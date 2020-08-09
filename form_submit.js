document.addEventListener('DOMContentLoaded', function(){
    var form = document.getElementById('form-comment');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        var request = new XMLHttpRequest();
        request.onload = function(){
           alert(this.responseText);
        };
        request.open('POST', 'form_submit.php');
        var data = new FormData(form);
        //alert(data.get('comment'));
        request.send(data);
    });
});

