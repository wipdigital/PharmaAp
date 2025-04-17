(function(){
    'use strict';

    let infos;
    let infoDiv = document.getElementById('info-div');
    let infoButtons = document.getElementsByClassName('info-btn');
    let closeInfoButton = document.getElementById('closeInfo-btn');

    let infoMedicamentID = document.getElementById('info_idMedicament');
    let infoNom = document.getElementById('info_nom');

    closeInfoButton.addEventListener('click', function(e){
        e.preventDefault();
        infoDiv.classList.remove('medicament-show-info')
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

                    infoMedicamentID.setAttribute("value", infos[0]);
                    infoNom.setAttribute("value", infos[1]);

                    infoDiv.classList.add('medicament-show-info');
                    
                }else {
                    console.log('no data found');
                }
            }
            xhr.open("GET", "info_medicament.php?infoID="+infoID);
            xhr.send();
        })
    })
}());