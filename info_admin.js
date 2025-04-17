(function(){
    'use strict';

    let infos;
    let infoDiv = document.getElementById('info-div');
    let infoButtons = document.getElementsByClassName('info-btn');
    let closeInfoButton = document.getElementById('closeInfo-btn');

    let infoAdminID = document.getElementById('info_idAdmin');
    let infoNom = document.getElementById('info_nom');
    let infoPrenom = document.getElementById('info_prenom');
    let infoEmail = document.getElementById('info_email');
    let infoNiveau = document.getElementById('info_niveau');

    closeInfoButton.addEventListener('click', function(e){
        e.preventDefault();
        infoDiv.classList.remove('admin-show-info')
    })

    infoButtons = Array.from(infoButtons);

    infoButtons.forEach(infoButton => {

        infoButton.addEventListener('click', function(e){
            let infoID;
            e.preventDefault()

            infoID = infoButton.getAttribute('infoID');

            const xhr = new XMLHttpRequest();
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const theObject = JSON.parse(this.responseText);
                    infos =theObject[0][0];
                    infos=Array.from(infos);

                    infoAdminID.setAttribute("value", infos[0]);
                    infoNom.setAttribute("value", infos[1]);
                    infoPrenom.setAttribute("value", infos[2]);
                    infoEmail.setAttribute("value", infos[3]);
                    infoNiveau.setAttribute("value", infos[4]);

                    infoDiv.classList.add('admin-show-info');
                    
                }else {
                    console.log('no data found');
                }
            }
            xhr.open("GET", "info_admin.php?infoID="+infoID);
            xhr.send();
        })
    })
}());