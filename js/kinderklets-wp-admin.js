jQuery(function($) {

    function adminAjaxRequest(emaildata, action) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: kinderkletsData.adminAjax,
            data: {
                action: action,
                data: emaildata,
                security: document.getElementById('kinderklets_nonce').value
            }
        })
            .done(function (response) {
                if(response.success){
                    console.log('success');
                }else{
                    console.log('error');
                }
            })
            .fail(function (error) {

            });
    }


    function emailAjaxhandler(event) {

        var emailData = {
            question: document.getElementById('title').value,
            emailAddress: document.getElementById('customerEmailAddress').innerHTML
        }

        adminAjaxRequest(emailData, 'kinderklets_email_question_answer');
    }

    function setUpEvents() {
        var emailButton = document.getElementById('emailPrivateClient');

        emailButton.addEventListener('click', emailAjaxhandler);
    }

    if (document.getElementById('emailPrivateClient') !== null) {
        setUpEvents();
    }
});