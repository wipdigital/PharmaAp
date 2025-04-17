(function(){
    'use strict';
    let show_click  = -1;
    let noclick = 1;

    document.getElementById('menu').classList.add('hidden-menu');
    document.getElementById('profile').classList.add('hidden-menu');
    document.getElementById('pdf').classList.add('hidden-menu');

    document.getElementById('menubtn').addEventListener('click', function(e){
        e.preventDefault();

        if(show_click == -1){
            document.getElementById('menu').classList.remove('hidden-menu');
            document.getElementById('profile').classList.remove('hidden-menu');
            document.getElementById('pdf').classList.remove('hidden-menu');
            noclick = 0;
            show_click*= -1;
        }else{
            document.getElementById('menu').classList.add('hidden-menu');
            document.getElementById('profile').classList.add('hidden-menu');
            document.getElementById('pdf').classList.add('hidden-menu');
            show_click*= -1;
        };
    })
}());