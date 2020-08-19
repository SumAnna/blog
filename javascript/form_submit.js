 document.addEventListener('DOMContentLoaded', function(){
 var form = document.getElementById('form-comment');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        var request = new XMLHttpRequest();
        request.open('POST', 'form_submit.php');
        var data = new FormData(form);
        request.send(data);
        request.onload = function(){ 
           if (this.status === 200) {
               response_json = JSON.parse(this.responseText);
                if (typeof response_json.error_name === 'undefined') {
                    form.reset();
                    document.querySelector('#validation').innerHTML = 'Комментарий отправлен!';
                    document.querySelector('.message-box').setAttribute('class', 'message-box message-box-success');
                    document.querySelector('.fa-2x').setAttribute('class', 'fa fa-check fa-2x');
                    var parent = document.getElementsByClassName('comments')[0];
                    var theFirstChild = parent.firstChild;
                    var theLastChild = document.querySelector('.hidden-comment');
                    var newComment = theLastChild.cloneNode(true);
                    if (theFirstChild){
                      parent.prepend(newComment, theFirstChild); 
                    } else {
                       parent.appendChild(newComment);
                    }
                    newComment.setAttribute('class', 'comments-container');
                    newComment.querySelector('.comment-author').innerHTML = response_json.author;
                    newComment.querySelector('.comment-ip').innerHTML = 'IP: '+response_json.ip;
                    newComment.querySelector('.comment-date').innerHTML = 'Опубликовано: '+response_json.created_at;
                    newComment.querySelector('.comment-content').innerHTML = response_json.comment;
                } else {
                    document.querySelector('#validation').innerHTML = response_json.error_name;
                    document.querySelector('.message-box').setAttribute('class', 'message-box message-box-error');
                    document.querySelector('.fa-2x').setAttribute('class', 'fa fa-ban fa-2x');
                }
            } else {
                document.querySelector('#validation').innerHTML = 'Ошибка! Комментарий не отправлен';
                document.querySelector('.message-box').setAttribute('class', 'message-box message-box-error');
                document.querySelector('.fa-2x').setAttribute('class', 'fa fa-ban fa-2x');
            }
        };
    });
 });

