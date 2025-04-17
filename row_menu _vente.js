(function(){
    'use strict';
    let rowButtons = document.getElementsByClassName('row-menu-btn');
    let rowMenus = document.getElementsByClassName('row-menu-container');
    let closeButtons = document.getElementsByClassName('close-btn');

    rowButtons = Array.from(rowButtons);
    rowMenus = Array.from(rowMenus);
    closeButtons = Array.from(closeButtons);

    closeButtons.forEach(closeButton => {      
        closeButton.addEventListener('click', function(e){
            e.preventDefault();

            rowMenus.forEach(rowMenu => {                      
                rowMenu.classList.remove('vente-row-menu');
            })
        })
    });
    rowButtons.forEach(rowButton => {      
        let btnRowMenu =  rowButton.getAttribute('mymenu');
        rowButton.addEventListener('click', function(e){
            e.preventDefault();

            rowMenus.forEach(rowMenu => {
                if(rowMenu.getAttribute('menu') == btnRowMenu){
                    if(!rowMenu.classList.contains('vente-row-menu')){
                        rowMenu.classList.add('vente-row-menu');
                    } else {                        
                        rowMenu.classList.remove('vente-row-menu');
                    }
                } else {
                    rowMenu.classList.remove('vente-row-menu');
                }
            })
        })
    });
}());