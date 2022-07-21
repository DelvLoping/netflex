/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

function openNav() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("box1").style.top = "400px";
    document.getElementById("box1").style.border = "1px solid #fff";
    document.getElementById("box1").style.transform = "scale(1)";
    document.getElementById("row").style.height = "800px";
 
    // document.getElementById("box1").style.display = "block";
}
 
function closeNav() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("box1").style.transform = "scale(1)";
    document.getElementById("box1").style.transition = "all 0.7s ease";
    document.getElementById("box1").style.border = "none";
}
 
$("#new_edit_utilisateur").on('submit', function(){
    if($("#utilisateur_password").val() != $("#verifpass").val()) {
        //implémntez votre code
        alert("Les deux mots de passe saisies sont différents");
        alert("Merci de renouveler l'opération");
        return false;
    }
})