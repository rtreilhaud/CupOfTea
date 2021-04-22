export default class Display{

    displaySection(target){

        // Récupère le précédent onglet actif
        const active = document.querySelector('.active');

        // Cache la section précédente
        document.querySelector(`#s-${active.id}`).classList.add('none');

        // Affiche la nouvelle section
        document.querySelector(`#s-${target.id}`).classList.remove('none');

        // Supprime le contenu de la div 'message'
        document.getElementById('message').innerHTML = '';
        
        // Remplace l'onglet actif
        active.classList.remove('active');
        target.classList.add('active');
    }

    // Calcule le prix selon la quantité du produit voulue
    calculateTotal(quantity, price){

        // Multiplie la quantité voulue par le prix d'un produit
        return quantity * price
    }

    // Transforme le prix en chaîne de caractères
    displayPrice(price){

        // Fixe le prix à max 2 chiffres après la virgule
        price = Number(price).toFixed(2);

        // Transforme en chaîne de caractères pour l'afficher
        let strTotal = String(price).replace('.',',');

        // Ajoute les zéros et le signe €
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

    displayProductLine(id, name, quantity, price, delBtn = false){

        // Création de l'élément
        const p = document.createElement('p');
        p.textContent = `${quantity} x ` ;

        // Lien pour voir le produit
        const aItem = document.createElement('a');
        aItem.href = `index.php?page=product&pID=${id}`;
        aItem.textContent = name;
        aItem.classList.add('productLink');

        // Affichage du prix unitaire
        const spanPrice = document.createElement('span');
        spanPrice.textContent = ` (Unité : ${this.displayPrice(price)}) `

        // Prix du sous-total
        const spanTotal = document.createElement('span');
        const total = this.calculateTotal(quantity, price);
        spanTotal.textContent = '= ' + this.displayPrice(total);
        spanTotal.classList.add('float-right');

        if(delBtn){

            // Lien pour supprimer l'élément
            const aDel = document.createElement('a');
            aDel.textContent = ' Supprimer';
            aDel.dataset.name = name;

            // Constitution de l'élément
            p.append(aItem, spanPrice, aDel, spanTotal);

        }else{

            // Construction de l'élément
            p.append(aItem, spanPrice, spanTotal);
        }
        
        return p;
    }

    displayOrder(order, payBtn = false){

        // Création de l'article
        const article = document.createElement('article');

        // Création de la liste
        const ul = document.createElement('ul');
        ul.classList.add('clear');

        // Total du panier
        let total = 0;

        // Parcours les produits de la commande
        for(const item of order){

            // Création de l'élément
            const li = document.createElement('li');
            li.innerHTML = this.displayProductLine(item.product_id, item.product_name, item.quantity, item.unit_price).innerHTML;
            
            // Ajout de l'élément à la liste
            ul.appendChild(li);

            // Ajout du prix au total
            total += this.calculateTotal(item.quantity, item.unit_price);
        }

         // Affichage du total du panier
         const pTotal = document.createElement('p');
         pTotal.textContent = `Total = ${this.displayPrice(total)}`;
         pTotal.classList.add('total');

        // Construction de l'article
        article.append(ul, pTotal);

        // Ajout d'un bouton pour payer
        if(payBtn){

            // Création du bouton
            const aPay = document.createElement('a');
            aPay.classList.add('btn');
            aPay.textContent = 'Payer';
            aPay.id = 'payBtn';
            aPay.dataset.order = order[0].order_id;
            aPay.dataset.total = total;

            // Ajouter à l'article
            article.append(aPay)
        }

        return article;
    }

    displayStripeForm(location = null, total = null){

        // Formulaire
        const form = document.createElement('form');
        form.method = 'post';
        form.id = 'cardForm';

        // Montant à payer
        if(total !== null){

            const amount = document.createElement('p');
            amount.textContent = `Montant à payer : ${this.displayPrice(total)}`;
            form.appendChild(amount);
        }
        
        // Titulaire de la carte
        const cardName = document.createElement('input');
        cardName.type = 'text';
        cardName.id = 'cardName';
        cardName.placeholder = 'Titulaire de la carte';

        // Informations de la carte
        const cardElements = document.createElement('div');
        cardElements.id = 'cardElements';

        // Messages d'erreur de paiement
        const cardErrors = document.createElement('p');
        cardErrors.id = 'cardErrors';
        cardErrors.classList.add('error'); 

        // Bouton de paiement
        const cardBtn = document.createElement('button');
        cardBtn.id = 'cardBtn';
        cardBtn.classList.add('btn');
        cardBtn.type = 'button';
        cardBtn.textContent = 'Procéder au paiement';

        // Ajout des éléments au formulaire
        form.append(cardName, cardElements, cardErrors, cardBtn);
        if(location !== null){
            location.appendChild(form);
        }

        return form
    }
}

