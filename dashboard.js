(function(){
    'use strict';
// --------nav code------
    let doneResizing;
    let page_width;
    let show_click  = -1;
    let noclick = 1;

    document.getElementById('menu').classList.add('hidden-menu');
    document.getElementById('profile').classList.add('hidden-menu');

    document.getElementById('menubtn').addEventListener('click', function(e){
        e.preventDefault();

        if(show_click == -1){
            document.getElementById('menu').classList.remove('hidden-menu');
            document.getElementById('profile').classList.remove('hidden-menu');
            noclick = 0;
            show_click*= -1;
        }else{
            document.getElementById('menu').classList.add('hidden-menu');
            document.getElementById('profile').classList.add('hidden-menu');
            show_click*= -1;
        };
    })

    // ----Dashboard code
    let info;
    let achats;
    let ventes;
    let achatL;
    let venteL;
    let achatmedicaments;
    let achatquantites;
    let ventemedicaments;
    let ventequantites;
    let achatcolors;
    let ventecolors;

    const xhr = new XMLHttpRequest();
    xhr.onload = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            const theObject = JSON.parse(this.responseText);
            achats =theObject[0];
            ventes =theObject[1];
            achatL = achats.length;
            venteL= ventes.length;

            achatmedicaments = [];
            for(let i = 0; i < achatL; i++){
                achatmedicaments.push(achats[i][0]+" : "+achats[i][1])
            }
            achatquantites = [];
            for(let i = 0; i < achatL; i++){
                achatquantites.push(achats[i][1])
            }
            achatcolors  = []
            for (let i = 0; i  < achatL; i++){
                achatcolors.push(getRandomHexColor())
            }

            //afficher le chart pour l'achat
            const achatxValues = achatmedicaments;
            const achatyValues = achatquantites;
            const achatbarColors = achatcolors;

            new Chart("achats-chart", {
            type: "doughnut",
            data: {
                labels: achatxValues,
                datasets: [{
                backgroundColor: achatbarColors,
                data: achatyValues
                }]
            },
            options: {
                title: {
                display: true,
                text: "Achats des medicaments"
                }
            }
            });
            //----------------------
            ventemedicaments = [];
            for(let i = 0; i < venteL; i++){
                ventemedicaments.push(ventes[i][0]+" : "+ventes[i][1])
            }
            ventequantites = [];
            for(let i = 0; i < venteL; i++){
                ventequantites.push(ventes[i][1])
            }

            ventecolors  = []
            for (let i = 0; i  < venteL; i++){
                ventecolors.push(getRandomHexColor())
            }
            //afficher le chart pour vente
            const ventexValues = ventemedicaments;
            const venteyValues = ventequantites;
            const ventebarColors = ventecolors;

            new Chart("ventes-chart", {
            type: "doughnut",
            data: {
                labels: ventexValues,
                datasets: [{
                backgroundColor: ventebarColors,
                data: venteyValues
                }]
            },
            options: {
                title: {
                display: true,
                text: "Ventes des medicaments"
                }
            }
            });
            
        }else {
            console.log('no data found');
        }
    }
    xhr.open("POST", "dashboardinfo.php");
    xhr.send();

    function getRandomHexColor() {
        const randomColor = Math.floor(Math.random() * 16777215).toString(16);
        return `#${randomColor.padStart(6, '0')}`;
    }
}());