<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
  integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script
  src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>


<script type="text/javascript">

  function canvasGraph(varData, conf, graph, opt) {
    if (opt) {
      varData = new Chart(graph, conf);
      return varData;
    } else {
      varData.destroy();
      return varData;
    }

  }
  $(document).ready(() => {

    $('#token').click(() => {
      let credential = $('#credential').val();
      //console.log(credential);

      $.ajax({
        url: 'index.php/welcome/tokenC',
        method: 'post',
        data: {
          credential: credential,
          flag: true
        },
        dataType: 'json'
      }).done((data) => {
        console.log(data);
        $('#indicadores').val(data);
        Swal.fire({
          icon: 'success',
          title: 'Token Obtenido Con Exito!!',
          showConfirmButton: false,
          timer: 1500
        });

      });

    });

    $('#indicadores').click(() => {
      $.ajax({
        url: 'index.php/welcome/allData',
        method: 'post',
        data: {
          token: $('#indicadores').val()
        },
        dataType: 'json',
      }).done((data) => {
         Swal.fire({
          icon: 'success',
          title: 'Datos Insertado Con Exito!!',
          showConfirmButton: false,
          timer: 1000
        });

        console.log(data);
        //let newData = JSON.parse(data);
        //console.log(newData);
        //var filterData = newData.filter(indice => indice.codigoIndicador
        //  == 'UF');
        //console.log(filterData[0]['id'], filterData[0]['codigoIndicador']);
        /* for (let i = 0; i < filterData.length; i++) {
           $('#dataInsert').append(
             '<tr>',
             '<td>' + filterData[i]['id'] + '</td>',
             '<td>' + filterData[i]['nombreIndicador'] + '</td>',
             '<td>' + filterData[i]['codigoIndicador'] + '</td>',
             '<td>' + filterData[i]['unidadMedidaIndicador'] + '</td>',
             '<td>' + filterData[i]['valorIndicador'] + '</td>',
             '<td>' + filterData[i]['fechaIndicador'] + '</td>',
             '<td>' + filterData[i]['tiempoIndicador'] + '</td>',
             '<td>' + filterData[i]['origenIndicador'] + '</td>',
             '</tr>'
           );
 
         }*/ 
      });
    });

    //llamar datatable con ajax
   var tblIndices = $('#dataShow').DataTable({
      "ajax": {
        "url": 'index.php/welcome/datatable',
        "method": 'post',
        "dataSrc": ""
      },

      "columns": [
        { "data": "id" },
        { "data": "nombreindicador" },
        { "data": "codigoindicador" },
        { "data": "unidadmedidaindicador" },
        { "data": "valorindicador" },
        { "data": "fechaindicador" },
        { "data": "tiempoindicador" },
        { "data": "origenindicador" },
        {
          "orderable": true,
          render: (data, index, row) => {
            return "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar' id='" + row.id + "'><i class='bi bi-pencil-fill'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar' id='" + row.id + "'><i class='bi bi-trash3'>delete</i></button></div></div>"
          }
        }
      ]
    });

    $('#insertData').click(() => {
      $('#formIndices').trigger('reset');
      $(".modal-header").css("background-color", "#17a2b8");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Agregar Indice");
      $('#indiceCRUD').modal('show');
    });
    $('#btnSave').click((e) => {
      e.preventDefault();
      let nombrei = $('#nombreindicador').val();
      let codigoi = $('#codigoindicador').val();
      let unidadi = $('#unidadmedidaindicador').val();
      let valori = $('#valorindicador').val();
      let fechai = $('#fechaindicador').val();
      let tiempoi = $('#tiempoindicador').val();
      let origeni = $('#origenindicador').val();
      $.ajax({
        url: 'index.php/welcome/insertData',
        method: 'post',
        data: {
          nombreindice: nombrei,
          codigoindice: codigoi,
          unidadmedida: unidadi,
          valorindice: valori,
          fechaindice: fechai,
          tiempoindice: tiempoi,
          origenindice: origeni
        }
      }).done((data) => {
        console.log(data);
        tblIndices.ajax.reload();
        $('#indiceCRUD').toggle('modal');
        $('#indiceCRUD').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Datos Insertado Con Exito!!',
          showConfirmButton: false,
          timer: 1000
        });

      });
    });

    $(document).on('click', '.btnBorrar', function () {
      let row = $(this);
      let id = $(this).closest('tr').find('td:eq(0)').text();
      let response = confirm('¿Seguro que deseas Borrar el Indice N°' + id + '?');

      if (response) {
        $.ajax({
          url: 'index.php/welcome/deleteIndice',
          method: 'post',
          datatype: 'json',
          data: { id: id },
          success: () => {
            tblIndices.row(row.parents('tr')).remove().draw();
          }
        }).done((data) => {
          console.log(data);
          Swal.fire({
            icon: 'success',
            title: 'Datos Eliminados Con Exito!!',
            showConfirmButton: false,
            timer: 1000
          });
        });
      }
    });

    $(document).on('click', '.btnEditar', function () {
      $('#editIndices').trigger('reset');

      let row = $(this).closest('tr');
      let ide = $(this).attr('id');
      let namei = row.find('td:eq(1)').text();
      let codei = row.find('td:eq(2)').text();
      let uniti = row.find('td:eq(3)').text();
      let valuei = row.find('td:eq(4)').text();
      let datei = row.find('td:eq(5)').text();
      let timei = row.find('td:eq(6)').text();
      let origini = row.find('td:eq(7)').text();

      $('#btnSaveEdit').val(ide);
      $('#enombreindicador').val(namei);
      $('#ecodigoindicador').val(codei);
      $('#eunidadmedidaindicador').val(uniti);
      $('#evalorindicador').val(valuei);
      $('#efechaindicador').val(datei);
      $('#etiempoindicador').val(timei);
      $('#eorigenindicador').val(origini);
      $(".modal-header").css("background-color", "#007bff");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Editar Indice");
      $('#editCRUD').modal('show');
    });

    $('#btnSaveEdit').click(function (e) {
      e.preventDefault();
      let ide = $(this).val();
      let nombrei = $('#enombreindicador').val();
      let codigoi = $('#ecodigoindicador').val();
      let unidadi = $('#eunidadmedidaindicador').val();
      let valori = $('#evalorindicador').val();
      let fechai = $('#efechaindicador').val();
      let tiempoi = $('#etiempoindicador').val();
      let origeni = $('#eorigenindicador').val();
      $.ajax({
        url: 'index.php/welcome/editData',
        method: 'post',
        data: {
          id: ide,
          nombreindice: nombrei,
          codigoindice: codigoi,
          unidadmedida: unidadi,
          valorindice: valori,
          fechaindice: fechai,
          tiempoindice: tiempoi,
          origenindice: origeni
        }
      }).done((data) => {
        console.log(data);
        tblIndices.ajax.reload();
        $('#editCRUD').toggle('modal');
        $('#editCRUD').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Datos Editados Con Exito!!',
          showConfirmButton: false,
          timer: 1300
        });

      });
    });


    $('#seeGraf').click(() => {
      $.ajax({
        url: 'index.php/welcome/graph',
        method: 'post',
        datatype: 'json'
      }).done((dataRes) => {
        let newData = JSON.parse(dataRes);
        //console.log(newData);

        const configDay = newData.map((first, index) => {
          let newDay = new Date(first.fechaindicador);
          return newDay.setHours(0, 0, 0, 0);
        });

        const configValue = newData.map((first, index) => {
          let newValue = first.valorindicador;
          return newValue;
        });
        //console.log(configValue);

        var labels = configDay;
        var data = {
          labels: labels,
          datasets: [{
            label: "Grafico Indice UF",
            data: configValue,
            backgroundColor: 'rgba(9, 129, 176, 0.2)'
          }]
        };
        var config = {
          type: 'bar',
          data: data,
          options: {
            scales: {
              x: {
                min: '2021-01-01',
                max: '2021-01-30',
                type: 'time',
                time: {
                  unit: 'day'
                }
              },
              y: {
                beginAtZero: false
              }
            }
          }
        };
        var newGraphf;
        var graph = $('#graphic');
        let opt = true;
        newGraphf = canvasGraph(newGraphf, config, graph, opt);
        //newGraphf = new Chart(graph, config);     
        $('#exit').click(() => {
          $('#graf').toggle('modal');
          $('#graf').modal('hide');
          let opt = false;
          canvasGraph(newGraphf, config, graph, opt);
        });
        


        $(".modal-header").css("background-color", "#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Grafico");
        $('#graf').modal('show');

        $('#startFilter').change(function () {
          let dateStart = $('#startFilter').val();
          let formatStart = new Date(dateStart);
          //console.log(formatDate);
          newGraphf.config.options.scales.x.min = formatStart;
          newGraphf.update();
        });

        $('#endFilter').change(function () {
          let dateEnd = $('#endFilter').val();
          //console.log(dateEnd);
          let formatEnd = new Date(dateEnd.replace(/-/g, '\/'));
          //console.log(formatDate);
          newGraphf.config.options.scales.x.max = formatEnd;
          newGraphf.update();
        });
      });

    });


  });
</script>
</body>

</html>