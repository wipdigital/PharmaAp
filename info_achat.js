(function(){
    'use strict';

    let infos;
    let infoDiv = document.getElementById('info-div');
    infoDiv.classList.add('hidden-info');
    let infoButtons = document.getElementsByClassName('info-btn');
    let closeInfoButton = document.getElementById('closeInfo-btn');

    let infoAchatID = document.getElementById('info_idAchat');
    let infoMedicament = document.getElementById('info_medicament');
    let infoDistributeur = document.getElementById('info_distributeur');
    let infoprixUnitaire = document.getElementById('info_prixUnitaire');
    let infoQuantite = document.getElementById('info_quantite');
    let infoDateAchat = document.getElementById('info_dateAchat');

    closeInfoButton.addEventListener('click', function(e){
        e.preventDefault();
        infoDiv.classList.remove('achat-show-info')
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

                    infoAchatID.setAttribute("value", infos[0]);
                    infoMedicament.setAttribute("value", infos[1]);
                    infoDistributeur.setAttribute("value", infos[2]);
                    infoprixUnitaire.setAttribute("value", infos[3]);
                    infoQuantite.setAttribute("value", infos[4]);
                    infoDateAchat.setAttribute("value", infos[5]);

                    infoDiv.classList.add('achat-show-info');
                    
                }else {
                    console.log('no data found');
                }
            }
            xhr.open("GET", "info_achat.php?infoID="+infoID);
            xhr.send();
        })
    })
}());