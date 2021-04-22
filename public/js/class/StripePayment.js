// Importation des classes
import Ajax from './Ajax.js';
import Display from './Display.js';

export default class StripePayment{

    constructor(location = document.querySelector('main'), redirect = 'index.php?page=orders', key = 'pk_test_51IiLCzBLEnZW0sEocoDjWAcQ8L29JTv4v2ZcR3f09dMylLsPZrRmFpZT25vz40djIDcntRRYtNu2lrcSe5zYpVfT00TBnt3opt') {

        // Instanciation des classes
        this.Ajax = new Ajax();
        this.Display = new Display();
        
        // Variables Stripes
        this.stripe = Stripe(key);
        this.elements = this.stripe.elements();
        this.redirect = redirect;

        // Affichage du formulaire de paiement
        this.location = location;
        // this.form = this.displayForm(location);
    }

    // Affichage du formulaire de paiement
    displayForm(location = this.location, formID = 'cardForm'){

        this.form = document.getElementById(formID);

        if(this.form === null){

            this.form = this.Display.displayStripeForm(location);

            if(location !== null){

                this.holderName = document.getElementById('cardName');
                this.cardElements = document.getElementById('cardElements');
                this.errors = document.getElementById('cardErrors');
                this.Btn = document.getElementById('cardBtn');
                this.card = this.elements.create('card', {hidePostalCode: true});
                this.card.mount('#cardElements');
            }
            
            return this.form;

        }else{

            this.form.classList.toggle('none');
        }
    }

    // Cacher le formulaire de paiement
    hideForm(formID = 'cardForm'){

        if(document.getElementById(formID) !== null){

            this.form.classList.add('none');
        }
    }

    // Gère le paiement
    handlePayment(total, orderID, redirect = this.redirect){

        return new Promise((resolve, reject) => {
            this.Ajax.sendPaymentIntent(total)
            .then(clientSecret => {

                this.stripe.handleCardPayment(clientSecret, this.card, {
                    payment_method_data:{
                        billing_details: {name: this.holderName.value}
                    }
                })
                .then(result => {

                    // Gestion des erreurs
                    if(result.error){

                        this.errors.innerText = result.error.message;
                        reject();

                    // S'il n'y a pas d'erreur
                    }else{

                        // Modifie le statut de la commande
                        this.Ajax.updateOrderStatus(orderID, 'ordered');

                        // Redirige / Recharge la page
                        this.redirect = redirect;
                        resolve(this.redirect);
                    }
                })
            })
        })
    }
}