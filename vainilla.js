
////////////// Ventas
function cambio_total(){
  var total_g=$("#total_g").val();
  var efectivo_g=$("#efectivo_g").val();
  var total=(efectivo_g-total_g)*100;
  $("#cambio_g").val(Math.round(total)/100);
}
function calendar_load(tipo){
  var fecha = new Date();
  var final="";

  $('#trabajo').html("");
  var calendarEl = document.getElementById('trabajo');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    editable: true,
    defaultView: 'dayGridMonth',
    defaultDate: fecha,
    buttonText:{
      today:    'Hoy',
      month:    'Mes',
      week:     'Semana',
      day:      'Dia',
      list:     'Lista'
    },
    locale: 'es',
    eventColor: '#378006',
    minTime: "10:00:00",
    maxTime: "18:00:00",
    slotDuration: "00:15:00",
    businessHours: {
      start: '9:00',
      end: '16:00',
    },
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: {
      url: 'a_citas/eventos.php?tipo='+tipo,
      failure: function() {
        document.getElementById('script-warning').style.display = 'block'
      }
    },
    dateClick: function(info) {
      console.log('Date: ' + info);
     },
    eventClick: function(info) {
      $('#myModal').modal('show');
      $("#modal_form").load("a_citas/info.php?id="+info.event.id);
    },
    eventDrop: function (info) { // this function is called when something is dropped

      if(info.event.end){
        final=info.event.end.toLocaleString();
      }

      $.confirm({
        title: 'Fechas',
        content: '¿Desea mover la cita seleccionada?',
        buttons: {
          Mover: function () {
            $.ajax({
              data:  {
                "horario":info.event.start.toLocaleString(),
                "horario2":final,
                "idcita":info.event.id,
                "function":"cambiar_hora"
              },
              url:   "a_citas/db_.php",
              type:  'post',
              success:  function (response) {
                console.log(response);
                var datos = JSON.parse(response);
                if (datos.error==0){
                  Swal.fire({
                    type: 'success',
                    title: "Se modificó correctamente",
                    showConfirmButton: false,
                    timer: 1000
                  });
                }
                else{
                  info.revert();
                }
              }
            });
          },
          Cancelar: function () {
            info.revert();
          }
        }
      });

    },
    eventResize: function(info) {

      if(info.event.end){
        final=info.event.end.toLocaleString();
      }

      $.confirm({
        title: 'Fecha',
        content: '¿Desea mover la cita seleccionada?',
        buttons: {
          Mover: function () {
            $.ajax({
              data:  {
                "horario":info.event.start.toLocaleString(),
                "horario2":final,
                "idcita":info.event.id,
                "function":"cambiar_hora"
              },
              url:   "a_citas/db_.php",
              type:  'post',
              success:  function (response) {
                console.log(response);
                var datos = JSON.parse(response);
                if (datos.error==0){
                  Swal.fire({
                    type: 'success',
                    title: "Se modificó correctamente",
                    showConfirmButton: false,
                    timer: 1000
                  });
                }
                else{
                  info.revert();
                }
              }
            });
          },
          Cancelar: function () {
            info.revert();
          }
        }
      });
    }
  });
  calendar.render();
}
function fondos(){
  var formData = new FormData();
  formData.append("function", "fondo_carga");
  formData.append("ctrl", "control");
  let xhr = new XMLHttpRequest();
  xhr.open('POST',"control_db.php");
  xhr.addEventListener('load',(data)=>{
    document.getElementById("fondo").innerHTML = data.target.response;
  });
  xhr.onerror = (e)=>{
  };
  xhr.send(formData);
}
function fondo(archivo){
  var formData = new FormData();
  formData.append("function", "fondo");
  formData.append("imagen", archivo);
  formData.append("ctrl", "control");
  let xhr = new XMLHttpRequest();
  xhr.open('POST',"control_db.php");
  xhr.addEventListener('load',(data)=>{
    document.body.style.backgroundImage = "url('"+ archivo +"')";
  });
  xhr.onerror = (e)=>{
  };
  xhr.send(formData);
}
function fijar(){
  if(document.querySelector('.sidebar')){
    document.getElementById("navx").classList.remove('sidebar');
    document.getElementById("navx").classList.add('sidebar_fija');

    document.getElementById("contenido").classList.remove('main');
    document.getElementById("contenido").classList.add('main_fija');

  }
  else{
    document.getElementById("navx").classList.remove('sidebar_fija');
    document.getElementById("navx").classList.add('sidebar');

    document.getElementById("contenido").classList.remove('main_fija');
    document.getElementById("contenido").classList.add('main');
  }
}

class Pbusca extends HTMLFormElement {
  connectedCallback() {
   this.addEventListener('submit', (e) => {
      e.preventDefault();

      let id=e.currentTarget.attributes.id.nodeValue;
      let elemento = document.getElementById(id);

      let idventa=document.getElementById("idventa").value;
      let prod_venta=document.getElementById("prod_venta").value;

      var formData = new FormData(elemento);
      formData.append("idventa", idventa);
      formData.append("prod_venta", prod_venta);

      let xhr = new XMLHttpRequest();
      xhr.open('POST',"a_venta/productos_lista.php");
      xhr.addEventListener('load',(data)=>{
        document.getElementById("resultadosx").innerHTML =data.target.response;
      });
      xhr.onerror =  ()=>{
      };
      xhr.send(formData);
   })
  }
}
customElements.define("p-busca", Pbusca, { extends: "form" });



class Formselecciona extends HTMLFormElement {
  connectedCallback() {
   this.addEventListener('submit', (e) => {
      e.preventDefault();
      let id=e.currentTarget.attributes.id.nodeValue;
      let elemento = document.getElementById(id);

      var formData = new FormData(elemento);
      formData.append("function", "agregaventa");


      for(let contar=0;contar<elemento.attributes.length; contar++){
        let arrayDeCadenas = elemento.attributes[contar].name.split("_");
        if(arrayDeCadenas.length>1){
          formData.append(arrayDeCadenas[1], elemento.attributes[contar].value);
        }
      }

      let xhr = new XMLHttpRequest();
      xhr.open('POST',"a_venta/db_.php");
      xhr.addEventListener('load',(data)=>{
        $('#myModal').modal('hide');
        let idventa=data.target.response;
        document.getElementById("idventa").value=idventa;
        lista(idventa);
      });
      xhr.onerror =  ()=>{

      };
      xhr.send(formData);
   })
  }
}
customElements.define("is-selecciona", Formselecciona, { extends: "form" });

function lista(idventa){
  console.log(idventa);
  var formData = new FormData();
  formData.append("idventa", idventa);
  let xhr = new XMLHttpRequest();
  xhr.open('POST',"a_venta/lista_pedido.php");
  xhr.addEventListener('load',(data)=>{
    document.getElementById("lista").innerHTML=data.target.response;
  });
  xhr.onerror =  ()=>{

  };
  xhr.send(formData);

}
