
////////////// Ventas
function cambio_total(){
  


  let total_g=document.getElementById("total_g").value;
  let efectivo_g=document.getElementById("efectivo_g").value;
  let total=(efectivo_g-total_g)*100;
  total=Math.round(total)/100
  document.getElementById("cambio_g").value=total;
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

///////////////////////////////////////////////ESPECIAL

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

      let idventa=document.getElementById("idventa").value;
      let idcliente=document.getElementById("idcliente").value;

      var formData = new FormData(elemento);
      formData.append("function", "agregaventa");
      formData.append("idventa", idventa);
      formData.append("idcliente", idcliente);

      for(let contar=0;contar<elemento.attributes.length; contar++){
        let arrayDeCadenas = elemento.attributes[contar].name.split("_");
        if(arrayDeCadenas.length>1){
          formData.append(arrayDeCadenas[1], elemento.attributes[contar].value);
        }
      }
      let xhr = new XMLHttpRequest();
      xhr.open('POST',"a_venta/db_.php");
      xhr.addEventListener('load',(data)=>{
        console.log(data.target.response);
        var datos = JSON.parse(data.target.response);
        if(datos.error==0){
          $('#myModal').modal('hide');
          document.getElementById("idventa").value=datos.idventa;
          document.getElementById("numero").value=datos.numero;
          document.getElementById("fecha").value=datos.fecha;
          document.getElementById("estado").value=datos.estado;
          document.getElementById("total").value=datos.total;
          lista(datos.idventa);
          document.getElementById("resultadosx").innerHTML ="";
        }
        else{
          Swal.fire({
            type: 'error',
            title: "Error: "+datos.terror,
            showConfirmButton: false,
            timer: 1000
          });
          return;
        }
      });
      xhr.onerror =  ()=>{

      };
      xhr.send(formData);
   })
  }
}
customElements.define("is-selecciona", Formselecciona, { extends: "form" });

class Borraprod extends HTMLButtonElement {
  connectedCallback() {
   this.addEventListener('click', (e) => {
      e.preventDefault();

      let idventa=document.getElementById("idventa").value;
      let idbodega=e.currentTarget.attributes.v_idbodega.value;

      let formData = new FormData();
      formData.append("idventa", idventa);
      formData.append("idbodega", idbodega);
      formData.append("function", "borrar_venta");

      let xhr = new XMLHttpRequest();
      xhr.open('POST',"a_venta/db_.php");
      xhr.addEventListener('load',(data)=>{
        lista(idventa);
      });
      xhr.onerror =  ()=>{

      };
      xhr.send(formData);

   })
  }
}
customElements.define("is-borraprod", Borraprod, { extends: "button" });

class Cliente_flo extends HTMLButtonElement {
  connectedCallback() {
   this.addEventListener('click', (e) => {
      e.preventDefault();
      let idventa=document.getElementById("idventa").value;
      let idcliente=e.currentTarget.attributes.v_idcliente.value;

      let formData = new FormData();
      formData.append("idventa", idventa);
      formData.append("idcliente", idcliente);
      formData.append("function", "agregar_cliente");

      let xhr = new XMLHttpRequest();
      xhr.open('POST',"a_venta/db_.php");
      xhr.addEventListener('load',(data)=>{
        cliente_datos(idcliente);
        console.log(data.target.response);
      });
      xhr.onerror =  ()=>{

      };
      xhr.send(formData);
   })
  }
}
customElements.define("is-cliente", Cliente_flo, { extends: "button" });

function lista(idventa){
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
function datos_compra(idventa){
  var formData = new FormData();
  formData.append("idventa", idventa);

  let xhr = new XMLHttpRequest();
  xhr.open('POST',"a_venta/dato_compra.php");
  xhr.addEventListener('load',(data)=>{
    document.getElementById("dato_compra").innerHTML =data.target.response;
  });
  xhr.onerror =  ()=>{
  };
  xhr.send(formData);
}
function cliente_datos(idcliente){
  var formData = new FormData();
  formData.append("idcliente", idcliente);

  let xhr = new XMLHttpRequest();
  xhr.open('POST',"a_venta/cliente_datos.php");
  xhr.addEventListener('load',(data)=>{
    document.getElementById("cliente_datos").innerHTML =data.target.response;
  });
  xhr.onerror =  ()=>{
  };
  xhr.send(formData);

}

var dragSrcEl = null;
var dragdestino = null;

class Divlink extends HTMLDivElement  {
	connectedCallback() {
		this.addEventListener('dragstart', (e) => {
				this.style.opacity = '0.4';
				dragSrcEl = this;
				e.dataTransfer.effectAllowed = 'move';
				e.dataTransfer.setData('text/html', this.innerHTML);
		});
		this.addEventListener('dragenter', (e) => {
			this.classList.add('over');
			if (dragSrcEl != this) {
				dragdestino=this;
				let tmp=dragSrcEl.innerHTML;
				dragSrcEl.innerHTML=this.innerHTML;
				//dragdestino.innerHTML = tmp.innerHTML;
				//dragSrcEl.innerHTML=
				//dragSrcEl.innerHTML = dragdestino.innerHTML;
			}
		});
		this.addEventListener('dragover', (e) => {
				if (e.preventDefault) {
					e.preventDefault();
				}
				e.dataTransfer.dropEffect = 'move';
				return false;
		});
		this.addEventListener('dragleave', (e) => {
				this.classList.remove('over');
		});
		this.addEventListener('drop', (e) => {
			if (e.stopPropagation) {
				e.stopPropagation(); // stops the browser from redirecting.
			}
			if (dragSrcEl != this) {
				console.log("destino:"+this.dataset.orden);
				console.log("idSUbactividad:"+dragSrcEl.id);

				dragSrcEl.innerHTML = this.innerHTML;
				this.innerHTML = e.dataTransfer.getData('text/html');

				let idx = dragSrcEl.id.split("_");

				let formData = new FormData();
				formData.append("destino",this.dataset.orden);
				formData.append("id",idx[1]);
				formData.append("function","orden_subact");

				let xhr = new XMLHttpRequest();
				xhr.open('POST',"a_actividades/db_.php");
				xhr.addEventListener('load',(data)=>{
					console.log(data.target.response);
				});
				xhr.onerror =  ()=>{
					console.log("error");
				};
				xhr.send(formData);
			}
			return false;
		});
		this.addEventListener('dragend', (e) => {
				this.style.opacity = '1';
		});
	}
}
customElements.define("b-card", Divlink, { extends: "div" });
