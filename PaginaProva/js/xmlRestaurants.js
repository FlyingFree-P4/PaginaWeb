window.addEventListener("load", inici, false);

function inici(){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    lecturaxml(this);
		    }
		};
		xhttp.open("GET", "xml/restaurants.xml", true);
		xhttp.send();
}

function lecturaxml(xml) {

    var xmlDoc = xml.responseXML;

    var seccio = document.getElementsByName("prods");

    for (var i = 0; i < xmlDoc.getElementsByTagName("restaurant").length; i++) {

        id = xmlDoc.getElementsByTagName("restaurant")[i].getAttribute('id');

        nom = xmlDoc.getElementsByTagName("nom")[i].childNodes[0].nodeValue;

        desti = xmlDoc.getElementsByTagName("desti")[i].childNodes[0].nodeValue;

        descripcio = xmlDoc.getElementsByTagName("descripcio")[i].childNodes[0].nodeValue;

        persones = xmlDoc.getElementsByTagName("persones")[i].childNodes[0].nodeValue;

        dia = xmlDoc.getElementsByTagName("dia")[i].childNodes[0].nodeValue;

        hora = xmlDoc.getElementsByTagName("hora")[i].childNodes[0].nodeValue;

        preu = xmlDoc.getElementsByTagName("preu")[i].childNodes[0].nodeValue;



        seccio[0].innerHTML += "<div id="+ id +" class='producte'>" +
            "<h3>" + nom + "</h3>" +
            "<h5>" + desti + "</h5>" +
            "<p>" + descripcio + "</p>" +
            "<h6>" + persones + "</h6>" +
            "<h7>" + dia + "</h7>" +
            "<h8>" + hora + "</h8>" +
            "<h10>" + preu + "€</h10>" +
            "<input type='button' value='Afegir' class='add'></div>";
        
    }

    trobarID();
   
}

function trobarID() {
    let botons = document.getElementsByClassName('add');
    for (let index = 0; index < botons.length; index++) {
        let botoClicat = botons[index]
        botoClicat.addEventListener('click', function (event) {
            let botoE = event.target
            let pare = botoE.parentElement
            id = pare.getAttributeNode('id').value;
            afegirProducte();
        })
    }
} 

function afegirProducte() {
    var producte = document.getElementById(id);

    var nom = producte.childNodes[0].textContent;
    var desti = producte.childNodes[1].textContent;
    var descripcio = producte.childNodes[2].textContent;
    var persones = producte.childNodes[3].textContent;
    var dia = producte.childNodes[4].textContent;
    var hora = producte.childNodes[5].textContent;
    var preu = producte.childNodes[6].textContent;

    clau = localStorage.length + 1;
        var obj = {
            nom: nom,
            desti: desti,
            descripcio: descripcio,
            persones: persones,
            dia: dia,
            hora: hora,
            preu: preu
        }

    var myJSON = JSON.stringify(obj);
    localStorage.setItem(clau, myJSON);
}