/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap' // js file of bootstrap

let deleteBtns = document.getElementsByClassName(`delete-btn`);

// const $ = require('jquery');
Array.from(deleteBtns).forEach((deleteBtn) => {
    deleteBtn.addEventListener('click', function (event) {
        event.preventDefault();
        let productId = this.getAttribute('data-id');
        console.log(productId)

        fetch('/product/delete/' + productId, {
            method: 'DELETE'
        }).catch(error => {
            console.log(error);
        });
    });
});




console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
