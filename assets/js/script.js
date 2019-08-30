$(document).ready(function(){

    $('[id=commentform][class=quotefield]').hide();

    $('.show_more').click(function(){
        var btn_more = $(this);
        var pageId = btn_more.attr('name');
        var formData = {
            id: pageId
        };
        btn_more.val('Подождите...');
        $.ajax({
            url: "/comment/getMoreComments", // куда отправляем
            type: "post", // метод передачи
            dataType: "json",
            data: formData,
            // после получения ответа сервера
            success: function(data){
                if(data.result == "success"){
                    $('.commentlist').append(data.html);
                    btn_more.remove();
                }
            }
        });
    });

    $('.answer_comment').click(function(){
        $('[id=commentform][class=quotefield]').slideUp("slow");
        $('[id=commentform][class=quote]').remove();
        $('.cancel_quote').hide();

        var answer_comment = $(this);
        var commentId = answer_comment.attr('name');
        var formData = {
            id: commentId
        };
        $.ajax({
            url: "/comment/answerComment", // куда отправляем
            type: "post", // метод передачи
            dataType: "json",
            data: formData,
            // после получения ответа сервера
            success: function(data){
                if(data.result == "success"){
                    $('.quotefield').prepend(data.html);
                    $('.cancel_quote').show();
                    $('.quotefield').slideDown("slow");
                }
            }
        });
    });

    $('.cancel_quote').click(function() {
        $('[id=commentform][class=quotefield]').slideUp("slow");
        $('[id=commentform][class=quote]').remove();
        $(this).hide();
    });

    $('.delete_comment').click(function(){
        $('[id=commentform][class=quotefield]').slideUp("slow");
        $('[id=commentform][class=quote]').remove();
        $('.cancel_quote').hide();
        var delete_comment = $(this);
        var commentId = delete_comment.attr('name');
        var formData = {
            id: commentId
        };
        $.ajax({
            url: "/comment/deleteComment", // куда отправляем
            type: "post", // метод передачи
            dataType: "json",
            data: formData,
            // после получения ответа сервера
            success: function(data){
                if(data.result == "success"){
                    delete_comment.parent().remove();
                }
            }
        });
    });

    $('.add_comment').click(function() {
        var commentFrm = $(this).parent();
        var parentId = commentFrm.children('.quotefield').children('.quote').attr('name');
        var recipients_id = commentFrm.attr('id');
        var title = commentFrm.find('#title').val();
        var theme = commentFrm.find('#theme').val();
        var text = commentFrm.find('#text').val();
        var formData = {
            commentTitle: title,
            commentTheme: theme,
            commentText: text,
            parentId: parentId,
            recipients_id: recipients_id
        };
        $.ajax({
            url: "/comment/postNewComment", // куда отправляем
            type: "post", // метод передачи
            dataType: "json",
            data: formData,
            // после получения ответа сервера
            success: function(data){
                if(data.result == "success"){
                    window.location.reload();
                }
            }
        });
    });

});
