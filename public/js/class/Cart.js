import LocalStorage from './LocalStorage.js';

export default class Cart{

    constructor(cartName = 'cart', priceElement = document.getElementById('cartTotal'), cartPage = document.getElementById('cartPage')){

        this.LS = new LocalStorage();
        this.cartName = cartName;
        this.cart = this.checkCart(cartName);
        this.total = this.calculateTotalCart(this.cart);
        this.price = priceElement;
        this.page = cartPage;
    }

    // Vérifie si le panier existe déjà
    checkCart(cartName = this.cartName){

        let cart =  this.LS.loadData(cartName);

        if(cart === null){

            cart = this.LS.saveData(cartName,{});
        }

        return cart;
    }

    // Ajoute un élément au panier
    addItem(item, cart = this.cart, cartName = this.cartName){

        // Vérifie si le produit est déjà dans le panier pour ajuster les quantités
        let quantity = 1;
        if(cart[item.name]){

            quantity += cart[item.name].quantity;
        }

        // Forme le produit avec les informations nécessaires
        const product = {name: item.name,
                         id: item.id,
                         price: item.price,
                         stock: item.quantity,
                         quantity: quantity
                        }
        // Ajout le produit au panier
        cart[item.name] = product;

        // Stocke le panier dans le local storage
        this.LS.saveData(cartName, cart);

        // Rafraîchit la valeur du panier
        this.displayTotalPrice(cart);
    }

    // Supprime un élément du panier
    removeItem(itemName, cart = this.cart, cartName = this.cartName){

        // Enlève une itération du produit
        cart[itemName].quantity -= 1

        // S'il n'en reste plus, enlève l'élément du panier
        if(cart[itemName].quantity <= 0){
            delete cart[itemName]
        }
        
        // Met à jour le local storage
        this.LS.saveData(cartName, cart);

        // Réaffiche le panier et le total
        this.displayCart(cart);
        this.displayTotalPrice(cart);
    }

    // Vide le panier
    clearCart(cartName = this.cartName){

        // Supprime le panier du local storage
        this.LS.removeData(cartName);

        // Réinitialise le panier et le total
        this.cart = this.checkCart(cartName);
        this.total = this.calculateTotalCart(this.cart);   
        
        // Recharge la page
        window.location.reload();
    }

    // Calcule le prix selon la quantité du produit voulue
    calculateTotal(item){

        // Multiplie la quantité voulue par le prix d'un produit
        return item.quantity * item.price
    }

    // Calcule le total du panier
    calculateTotalCart(cart = this.cart, total = 0){

        // Vérifie si le panier n'est pas vide
        if(Object.keys(cart).length !== 0){
        
            // Pour chaque élément du produit
            for(const item in cart){
    
                // Multiplie la quantité voulue par le prix
                total += this.calculateTotal(cart[item]);
            }
        }

        // Stocke le total
        this.total = total;
        return total;
    }

    // Affiche les détails du panier
    displayCart(cart = this.cart, page = this.page){

        // Vérifie si le panier est vide
        if(Object.keys(cart).length === 0){

            // Titre et lien de redirection
            page.innerHTML = '<h1> Votre panier est vide </h1>';
            page.innerHTML += '<p><a href="index.php?page=listing"> Consultez nos thés </a></p>';

        // S'il y a des produits dans le panier
        }else{

            // Titre
            page.innerHTML = '<h1> Mon panier </h1>';

            // Création de la liste
            const ul = document.createElement('ul');
            ul.classList.add('clear');

            // Récupère les éléments du panier
            for(const item in cart){

                // Création de l'élément
                const li = document.createElement('li');
                li.textContent = `${cart[item].quantity} x ` ;

                // Lien pour voir le produit
                const aItem = document.createElement('a');
                aItem.href = `index.php?page=product&pID=${cart[item].id}`;
                aItem.textContent = cart[item].name;
                aItem.classList.add('productLink');

                // Affichage du prix unitaire
                const span = document.createElement('span');
                span.textContent = ` (Unité : ${this.displayPrice(cart[item].price, true)}) `
                
                // Lien pour supprimer l'élément
                const aLi = document.createElement('a');
                aLi.textContent = ' Supprimer';
                aLi.dataset.name = item;

                // Prix du sous-total
                const spanLi = document.createElement('span');
                spanLi.textContent = this.displayPrice(cart[item]);
                spanLi.classList.add('float-right');

                // Ajout de l'élément à la liste
                li.append(aItem, span, aLi, spanLi);
                ul.appendChild(li);
            }

            // Affichage du total du panier
            const pTotal = document.createElement('p');
            pTotal.textContent = `Total = ${this.displayTotalPrice()}`;

            // Ajout d'une zone pour les boutons
            const div = document.createElement('div');
            div.classList.add('flex');

            // Ajout d'un bouton pour commander
            const aOrder = document.createElement('a');
            aOrder.classList.add('btn');
            aOrder.textContent = 'Commander';
            aOrder.id = 'orderBtn';

            // Ajout d'un bouton pour vider le panier
            const clearBtn = document.createElement('a');
            clearBtn.classList.add('btn');
            clearBtn.textContent = 'Vider le panier';
            clearBtn.id = 'clearBtn';

            // Affiche la page
            div.append(aOrder, clearBtn);
            page.append(ul, pTotal, div);
        }
    }

    // Transforme le prix en chaîne de caractères
    displayPrice(item, total = false){

        // Si total = true, item correspond au total, sinon il faut le calculer
        total = (total) ? Number(item).toFixed(2) : this.calculateTotal(item).toFixed(2);

        // Transforme en chaîne de caractères pour l'afficher
        let strTotal = String(total).replace('.',',');
        let euro;
        if(strTotal.split(',')[1] === undefined){

            euro = ',00 €';

        }else if(strTotal.split(',')[1].length === 1){

            euro = '0 €';

        }else{

            euro = ' €';
        }

        return strTotal + euro;
    }

    // Affiche le prix total du panier
    displayTotalPrice(cart = this.cart, priceElement = this.price){

        // Vérifie si le panier est vide
        if(Object.keys(cart).length === 0){

            priceElement.textContent = 'Vide';

        // S'il n'est pas vide
        }else{

            // Calcule le total du panier
            const total = this.calculateTotalCart(cart);
            const strTotal = this.displayPrice(total, true);

            // Affiche sur la page
            priceElement.textContent = strTotal;
            return strTotal;
        }
    }
}