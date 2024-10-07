jQuery(document).ready(function() {
    jQuery("lottie-player").addClass("lottie-custom");

    let currentUrl = window.location.href;

    // Check if the URL contains '/campaign'
    if (currentUrl.indexOf("/campaign") !== -1) {
        // Set a new title for the page
        document.title = "Investment Visa US Campaign";
    }

    if (currentUrl.indexOf("/thankyou") !== -1) {
        // Set a new title for the page
        document.title = "Before you leave...";
    }

    jQuery('#campaign-form.thank-you-form').insertBefore('#footer-thank-you').addClass('col-12');

    jQuery('.address-block').html(function(_, html) {
        // Replace "Terms & Conditions | Privacy Policy" with linked text
        return html.replace('Terms & Conditions | Privacy Policy',
            '<a href="https://www.investmentvisa.com/privacy-policy" target="_blank">Terms & Conditions</a> | <a href="https://www.investmentvisa.com/privacy-policy" target="_blank">Privacy Policy</a>'
        );
    });


});
    jQuery(document).ready(function() {

        const blacklist = [
            "free visa",
            "jobless",
            "work parmit",
            "work permit",
            "uber",
            "need job",
            "need a job",
            "job",
            "jobs",
            "encountered an error",
            "unsubscribe",
            "marketing emails",
            "language settings",
            "unable to access my account",
            "sponsor visa",
            "sponsorship visa",
            "tourist visa",
            "work visa",
            "fuck",
            "shit",
            "sshit"
        ];
        jQuery('textarea').on('input', function() {
            let content = jQuery(this).val();
            let foundBlacklisted = false;

            // Check if any blacklisted word/sentence exists
            jQuery.each(blacklist, function(index, word) {
                var regex = new RegExp('\\b' + word + '\\b', 'gi'); // Create regex for each blacklisted word
                if (regex.test(content)) {
                    foundBlacklisted = true;
                    alert("You have written '" + word + "' Investment Visa does not offer services in regard to '" + word + "'.");
                    /*
                    if(word === 'work visa')
                    {
                        alert("You have written Work Visa. Investment Visa does not offer services in regard to Work Visas.");
                    }
                    else {
                        alert("The word or sentence '" + word + "' is not allowed.");

                    }
                    */
                    // Remove the word/sentence from the content
                    content = content.replace(regex, '');
                }
            });

            // Update the textarea with the filtered content
            if (foundBlacklisted) {
                jQuery('textarea').val(content); // Update if a blacklisted word was found
            }
        });
    });


jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Capture referrer and location data
    let referrer = document.referrer;

    let locationData = {};

    /*
    fetch('http://ip-api.com/json/')
        .then(response => response.json())
        .then(data => {
            locationData.country = data.country;
            locationData.city = data.city;
            locationData.region = data.regionName;
            locationData.timezone = data.timezone;
            locationData.query = data.query;
            // Attach form submit event after location data is available
            document.getElementById('campaign-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                // Append referrer and location data to the formData
                formData.append('referrer', referrer);
                formData.append('country', locationData.country);
                formData.append('city', locationData.city);
                formData.append('region', locationData.region);
                formData.append('timezone', locationData.timezone);
                formData.append('IP', locationData.query);

                fetch('send-email.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        // Show Toastify toast message
                        Toastify({
                            text: data,
                            duration: 5000, // 5 seconds
                            gravity: "top", // top or bottom
                            position: "center", // left, center, or right
                            backgroundColor: "#6A257A", // customize color
                        }).showToast();
                        // Reset the form after successful submission
                        this.reset();
                    })
                    .catch(error => console.error('Error:', error));
            });
        })
        .catch(err => console.error('Error getting location data:', err));
    */
});


/*
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('campaign-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('send-email.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // Show Toastify toast message
                Toastify({
                    text: data,
                    duration: 5000, // 5 seconds
                    gravity: "top", // top or bottom
                    position: "center", // left, center, or right
                    backgroundColor: "#6A257A", // green for success
                }).showToast();
                // Reset the form after successful submission
                this.reset();
            })
            .catch(error => console.error('Error:', error));
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Detect referrer
    let referrer = document.referrer;
    console.log("Referrer: ", referrer);

    fetch('http://ip-api.com/json/')
        .then(response => response.json())
        .then(data => {
            let country = data.country;
            let city = data.city;
            let regionName = data.regionName;
            let timezone = data.timezone;
            console.log("Region: ", regionName);
            console.log("Country: ", country);
            console.log("City: ", city);
            console.log("Time Zone: ", timezone);
        })
        .catch(err => console.error(err));
});
*/

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');

        // Check if targetId is not just '#'
        if (targetId !== '#') {
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }

    scrollToTopBtn.addEventListener('click', function() {
        // console.log('scrollToTopBtn');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});


jQuery(document).ready(function() {

    jQuery('#top-menu .container-fluid').removeClass('container-fluid').addClass('container');

    const newDiv = jQuery('<div class="col-12"></div>');

    // Wrap the content of .footer-iv with the new div
    jQuery('.footer-iv').wrapInner(newDiv);

    jQuery(window).on('scroll', function() {
        const scrollPosition = jQuery(this).scrollTop();
        // console.log('Scroll position:', scrollPosition);

        if (scrollPosition >= 600) {
            jQuery('.right-button-scroll').fadeIn().addClass('active');
        }
        else {
            jQuery('#campaign-form').removeClass('move-to-right').fadeIn();
            jQuery('.right-button-scroll').hide().removeClass('active');
            // jQuery('#scrollToTopBtn').fadeOut()
        }
    });

    jQuery(".right-button-scroll").on( "click", function(e) {
        e.preventDefault();
        jQuery('#campaign-form').hide().addClass('move-to-right');
       // jQuery('<a href="#" class="btn-close"><i class="far fa-times-circle"></i></a>').insertBefore('#campaign-form .form-title');
        jQuery('#campaign-form.move-to-right').show();
    });
});

jQuery(document).ready(function(){

    const divsToWrap = jQuery('.video-mask, .header-mask'); // Adjust the selectors to match your divs

    // Wrap the selected divs with a new div
    divsToWrap.wrapAll('<div class="video-wrapper"></div>');


    if(jQuery(window).width() < 767)
    {
        jQuery('#campaign-form').insertAfter('.video-wrapper');



        jQuery(".right-button-scroll").on( "click", function(e) {
            e.preventDefault();
            console.log('top');
            jQuery('#campaign-form').hide().addClass('move-to-right');
            // jQuery('<a href="#" class="btn-close"><i class="far fa-times-circle"></i></a>').insertBefore('#campaign-form .form-title');
            jQuery('#campaign-form.move-to-right').show();
        });


        jQuery('body').addClass('mobile');
        jQuery(".header-mask").attr("src", "/images/headermask-mobile.png").appendTo('.video-container');
        jQuery('#cards-row .card-container').removeClass('col-12').addClass('col-6');
        jQuery('.bottom-cards .card-container').removeClass('col-12').addClass('col-6');
        jQuery('#cards-row .card-container').slice(0, 2).wrapAll('<div class="row"></div>');
        jQuery('#cards-row .card-container').slice(-2).wrapAll('<div class="row"></div>');
        jQuery('.bottom-cards .card-container').wrapAll('<div class="bottom-cards-inner row"></div>');
        jQuery('.title-bottom').insertAfter('.img-bottom');
        jQuery('.title-left').insertAfter('.img-left');

    } else {
        jQuery('body').removeClass('mobile');
        jQuery(".header-mask").attr("src", "/images/headermask.png");
        jQuery('#navbar').removeClass('col-sm-8').addClass('col-sm-12');
        jQuery('#cards-row .card-container').removeClass('col-6').addClass('col-12');
        jQuery('.title-bottom').insertBefore('.img-bottom');
        jQuery('.title-left').insertBefore('.img-left');
    }

    jQuery('.navbar-toggler').on('click', function() {
        jQuery('#navbar').toggleClass('show');
    });

    jQuery(".top-video-block").wrap("<div class='video-container'></div>");

    const url = window.location.href;
    // Example: Extract the path name
    const pathname = window.location.pathname;

    // You can also extract other parts of the URL if needed
    // var hostname = window.location.hostname;
    // var searchParams = new URLSearchParams(window.location.search);
    // var someParam = searchParams.get('someParam');

    // Add class to the body based on the path
    jQuery('body').addClass(pathname.replace(/\//g, 'page-'));

    // Example: Add class based on specific URL condition
    /*
    if (url.includes('admin')) {
        jQuery('body').addClass('admin-page');
    }
    */
/*
jQuery('<div class="toast-container p-3 top-50 start-70 translate-middle" id="toastPlacement" data-original-class="toast-container p-3">' +
    '<div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts">' +
    '<div class="toast" data-bs-autohide="false">\n' +
    '  <div class="toast-header">\n' +
    '    <i class="fas fa-info-circle"></i> You have selected Work Visa\n' +
    '    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>\n' +
    '  </div>\n' +
    '  <div class="toast-body">\n' +
    '    Investment Visa does not offer services in regards to Work Visas.\n' +
    '  </div>\n' +
    '</div></div></div>').insertAfter('#campaign-form .form-title');
*/
    jQuery("#enquiry_subject").change(function() {
        let val = jQuery(this).val();
        const alert = jQuery('<div id="campaign-info" class="alert alert-warning alert-dismissible fade show" role="alert"><a class="btn-close" data-dismiss="alert" aria-label="Close"><i class="far fa-times-circle"></i></a><i class="fas fa-info-circle"></i> You have selected Work Visa<br>Investment Visa does not offer services in regards to Work Visas.</div>');

        if (jQuery(this).val() === "Work Visa") {
            jQuery('#form-bt').attr("disabled", true);
            // const toast = new bootstrap.Toast(document.querySelector('.toast'));
            // toast.show({ delay: 50000 });
            alert.appendTo('#campaign-form');
        }
        else {
            jQuery('#form-bt').attr("disabled", false);
            jQuery('.alert').hide().removeClass('show');
        }
    });

    jQuery("input#phone").on("keypress keyup blur", function(event) {
        // 1. Check for invalid characters
        var hasInvalidChars = /[^0-9+()-]/.test(jQuery(this).val());
        //jQuery(this).val(jQuery(this).val().replace(/\s/g, "-"));
        // 2. Modify input value (same as before)
        jQuery(this).val(jQuery(this).val().replace(/[^0-9+()-]/g, ""));

        console.log('tel');

        // 3. Add/remove error message based on validity
        if (hasInvalidChars) {
            jQuery(this).addClass("error"); // Add error class to input field
            let msg = 'No Letters Allowed.'
            jQuery('<div class="alert alert-danger error-message m-0 p-1 px-2 small" role="alert"><span class="small">'+ msg +'</span></div>').insertAfter(this);
            // jQuery(".error-message").show(); // Show error message element
        } else {
            jQuery(this).removeClass("error"); // Remove error class
            jQuery(".error-message").hide().css("display", "none"); // Hide error message element
        }
    });

});

// Form submission
jQuery("#campaign-form").on("submit", function(e){

    e.preventDefault();

    var this_form = jQuery(this).serialize();
    var this_form_element = jQuery(this);

    let submitButton = this_form_element.find('button[type=submit]');

    if( submitButton.length > 0 ){

        submitButton.html('Submitting... <span id="spinner"><svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" width="20px" height="20px"><path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" /></path></svg></span>');

    }

    // Disable the button
    submitButton.prop('disabled', true);


    jQuery.ajax({
        url: "/form-submission.php",
        type: "POST",
        // headers: {
        //     'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        // },
        data: this_form,
        success:function(response){
            if (response){
                //   jQuery('#success-message').text(response.success).css({"color":"green"});

                // Notify(response.success, null, null, 'success');

                // // Clean form
                // jQuery("#get-in-touch-with-us-form")[0].reset();
                // grecaptcha.reset(); // Reset the reCAPTCHA widget

                console.log('success: ' + response);

                Toastify({
                    text: 'Thank you for your enquiry. We\'ll be in contact, shortly',
                    duration: 5000, // 5 seconds
                    gravity: "top", // top or bottom
                    position: "center", // left, center, or right
                    backgroundColor: "#6A257A", // customize color
                }).showToast();

                // Reset the form after successful submission
                // this_form_element.reset();

            }else{
                // jQuery('#success-message').text(response.error).css({"color":"red"});

                // Notify(response.error, null, null, 'error');
                // enquire_button.attr('disabled', false);
                // grecaptcha.reset(); // Reset the reCAPTCHA widget
                console.log('error: ' + response);

            }
        },
        error: function error(xhr, status, errorMessage) {
            console.log("RESPONSE: , error: " + errorMessage);
        },
        complete: function() {
            // Revert the button text and remove the spinner
            submitButton.html('Submit');
            submitButton.prop('disabled', false);
            this_form_element[0].reset();
            // Redirect the user to the /thankyou page after completion


            // window.location.href = "/thank-you";

            if (window.location.hash !== '#debug') {
                window.location.href = "/thank-you";
            }
        }
    });

});
/*
const swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
    }
});
*/
var urlParams = new URLSearchParams(window.location.search);

// Function to add hidden fields dynamically
function addHiddenField(name, value) {
    if (value !== null && value !== "") {
        $('<input>').attr({
            type: 'hidden',
            name: name,
            value: value
        }).appendTo('#campaign-form');
    }
}

// Add UTM parameters as hidden fields to the form
addHiddenField('utm_source', urlParams.get('utm_source'));
addHiddenField('utm_medium', urlParams.get('utm_medium'));
addHiddenField('utm_campaign', urlParams.get('utm_campaign'));
addHiddenField('utm_term', urlParams.get('utm_term'));
addHiddenField('utm_content', urlParams.get('utm_content'));
