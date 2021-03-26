export default class LocalStorage{

    saveData(name, data){

        // Sérialisation
        const jsonData = JSON.stringify(data);

        // Stockage dans le local storage
        window.localStorage.setItem(name, jsonData);

        return data;
    }

    loadData(name){

        // Récuperation des données sous forme JSON
        const jsonData = window.localStorage.getItem(name);
    
        // Désérialisation
        return JSON.parse(jsonData);
    }

    removeData(name){

        // Supprime l'objet demandé
        window.localStorage.removeItem(name);
    }

    clearStorage(){

        // Vide le local storage
        window.localStorage.clear();
    }
}