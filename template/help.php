<style>
    .popup {
        font-family: 'Mukta', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        text-align: center;
        text-transform: uppercase;
        position: fixed;
        float: none;
        display: inline-block;
        cursor: pointer;
        background: #DAA520;
        /*background: #282936;*/
        right: 1em;
        bottom: 0.5em;
        z-index: 1;
        border: 0;
        margin: 0 !important;
        border-radius: 2rem;
        color: #fff;
        padding: 0.3em 0.5em 0.3em 0.5em;
    }
    .popuptxt {
        visibility: hidden;
        display: inline-block;
        position: fixed;
        float: none;
        cursor: pointer;
        background: #DAA520;
        border-radius: 2rem;
        right: 1em;
        bottom: 0.5em;
        padding: 0.3em 0.5em 0.3em 0.5em;
        margin: 0 !important;
    }
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }
    .popup .hide {
        -webkit-animation: fadeOut 1s;
        animation: fadeOut 1s;
        transition-delay: 1s;
        visibility: hidden;
    }
    * {
        line-height: normal !important;
    }
    @-webkit-keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
    @-webkit-keyframes fadeOut {
        from {opacity: 1;}
        to {opacity: 0;}
    }
    @keyframes fadeOut {
        from {opacity: 1;}
        to {opacity: 0;}
    }
</style>
<!-- Replacing the page when the help button is clicked -->
<div class="popup" onmouseenter="fadingIn()" onmouseleave="fadingOut()" onclick="window.location.replace('faq.php')">
    <p style="margin: 0;">?</p>
    <p class="popuptxt hide" id="myPopup">Help & FAQ ?</p>
</div>
<script> /* Fading in the rest of the button when hovered */
function fadingIn() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
    popup.classList.toggle("hide");
}  /* Fading out the rest of the button when mouse leaves */
function fadingOut() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("hide");
    popup.classList.toggle("show");
}
</script>