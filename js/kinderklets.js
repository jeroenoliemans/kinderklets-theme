/**
 * Created by jeroen on 17-9-17.
 */
jQuery(function($) {

    // menu
    var menuToggle = document.querySelector('.js-menu-toggle');
    var mainNavigation = document.getElementById('site-navigation');
    var menuVisible = false;

    function isHidden(el) {
        var style = window.getComputedStyle(el);
        return (style.display === 'none')
    }

    function toggleLoader() {
        console.log('toggle loader');
    }

    function adminAjaxRequest(formdata, action) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: kinderkletsData.adminAjax,
            data: {
                action: action,
                data: formdata,
                security: document.getElementById('kinderklets_nonce').value
            }
        })
            .done(function (response) {
                if (response.success) {
                    alert('succes');
                } else {
                    alert('fail');
                }
            })
            .fail(function (error) {

            })
            .always(toggleLoader);
    }

    //setup ajax handler for form
    function setupAjax() {
        userSubmitButton = document.getElementById('questionSubmit')

        userSubmitButton.addEventListener('click', function (event) {
            event.preventDefault();

            var formData = {
                questionPrivacy: document.querySelector('input[name="questionPrivacy"]:checked').value,
                questionQuestion: document.getElementById('questionQuestion').value,
                questionSex: document.querySelector('input[name="questionSex"]:checked').value,
                questionAge: document.getElementById('questionAge').value,
                questionEmail: document.getElementById('questionEmail').value,
                questionFamily: document.querySelector('#questionFamily').value,
                questionSchool: document.querySelector('#questionSchool').value,
                questionSiblings: document.querySelector('input[name="questionSiblings"]:checked').value,
            }

            //ajax request
            adminAjaxRequest(formData, 'kinderklets_process_question_post');
        });
    }

    function toggleMainMenu(event) {
        event.preventDefault();
        if (!menuVisible) {
            mainNavigation.classList.add('main-navigation-active');
        } else {
            mainNavigation.classList.remove('main-navigation-active');
        }
        menuVisible = !menuVisible;
    }

    menuToggle.addEventListener('click', toggleMainMenu);

    if (jQuery('#user-post').length > 0) {
        setupAjax();
    }
});
