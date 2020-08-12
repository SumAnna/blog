document.addEventListener('DOMContentLoaded', function(){
    var form = document.getElementById('form-comment');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        var request = new XMLHttpRequest();
        request.open('POST', 'form_submit.php');
        var data = new FormData(form);
        request.send(data);
        
        request.onload = function(){
           form.reset(); 
           var response = JSON.parse(this.responseText);
           alert(response.message);
           var parent = document.getElementsByClassName('comments')[0];
           var theFirstChild = parent.firstChild;
           var theLastChild = document.getElementsByClassName('hidden-comment')[0];
           var newComment = theLastChild.cloneNode(true);
           parent.prepend(newComment, theFirstChild);
           newComment.setAttribute("class", "comments-container");
           newComment.querySelector(".comment-author").innerHTML = data.get('author');
           newComment.querySelector(".comment-ip").innerHTML = 'IP: '+response.ip;
           newComment.querySelector(".comment-date").innerHTML = 'Опубликовано: '+response.created_at;
           newComment.querySelector(".comment-content").innerHTML = data.get('comment');
        };
        
        request.onerror = function(){
           var response = JSON.parse(this.responseText);
           alert(response.message);
        };
        
    });
});

