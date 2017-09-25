/**
 * Created by jeroen on 17-9-17.
 */
console.log('kinderklets');

// menu
var menuToggle = document.querySelector('.js-menu-toggle');
var mainNavigation = document.getElementById('site-navigation');
var menuVisible = false;

function isHidden(el) {
    var style = window.getComputedStyle(el);
    return (style.display === 'none')
}

function toggleLoader(){
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
            security: kinderkletsData.security
        }
            .done(function(response) {
                if(response.succes){
                    alert('succes');
                } else {
                    alert('fail');
                }
            })
            .fail(function(error){

            })
            .always(toggleLoader)
    });

}

//setup ajax handler for form
function setupAjax() {
    userSubmitButton = document.getElementById('questionSubmit')

    userSubmitButton.addEventListener('click', function(event) {
       event.preventDefault();

       var formData = {

       }
    });
}

function toggleMainMenu(event) {
    event.preventDefault();
    if( !menuVisible ) {
        mainNavigation.classList.add('main-navigation-active');
    } else {
        mainNavigation.classList.remove('main-navigation-active');
    }
    menuVisible = !menuVisible;
}
menuToggle.addEventListener('click', toggleMainMenu);

if(jQuery('#user-post').length > 0) {
    setupAjax();
}
