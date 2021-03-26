// Importation des classes
import Display from './class/Display.js';
import Ajax from './class/Ajax.js';

// Instanciation des classes
const display = new Display();
const ajax = new Ajax();

document.addEventListener('DOMContentLoaded', ()=>{

    // Gestion des onglets / affichage
    document.addEventListener('click', (e)=>{

        if(e.target.localName === 'li'){

            display.displaySection(e.target);
        }
    })

    // Gestion du formulaire d'informations
    const infoForm = document.querySelector('#s-account2 form');
    infoForm.addEventListener('submit',(event)=>{

        event.preventDefault();

        // Récupère les données du formulaire
        let infoFormData = new FormData(infoForm);
        ajax.setFormData(infoFormData, true);

        // Envoie la requête Ajax
        ajax.updateProfile();

    })

    // Gestion du formulaire de mot de passe
    const pswForm = document.querySelector('#s-account3 form');
    pswForm.addEventListener('submit',(event)=>{

        event.preventDefault();

        // Récupère les données du formulaire
        ajax.setFormData(pswForm);

        // Envoie la requête Ajax
        ajax.updatePassword();

    })

    // Gestion du formulaire de suppression de compte
    const delForm = document.querySelector('#s-account4 form');
    delForm.addEventListener('submit',(event)=>{

        event.preventDefault();

        // Récupère les données du formulaire
        ajax.setFormData(delForm);

        // Envoie la requête Ajax
        ajax.deleteAccount();
        // asyncDeleteAccount();
    })
})