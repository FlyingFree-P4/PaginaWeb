window.addEventListener("load", llegirProds(), false);

        function llegirProds() {
            for (i = 0; i < localStorage.length; i++) {
                var clau = localStorage.key(i);
                var dadescaro = localStorage.getItem(clau);
                var obj = JSON.parse(dadescaro);
                document.getElementById("caro").innerHTML += "<tr>" +
                    "<td class='bordelist'>" + obj.nom + "</td>" +
                    "<td class='bordelist'>" + obj.desti + "</td>" +
                    "<td class='bordelist'>" + obj.preu + "</td>" +
                    "<td><a class='remove'><i class='fa fa-close'></i></a></td>" +
                    "</tr>";
                eliminarProd(clau);
                eliminarTotsProds();



            }

        }

        function eliminarProd(clau) {
            var prodcaro = document.getElementsByClassName("remove");
            for (i = 0; i < prodcaro.length; i++) {
                prodcaro[i].addEventListener("click", function(e) {
                    localStorage.removeItem(clau);

                }, false);
            }
        }

        function eliminarTotsProds() {
            var boraraTot = document.getElementById("removeall");
            boraraTot.addEventListener("click", function(e) {
                localStorage.clear();

            }, false);
        }
        function finalitzar() {
            var bAcabar = document.getElementById("finish");
            boraraTot.addEventListener("click", function(e) {
                console.log("klk");

            }, false);
        }