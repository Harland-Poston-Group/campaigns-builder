<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo csrf_token() ; ?>">
    <link rel="icon" type="image/png" href="/images/favicon32x32.png" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.css" integrity="sha512-bR79Bg78Wmn33N5nvkEyg66hNg+xF/Q8NA8YABbj+4sBngYhv9P8eum19hdjYcY7vXk/vRkhM3v/ZndtgEXRWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= $page->get('title')?></title>
    <link rel="stylesheet" href="<?= phpb_theme_asset('css/style.css') ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.10/css/grapes.min.css" integrity="sha512-F+EUNfBQvAXDvJcKgbm5DgtsOcy+5uhbGuH8VtK0ru/N6S3VYM9OHkn9ACgDlkwoxesxgeaX/6BdrQItwbBQNQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.10/grapes.min.js" integrity="sha512-TavCuu5P1hn5roGNJSursS0xC7ex1qhRcbAG90OJYf5QEc4C/gQfFH/0MKSzkAFil/UBCTJCe/zmW5Ei091zvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "jfky1xya3k");
    </script>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '163126273522999');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=163126273522999&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- Meta Pixel Code --> <script> !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s)}(window, document,'script', ' https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '678459207652433'); fbq('track', 'PageView'); </script> <noscript><img height="1" width="1" style="display:none" src=" https://www.facebook.com/tr?id=678459207652433&ev=PageView&noscript=1" /></noscript> <!-- End Meta Pixel Code -->

    <!-- Twitter conversion tracking base code --> <script> !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments); },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js' , a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script'); twq('config','ogkqf'); </script> <!-- End Twitter conversion tracking base code -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N5WRRKQX');</script>
    <!-- End Google Tag Manager -->


</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="
https://www.googletagmanager.com/ns.html?id=GTM-N5WRRKQX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="container-fluid">
    <div class="row">
        <div class="mx-0 ">
            <?= $body ?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
<script src="<?= phpb_theme_asset('js/script.js') ?>"></script>
<button id="scrollToTopBtn" title="Go to top"><img src="/images/GoTopArrow.png"></button>

<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-GYDWX32BH1"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-GYDWX32BH1'); </script>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/143154105.js"></script>
<!-- End of HubSpot Embed Code -->

<script>

    function getParam(p) {
    var match = RegExp('[?&]' + p + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }

    function getExpiryRecord(value) {
    var expiryPeriod = 90 * 24 * 60 * 60 * 1000; // 90 day expiry in milliseconds

    var expiryDate = new Date().getTime() + expiryPeriod;
    return {
    value: value,
    expiryDate: expiryDate
    };
    }

    function addGclid() {
    var gclidParam = getParam('gclid');
    var gclidFormFields = ['gclid_field', 'foobar']; // all possible gclid form field ids here
    var gclidRecord = null;
    var currGclidFormField;

    var gclsrcParam = getParam('gclsrc');
    var isGclsrcValid = !gclsrcParam || gclsrcParam.indexOf('aw') !== -1;

    gclidFormFields.forEach(function (field) {
    if (document.getElementById(field)) {
    currGclidFormField = document.getElementById(field);
    }
    });

    if (gclidParam && isGclsrcValid) {
    gclidRecord = getExpiryRecord(gclidParam);
    localStorage.setItem('gclid', JSON.stringify(gclidRecord));
    }

    var gclid = gclidRecord || JSON.parse(localStorage.getItem('gclid'));
    var isGclidValid = gclid && new Date().getTime() < gclid.expiryDate;

    if (currGclidFormField && isGclidValid) {
    currGclidFormField.value = gclid.value;
    }
    }
    window.addEventListener('load', addGclid);
</script>

</body>
</html>
<script>
    jQuery.noConflict();
    jQuery(function() {
        if (jQuery(this).scrollTop() >= 200) {
            // Display the message
            jQuery('#topMenu').fadeIn().addClass('active');
        } else {
            // Hide the message if not scrolled 200 pixels
            jQuery('#topMenu').hide().removeClass('active');

        }
    });
</script>
