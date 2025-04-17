(function(){
    'use strict';
    let show_click  = -1;
    let noclick = 1;

    document.getElementById('menu').classList.add('hidden-menu');

    document.getElementById('menubtn').addEventListener('click', function(e){
        e.preventDefault();

        if(show_click == -1){
            document.getElementById('menu').classList.remove('hidden-menu');
            document.getElementById('profile-logout').classList.add('show-logout');
            noclick = 0;
            show_click*= -1;
        }else{
            document.getElementById('menu').classList.add('hidden-menu');
            document.getElementById('profile-logout').classList.remove('show-logout');
            show_click*= -1;
        };
    })
}());