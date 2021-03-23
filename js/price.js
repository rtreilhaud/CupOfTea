"use strict";

//Fonction qui détermine le prix en fonction de la quantité choisi
function priceQuantity(targetElmt, targetElmt2){ //on prvoit les paramètres pour cibler nos éléments. Si beaucoup d'éléments, créer un tableau de paramètres.
    //on indique quels vont être les éléments sur lesquels on va agir. Dans notre cas ce sera :
    let element1 = document.querySelector(targetElmt); //le champ select
    let element2 = document.querySelector(targetElmt2); //la div contenant le prix
    //on écoute l'événement "change" sur le champ select
    element1.addEventListener("change", function(){ 
        let quantity = this.value; //on récupère la valeur du champ select au moment du changement

        //on évalue la variable "quantity" et, selon le résultat obtenu et le prix associé, on modifie le contenue de la div qui contient le prix.
        switch(quantity){ 
            case "100":
                element2.innerHTML = "9,00€"
            break;

            case "500":
                element2.innerHTML = "40,00€"
            break;

            case "1000":
                element2.innerHTML = "75,00€"
            break;
        }
    });
}
//on écoute le document et on attend que le DOM de la page soit totalement chargé. Equivalent de $(document).ready pour jQuery
document.addEventListener("DOMContentLoaded", function(){
    priceQuantity("#quantities", "#price"); //on éxécute la fonction.
});