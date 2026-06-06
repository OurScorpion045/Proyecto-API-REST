const apiUrl = "http://localhost/Proyecto-API-REST/api/index.php/citas";

const citas = document.getElementById("citas");

function makeCard (cita) {
    const [citaId, Estado, Fecha, HoraFin, HoraInicio, Motivo, PacienteId] = cita;
    const table = document.createElement("table");
    
}

async function getCitas() {
    try {
        const response = await fetch(apiUrl, {method: "GET"});
        const results = await response.json();

        console.log(results);
    } catch (error) {
        console.log(error);
    }
}

getCitas();