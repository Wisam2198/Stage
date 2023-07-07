let sortOrderDate = 'asc'; // Par défaut, tri croissant
let sortOrderTime = 'asc'; //Par défaut, tri croissant
let sortOrderServices = 'asc'; //Par défaut, tri croissant
let sortOrderLocalisation = 'asc'; //Par défaut, tri croissant
let sortOrderDateFin = 'asc'; //Pareil qu'au dessus
let sortOrderTimeFin = 'asc'; //""""


function toggleDetails(id) {
    let dateFin = document.getElementById('date_fin_' + id);
    let heureFin = document.getElementById('heure_fin_' + id);
    let impact = document.getElementById('impact_' + id);
    let actionsPrevues = document.getElementById('actions_prevues_' + id);
    let equipesMobilisees = document.getElementById('equipes_mobilisees_' + id);
    let responsables = document.getElementById('responsables_' + id);
    let thDateFin = document.getElementById('th_date_fin');
    let thHeureFin = document.getElementById('th_heure_fin');
    let thImpact = document.getElementById('th_impact');
    let thActionsPrevues = document.getElementById('th_actions_prevues');
    let thEquipesMobilisees = document.getElementById('th_equipes_mobilisees');
    let thResponsables = document.getElementById('th_responsables');

    if (dateFin.style.display === 'none') {
        dateFin.style.display = 'table-cell';
        heureFin.style.display = 'table-cell';
        impact.style.display = 'table-cell';
        actionsPrevues.style.display = 'table-cell';
        equipesMobilisees.style.display = 'table-cell';
        responsables.style.display = 'table-cell';
        thDateFin.style.display = 'table-cell';
        thHeureFin.style.display = 'table-cell';
        thImpact.style.display = 'table-cell';
        thActionsPrevues.style.display = 'table-cell';
        thEquipesMobilisees.style.display = 'table-cell';
        thResponsables.style.display = 'table-cell';
    } else {
        dateFin.style.display = 'none';
        heureFin.style.display = 'none';
        impact.style.display = 'none';
        actionsPrevues.style.display = 'none';
        equipesMobilisees.style.display = 'none';
        responsables.style.display = 'none';
        thDateFin.style.display = 'none';
        thHeureFin.style.display = 'none';
        thImpact.style.display = 'none';
        thActionsPrevues.style.display = 'none';
        thEquipesMobilisees.style.display = 'none';
        thResponsables.style.display = 'none';
    }
}

function sortTableByDate() {
    let table = document.getElementById("dataContainer"); // Identifiez le conteneur du tableau
    let rows = Array.from(table.getElementsByTagName("tr")); // Obtenez toutes les lignes du tableau
  
    rows.sort(function(a, b) {
      let dateA = new Date(a.cells[0].innerHTML); // Obtenez la date de la première cellule de la ligne a
      let dateB = new Date(b.cells[0].innerHTML); // Obtenez la date de la première cellule de la ligne b
  
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

function sortTableByLocalisation() {
    let table = document.getElementById("dataContainer"); // Identifiez le conteneur du tableau
    let rows = Array.from(table.getElementsByTagName("tr")); // Obtenez toutes les lignes du tableau
  
    // Exclure la première ligne (titre) du tri en utilisant slice()
    let rowsToSort = rows.slice(1);
  
    rowsToSort.sort(function(a, b) {
      let serviceA = a.cells[2].innerHTML.toLowerCase(); // Obtenez le service de la troisième cellule de la ligne a
      let serviceB = b.cells[2].innerHTML.toLowerCase(); // Obtenez le service de la troisième cellule de la ligne b
  
      if (sortOrderLocalisation === 'asc') {
        return serviceA.localeCompare(serviceB); // Tri croissant
      } else {
        return serviceB.localeCompare(serviceA); // Tri décroissant
      }
    });
  
    // Inversez l'ordre de tri pour le prochain clic
    sortOrderLocalisation = (sortOrderLocalisation === 'asc') ? 'desc' : 'asc';
  
    // Réorganisez les lignes triées en incluant la première ligne (titre)
    let sortedRows = [rows[0], ...rowsToSort];
  
    // Réorganisez les lignes du tableau selon l'ordre trié
    for (let i = 0; i < sortedRows.length; i++) {
      table.appendChild(sortedRows[i]);
    }
  }

  function sortTableByDateFin() {
    let table = document.getElementById("dataContainer"); // Identifiez le conteneur du tableau
    let rows = Array.from(table.getElementsByTagName("tr")); // Obtenez toutes les lignes du tableau
  
    rows.sort(function(a, b) {
      let dateA = new Date(a.cells[0].innerHTML); // Obtenez la date de la première cellule de la ligne a
      let dateB = new Date(b.cells[0].innerHTML); // Obtenez la date de la première cellule de la ligne b
  
      if (sortOrderDateFin === 'asc') {
        return dateA - dateB; // Tri croissant
      } else {
        return dateB - dateA; // Tri décroissant
      }
    });
  
    // Inversez l'ordre de tri pour le prochain clic
    sortOrderDateFin = (sortOrderDateFin === 'asc') ? 'desc' : 'asc';
  
    // Réorganisez les lignes du tableau selon l'ordre trié
    for (let i = 0; i < rows.length; i++) {
      table.appendChild(rows[i]);
    }
  } 

  function sortTableByHeureFin() {
    let table = document.getElementById("dataContainer"); // Identifiez le conteneur du tableau
    let rows = Array.from(table.getElementsByTagName("tr")); // Obtenez toutes les lignes du tableau
  
    rows.sort(function(a, b) {
      let timeA = getTimeInSeconds(a.cells[1].innerHTML); // Obtenez l'heure en secondes de la deuxième cellule de la ligne a
      let timeB = getTimeInSeconds(b.cells[1].innerHTML); // Obtenez l'heure en secondes de la deuxième cellule de la ligne b
  
      if (sortOrderTimeFin === 'asc') {
        return timeA - timeB; // Tri croissant
      } else {
        return timeB - timeA; // Tri décroissant
      }
    });
  
    // Inversez l'ordre de tri pour le prochain clic
    sortOrderTimeFin = (sortOrderTimeFin === 'asc') ? 'desc' : 'asc';
  
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