(function(){
    'use strict';
    let infos;
    let infoDiv = document.getElementById('info-div');
    let infoButtons = document.getElementsByClassName('info-btn');
    let closeInfoButton = document.getElementById('closeInfo-btn');

    let infoMedicament = document.getElementById('info_medicament');
    let infoQuantite = document.getElementById('info_quantite');

    closeInfoButton.addEventListener('click', function(e){
        e.preventDefault();
        infoDiv.classList.remove('stock-show-info')
    })

    infoButtons = Array.from(infoButtons);
    
    infoButtons.forEach(infoButton => {

        infoButton.addEventListener('click', function(e){
            let infoID;
            e.preventDefault()

            infoID = infoButton.getAttribute('infoID');

            console.log("Getting infos...2");

            const xhr = new XMLHttpRequest();
            xhr.onload = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    const theObject = JSON.parse(this.responseText);
                    infos =theObject[0][0];
                    infos=Array.from(infos);

                    infoMedicament.setAttribute("value", infos[0]);
                    infoQuantite.setAttribute("value", infos[1]);

                    infoDiv.classList.add('stock-show-info');
                    
                }else {
                    console.log('no data found');
                }
            }
            xhr.open("GET", "info_stock.php?infoID="+infoID);
            xhr.send();
        })
    })
}());