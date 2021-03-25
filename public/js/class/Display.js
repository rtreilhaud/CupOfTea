export default class Display{

    constructor(){

        this.active = document.querySelector('.active');
    }

    displaySection(target){

        // Hide the previous section
        document.querySelector(`#s-${this.active.id}`).classList.add('none');

        // Display the new section
        document.querySelector(`#s-${target.id}`).classList.remove('none');

        // Erase the message div
        document.getElementById('message').innerHTML = '';
        
        // Replace the active tab
        this.active.classList.remove('active');
        target.classList.add('active');
        this.active = target;
    }
}

