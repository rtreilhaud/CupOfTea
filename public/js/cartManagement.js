// Importation des classes
import Cart from './class/Cart.js';
import Ajax from './class/Ajax.js';
import StripePayment from './class/StripePayment.js';

document.addEventListener('DOMContentLoaded',()=>{

    // Instanciation des classes
    const cart = new Cart();
    const ajax = new Ajax();

    // Affichage du prix du panier
    cart.displayTotalPrice();

    // Récupération des informations du produit ('Ajouter au panier' sur page product)
    const cartForm = document.getElementById('cartForm');
    if(cartForm !== null){

        cartForm.addEventListener('submit',(e)=>{

            e.preventDefault();

            const promise = ajax.fetchProduct(new FormData(cartForm));
            promise.then(product => {

                cart.addItem(product);
            })
        })
    }

    // Affichage du détail du panier
    const cartPage = document.getElementById('cartPage');
    if(cartPage !== null){

        cart.displayCart();
    }

    // Boutons pour supprimer des éléments du panier
    document.addEventListener('click',(e)=>{

        if(e.target.localName === 'a' && e.target.dataset.name !== undefined){

            cart.removeItem(e.target.dataset.name);
        }
    })

    // Bouton pour commander
    const orderBtn = document.getElementById('orderBtn');
    if(orderBtn !== null){

        orderBtn.addEventListener('click', ()=> {

            // Envoie la commande
            const promise = ajax.orderCart();

            // Affichage du formulaire de paiement
            const stripe = new StripePayment();
            stripe.displayForm(document.querySelector('main'), cart.total);

            // On gère la saisie
            stripe.card.addEventListener('change', (event)=>{

                if(event.error){
                    stripe.errors.textContent = event.error.message;
                }else{
                    stripe.errors.textContent = '';
                }
            })

            // Paiement de la commande
            promise.then(orderID => {

                // Sauvegarde le montant total du panier
                const totalPrice = cart.total;

                // Vide la panier (sans recharger la page)
                cart.clearCart('cart', false);

                stripe.Btn.addEventListener('click', ()=>{

                    stripe.handlePayment(totalPrice, orderID)
                    .then(redirect => {

                        // Redirige vers la page 'Mes commandes'
                        window.location.replace(redirect);
                    })
                })
            })
        })
    }

    // Bouton pour vider le panier
    const clearBtn = document.getElementById('clearBtn');
    if(clearBtn !== null){

        clearBtn.addEventListener('click', ()=> cart.clearCart());
    }
})


