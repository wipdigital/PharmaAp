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
                rowMenu.classList.remove('admin-row-menu');
            })
        })
    });
    rowButtons.forEach(rowButton => {      
        let btnRowMenu =  rowButton.getAttribute('mymenu');
        rowButton.addEventListener('click', function(e){
            e.preventDefault();

            rowMenus.forEach(rowMenu => {
                if(rowMenu.getAttribute('menu') == btnRowMenu){
                    if(!rowMenu.classList.contains('admin-row-menu')){
                        rowMenu.classList.add('admin-row-menu');
                    } else {                        
                        rowMenu.classList.remove('admin-row-menu');
                    }
                } else {
                    rowMenu.classList.remove('admin-row-menu');
                }
            })
        })
    });
}());