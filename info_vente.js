(function(){
    'use strict';

    let infos;
    let infoDiv = document.getElementById('info-div');
    let infoButtons = document.getElementsByClassName('info-btn');
    let closeInfoButton = document.getElementById('closeInfo-btn');

    let infoVenteID = document.getElementById('info_idVente');
    let infoMedicament = document.getElementById('info_medicament');
    let infoprixUnitaire = document.getElementById('info_prixUnitaire');
    let infoQuantite = document.getElementById('info_quantite');
    let infoDateVente = document.getElementById('info_dateVente');

    closeInfoButton.addEventListener('click', function(e){
        e.preventDefault();
        infoDiv.classList.remove('vente-show-info')
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

                    infoVenteID.setAttribute("value", infos[0]);
                    infoMedicament.setAttribute("value", infos[1]);
                    infoprixUnitaire.setAttribute("value", infos[2]);
                    infoQuantite.setAttribute("value", infos[3]);
                    infoDateVente.setAttribute("value", infos[4]);

                    infoDiv.classList.add('vente-show-info');
                    
                }else {
                    console.log('no data found');
                }
            }
            xhr.open("GET", "info_vente.php?infoID="+infoID);
            xhr.send();
        })
    })
}());