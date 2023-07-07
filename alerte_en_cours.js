let sortOrderDate = 'asc'; // Par défaut, tri croissant
let sortOrderTime = 'asc'; // Par défaut, tri croissant
let sortOrderServices = 'asc'; // Par défaut, tri croissant pour les services

    function toggleDetails(id) {
        let impact = document.getElementById('impact_' + id);
        let actionsPrevues = document.getElementById('actions_prevues_' + id);
        let equipesMobilisees = document.getElementById('equipes_mobilisees_' + id);
        let responsables = document.getElementById('responsables_' + id);
        let thImpact = document.getElementById('th_impact');
        let thActionsPrevues = document.getElementById('th_actions_prevues');
        let thEquipesMobilisees = document.getElementById('th_equipes_mobilisees');
        let thResponsables = document.getElementById('th_responsables');

        if (impact.style.display === 'none') { // Correction ici
            impact.style.display = 'table-cell';
            actionsPrevues.style.display = 'table-cell';
            equipesMobilisees.style.display = 'table-cell';
            responsables.style.display = 'table-cell';
            thImpact.style.display = 'table-cell';
            thActionsPrevues.style.display = 'table-cell';
            thEquipesMobilisees.style.display = 'table-cell';
            thResponsables.style.display = 'table-cell';
        } else {
            impact.style.display = 'none';
            actionsPrevues.style.display = 'none';
            equipesMobilisees.style.display = 'none';
            responsables.style.display = 'none';
            thImpact.style.display = 'none';
            thActionsPrevues.style.display = 'none';
            thEquipesMobilisees.style.display = 'none';
            thResponsables.style.display = 'none';
        }
    }

    function toggleData() {
        let dataContainer = document.getElementById("dataContainer");
        if (dataContainer.style.display === "none") {
            dataContainer.style.display = "block";
        } else {
            dataContainer.style.display = "none";
        }
    }

    function addEndDate(id) {
        let endDate = prompt("Entrez la date de fin (AAAA-MM-JJ) :");
        if (endDate !== null) {
            let endTime = prompt("Entrez l'heure de fin (HH:MM) :");
            if (endTime !== null) {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('endDate', endDate);
                formData.append('endTime', endTime);

                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_end_date.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert("Date de fin et heure de fin ajoutées : " + endDate + " " + endTime);
                        // Supprimer toutes les alertes du conteneur
                        let dataContainer = document.getElementById("dataContainer");
                        dataContainer.innerHTML = '';
                    } else {
                        alert("Une erreur s'est produite lors de l'ajout de la date de fin. Veuillez réessayer.");
                    }
                };
                xhr.onerror = function () {
                    alert("Une erreur s'est produite lors de l'ajout de la date de fin. Veuillez réessayer.");
                };
                xhr.send(formData);
            }
        }
    }

    function sortTableByDate() {
        let table = document.getElementById("dataContainer");
        let rows = Array.from(table.getElementsByTagName("tr"));
      
        rows.sort(function(a, b) {
          let dateA = new Date(a.cells[0].innerHTML);
          let dateB = new Date(b.cells[0].innerHTML);
      
          if (sortOrderDate === 'asc') {
            return dateA - dateB; // Tri croissant
          } else {
            return dateB - dateA; // Tri décroissant
          }
        });
      
        // Inversez l'ordre de tri pour le prochain clic
        sortOrderDate = (sortOrderDate === 'asc') ? 'desc' : 'asc';
      
        // Réorganisez les lignes du tableau selon l'ordre trié
        for (let i = 0; i < rows.length; i++) {
          table.appendChild(rows[i]);
        }
      
        // Mettez à jour le bouton de tri en fonction de l'ordre actuel
        let btnTriAsc = document.getElementById("btnTriDateAsc");
        let btnTriDesc = document.getElementById("btnTriDateDesc");
      
        btnTriAsc.classList.toggle("active", sortOrderDate === 'asc');
        btnTriDesc.classList.toggle("active", sortOrderDate === 'desc');
      }     
      
    function sortTableByTime() {
        let table = document.getElementById("dataContainer"); // Identifiez le conteneur du tableau
        let rows = Array.from(table.getElementsByTagName("tr")); // Obtenez toutes les lignes du tableau
      
        rows.sort(function(a, b) {
          let timeA = getTimeInSeconds(a.cells[1].innerHTML); // Obtenez l'heure en secondes de la deuxième cellule de la ligne a
          let timeB = getTimeInSeconds(b.cells[1].innerHTML); // Obtenez l'heure en secondes de la deuxième cellule de la ligne b
      
          if (sortOrderTime === 'asc') {
            return timeA - timeB; // Tri croissant
          } else {
            return timeB - timeA; // Tri décroissant
          }
        });
      
        // Inversez l'ordre de tri pour le prochain clic
        sortOrderTime = (sortOrderTime === 'asc') ? 'desc' : 'asc';
      
        // Réorganisez les lignes du tableau selon l'ordre trié
        for (let i = 0; i < rows.length; i++) {
          table.appendChild(rows[i]);
        }
      }
      
    function getTimeInSeconds(timeString) {
        let timeParts = timeString.split(":"); // Divisez la chaîne de l'heure en parties (heures, minutes, secondes)
        let hours = parseInt(timeParts[0]);
        let minutes = parseInt(timeParts[1]);
        let seconds = parseInt(timeParts[2]);
      
        return hours * 3600 + minutes * 60 + seconds; // Convertissez l'heure en secondes
      }

    function sortTableByServices() {
        let table = document.getElementById("dataContainer"); // Identifiez le conteneur du tableau
        let rows = Array.from(table.getElementsByTagName("tr")); // Obtenez toutes les lignes du tableau
      
        // Exclure la première ligne (titre) du tri en utilisant slice()
        let rowsToSort = rows.slice(1);
      
        rowsToSort.sort(function(a, b) {
          let serviceA = a.cells[2].innerHTML.toLowerCase(); // Obtenez le service de la troisième cellule de la ligne a
          let serviceB = b.cells[2].innerHTML.toLowerCase(); // Obtenez le service de la troisième cellule de la ligne b
      
          if (sortOrderServices === 'asc') {
            return serviceA.localeCompare(serviceB); // Tri croissant
          } else {
            return serviceB.localeCompare(serviceA); // Tri décroissant
          }
        });
      
        // Inversez l'ordre de tri pour le prochain clic
        sortOrderServices = (sortOrderServices === 'asc') ? 'desc' : 'asc';
      
        // Réorganisez les lignes triées en incluant la première ligne (titre)
        let sortedRows = [rows[0], ...rowsToSort];
      
        // Réorganisez les lignes du tableau selon l'ordre trié
        for (let i = 0; i < sortedRows.length; i++) {
          table.appendChild(sortedRows[i]);
        }
      }