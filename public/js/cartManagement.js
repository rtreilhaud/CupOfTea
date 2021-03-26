// Importation des classes
import Cart from './class/Cart.js';
import Ajax from './class/Ajax.js';

let product;

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

    // Bouton pour vider le panier
    const clearBtn = document.getElementById('clearBtn');
    if(clearBtn !== null){

        clearBtn.addEventListener('click', ()=> cart.clearCart());
    }
})


