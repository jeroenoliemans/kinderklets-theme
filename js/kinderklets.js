// imports
require('script-loader!../js/kinderklets-libs.js');

/**
 * Created by jeroen on 17-9-17.
 */
jQuery(function($) {

    // menu
    var menuToggle = document.querySelector('.js-menu-toggle');
    var mainNavigation = document.getElementById('site-navigation');
    var menuVisible = false;
    var isPrivate;
    var bogusEmail = 'public@public.foo';

    function isHidden(el) {
        var style = window.getComputedStyle(el);
        return (style.display === 'none')
    }

    // set up form validation
    var $questionForm = jQuery('#user-question').parsley({
        successClass: 'has-success',
        errorClass: 'has-danger',
        errorsWrapper: '<span class=\"help-block\"></span>',
        errorTemplate: '<span></span>'
    });

    //validation events
    window.Parsley.on('field:error', function() {
        this.$element.parents('.form-group').removeClass('has-success');
        this.$element.parents('.form-group').addClass('has-danger');
    });
    window.Parsley.on('field:success', function() {
        this.$element.parents('.form-group').removeClass('has-danger');
        this.$element.parents('.form-group').addClass('has-success');
    });


    function hideLoader() {
        var loader = document.getElementById('kkLoader');
        loader.classList.remove('is-block');
        loader.classList.add('is-none');
    }

    function showLoader() {
        var loader = document.getElementById('kkLoader');
        loader.classList.remove('is-none');
        loader.classList.add('is-block');
    }

    function setFutureQuestionLink() {
        var futureLink = 'https://www.kinderklets.nl/index.php?p=' + sessionStorage.getItem('kk-questionPostId');
        var futureQuestionLink = document.getElementById('futureQuestionLink');

        // set href and linkText
        futureQuestionLink.href = futureLink;
        futureQuestionLink.innerHTML = futureLink
    }

    function toggleFormDisplay(event) {
        var submitButton = document.getElementById('questionSubmit');
        var formEmail = document.getElementById('forGroupEmail');
        var emailField = document.getElementById('questionEmail');

        isPrivate = document.querySelector('input[name="questionPrivacy"]:checked').value === 'private';

        if(isPrivate) {
            submitButton.innerText = 'Naar de betaalpagina';
            emailField.value = '';
            formEmail.classList.remove('is-none');
            formEmail.classList.add('is-flex');
        } else {
            submitButton.innerText = 'Verstuur je vraag';
            emailField.value = bogusEmail;
            formEmail.classList.remove('is-flex');
            formEmail.classList.add('is-none');
        }
    }

    function performSuccesAction(postId) {
        // set session for link building in thankyou page
        sessionStorage.setItem('kk-questionPostId', postId);

        var wpPage = document.getElementById('wordpressPage');
        var questionForm = document.getElementById('user-question');
        var thankYouSection = document.getElementById('thankyouSection');

        if(isPrivate) {
            console.log('redirect to iDeal page');
        } else {
            wpPage.classList.add('is-none');
            questionForm.classList.add('is-none');
            setFutureQuestionLink();
            thankYouSection.classList.remove('is-none');
            thankYouSection.classList.add('is-block');
        }
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
                    performSuccesAction(response.data);
                } else {
                    alert('fail');
                }
            })
            .fail(function (error) {

            })
            .always(hideLoader);
    }

    //setup ajax handler for form
    function setupAjax() {
        var questionForm = document.getElementById('user-question');

        questionForm.addEventListener('submit', function (event) {

            $questionForm.validate();

            // if this form is valid
            if ($questionForm.isValid()) {
                var formData = {
                    questionPrivacy: document.querySelector('input[name="questionPrivacy"]:checked').value,
                    questionQuestion: document.getElementById('questionQuestion').value,
                    questionSex: document.querySelector('input[name="questionSex"]:checked').value,
                    questionAge: document.getElementById('questionAge').value,
                    questionEmail: document.getElementById('questionEmail').value,
                    questionFamily: document.querySelector('#questionFamily').value,
                    questionSchool: document.querySelector('#questionSchool').value,
                    questionSiblings: document.querySelector('input[name="questionSiblings"]:checked').value,
                };

                //ajax request
                adminAjaxRequest(formData, 'kinderklets_process_question_post');

                showLoader();
            }

            event.preventDefault();
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

    function setupFormEvents() {
        var formPrivateRadios = document.querySelectorAll('input[name="questionPrivacy"]');

        for (var i = 0; i < formPrivateRadios.length; i++) {
            formPrivateRadios[i].addEventListener('change', toggleFormDisplay);
        }
    }

    if (jQuery('#user-question').length > 0) {
        setupAjax();
        setupFormEvents();
    }
});
