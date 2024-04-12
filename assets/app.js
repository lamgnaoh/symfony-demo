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

// enable select2
jQuery(document).ready(function (){
    $('.select2-enable').select2({
        ajax: {
            url:'/api/category',
            data: (params) => {
                return {
                    name: params.term
                }
            },
            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        },
        minimumInputLength: 3 // only start searching when the user has input 3 or more characters
    });
})



console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
