// Importation des classes
import Ajax from './class/Ajax.js';
import Display from './class/Display.js';
import StripePayment from './class/StripePayment.js';

document.addEventListener("DOMContentLoaded",()=>{

    const ajax = new Ajax();
    const display = new Display();

    // Evènements quand on clique sur des liens
    document.addEventListener('click',(e)=>{

        if(e.target.localName === 'a'){

            // Liens pour afficher les commandes
            if(e.target.dataset.order !== undefined && e.target.dataset.total === undefined){

                // Vérifie si la commande est payée
                const paid = (e.target.dataset.status === 'unpaid') ? false : true ;

                // Vérifie si l'affichage de la commande est déjà prêt
                let article = document.getElementById('order' + e.target.dataset.order);

                if(article === null){

                    // Création de l'article
                    article = document.createElement('article');
                    article.id = 'order' + e.target.dataset.order;

                    // Récupération de l'ID du produit
                    const formData = new FormData();
                    formData.append('orderID', e.target.dataset.order);

                    // Envoie de la requête Ajax
                    const promise = ajax.fetchOrderDetails(formData);
                    promise.then(orderDetails => {
                        
                        article.innerHTML = display.displayOrder(orderDetails, !paid).innerHTML;
                        e.target.parentNode.insertBefore(article, e.target.nextSibling);
                    })

                }else{

                    // Cache la commande si elle est affichée
                    article.classList.toggle('none');
                }
            }

            // Liens pour payer les commandes
            if(e.target.dataset.total !== undefined){

                // Affichage du formulaire de paiement
                const stripe = new StripePayment();
                stripe.displayForm(document.querySelector('main'));

                // On gère la saisie
                stripe.card.addEventListener('change', (event)=>{

                    if(event.error){
                        stripe.errors.textContent = event.error.message;
                    }else{
                        stripe.errors.textContent = '';
                    }
                })

                // On gère le paiement
                stripe.Btn.addEventListener('click', ()=>{

                    stripe.handlePayment(e.target.dataset.total, e.target.dataset.order)
                    .then(redirect => {

                        // Recharge la page
                        window.location.replace(redirect);
                    })
                })
            }
        }
    })
})
