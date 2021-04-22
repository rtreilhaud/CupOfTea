import Cart from './Cart.js';

export default class Ajax{

    constructor(form, displayID = 'message'){

        this._form = form;
        this._formData = new FormData(form);
        this._divResult = document.getElementById(displayID);
    }

    // Déclare le formulaire
    setForm(form){

        this._form = form;
    }

    // Déclare les données du formulaire
    setFormData(form, formData = false){

        if(formData){

            this._formData = form;

        }else{

            this._formData = new FormData(form);
        }
    }

    // Envoie le formulaire d'informations pour mettre à jour le profil
    updateProfile(formData = null){

        // Préparation des données à envoyer
        if(formData !== null){

            this._formData = formData;
        }

        // Envoie la requête Ajax
        fetch('index.php?action=updateProfile', {method: 'POST', body: this._formData})
        .then(response => response.json())
        .then(result => {

            // Gestion des messages d'erreur
            if(result.error){

                this._divResult.innerHTML += `<p class="error"> ${result.error} </p>`;
            }

            // Gestion des messages de succès
            if(result.success){

                this._divResult.innerHTML += `<p class="success"> ${result.success} </p>`;
            }    

            // Modifie les valeurs de la page
            for(let i=0; i < result.id.length; i++){

                document.getElementById(result.id[i]).textContent = result.values[i];
            }
        })
    }

    // Envoie le formulaire de mot de passe pour le mettre à jour
    updatePassword(formData = null){

        // Préparation des données à envoyer
        if(formData !== null){

            this._formData = formData;
        }

        // Envoie la requête Ajax
        fetch('index.php?action=updatePassword', {method: 'POST', body: this._formData})
        .then(response => response.json())
        .then(result => {

            // Gestion des messages d'erreur
            if(result.error){

                this._divResult.innerHTML = `<p class="error"> ${result.error} </p>`;
            }

            // Gestion des messages de succès
            if(result.success){

                this._divResult.innerHTML = `<p class="success"> ${result.success} </p>`;
            } 
        })
    }

    // Envoie la requête pour modifier le statut d'une commande
    updateOrderStatus(orderID, newStatus){

        // Préparation des données à envoyer
        this._formData = new FormData();
        this._formData.append('orderID', orderID);
        this._formData.append('status', newStatus);

        // Envoie la requête Ajax
        fetch('index.php?action=updateOrderStatus', {method: 'POST', body: this._formData})
        .then(response => response.json())
        .then(result => {

            // Gestion des messages d'erreur
            if(result.error){

                this._divResult.innerHTML = `<p class="error"> ${result.error} </p>`;
            }
        })
    }

    // Envoie le mot de passe pour supprimer le compte
    deleteAccountAjax(formData = null){

        return new Promise(resolve => {

            // Préparation des données à envoyer
            if(formData !== null){

                this._formData = formData;
            }
    
            // Envoie la requête Ajax
            fetch('index.php?action=deleteAccount', {method: 'POST', body: this._formData})
            .then(response => response.json())
            .then(result => {

                // Gestion des messages d'erreur
                if(result.error){

                    this._divResult.innerHTML = `<p class="error"> ${result.error} </p>`;
                }

                // Gestion des messages de succès
                if(result.success){

                    this._divResult.innerHTML = `<p class="success"> ${result.success} </p>`;
                    resolve(true); // Résolution de la requête
                } 

                resolve(false);
            })
        })
    }

    // Redirige si le compte a bien été supprimé
    async deleteAccount(formData = null){

        const result = await this.deleteAccountAjax(formData);
        if(result){
            window.location.replace('index.php?page=home');
        }
    }

    // Récupère les informations du produit dans la base de données
    fetchProduct(formData = null){

        return new Promise(resolve =>{

            // Préparation des données à envoyer
            if(formData !== null){

                this._formData = formData;
            }
    
            // Envoie la requête Ajax
            fetch('index.php?action=fetchProduct', {method: 'POST', body: this._formData})
            .then(response => response.json())
            .then(result => resolve(result)) // Résolution de la requête
        })
    }   

    // Récupère les informations d'une commande dans la base de données
    fetchOrderDetails(formData = null){

        return new Promise(resolve =>{

            // Préparation des données à envoyer
            if(formData !== null){

                this._formData = formData;
            }
    
            // Envoie la requête Ajax
            fetch('index.php?action=fetchOrderDetails', {method: 'POST', body: this._formData})
            .then(response => response.json())
            .then(result => resolve(result))
        })
    }   

    // Enregistre la commande dans la base de données
    orderCart(cart = new Cart()){

        // Préparation des données à envoyer
        this._formData = new FormData();
        this._formData.append('total', cart.total);
        this._formData.append('cart', JSON.stringify(cart.cart));

        return new Promise((resolve, reject) =>{

            // Envoie la requête Ajax
            fetch('index.php?action=orderCart', {method: 'POST', body: this._formData})
            .then(response => response.json())
            .then(result => {

                // Gestion des messages d'erreur
                if(result.error){

                    this._divResult.innerHTML = `<p class="error"> ${result.error} </p>`;
                    reject();
                }

                // Gestion des messages de succès
                if(result.success){

                    this._divResult.innerHTML = `<p class="success"> ${result.success} </p>`;
                    resolve(result.orderID);
                } 
            })
        })
    }

    // Envoie une intention de paiement à Stripe
    sendPaymentIntent(total){

        // Préparation des données à envoyer
        this._formData = new FormData();
        this._formData.append('total', total);

        return new Promise(resolve =>{

            // Envoie la requête Ajax
            fetch('index.php?action=sendPaymentIntent', {method: 'POST', body: this._formData})
            .then(response => response.json())
            .then(result => {

                // Gestion des messages d'erreur
                if(result.error){

                    this._divResult.innerHTML = `<p class="error"> ${result.error} </p>`;
                }

                // Gestion de l'intention de paiement
                if(result.intent){

                    const cardBtn = document.getElementById('cardBtn');
                    cardBtn.dataset.secret = result.intent.client_secret;
                    resolve(result.intent.client_secret); // Résolution de la requête
                }
            })
        })
    }
}