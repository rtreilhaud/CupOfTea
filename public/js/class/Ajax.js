export default class Ajax{

    constructor(form){

        this._form = form;
        this._formData = new FormData(form);
        this._divResult = document.getElementById('message');
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

        if(formData !== null){

            this._formData = formData;

        }

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

        if(formData !== null){

            this._formData = formData;

        }

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

    // Envoie le mot de passe pour supprimer le compte
    deleteAccountAjax(formData = null){

        return new Promise(resolve => {

            if(formData !== null){

                this._formData = formData;
    
            }
    
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
                    resolve(true);
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

            if(formData !== null){

                this._formData = formData;
    
            }
    
            fetch('index.php?action=fetchProduct', {method: 'POST', body: this._formData})
            .then(response => response.json())
            .then(result => resolve(result))
        })
    }   
}