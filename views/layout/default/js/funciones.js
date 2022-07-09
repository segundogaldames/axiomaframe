$(document).ready(function () {
  $("#table").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    },
    order: [[0, "desc"]],
    dom: "lBfrtip",
    buttons: [
      {
        extend: "copy",
        text: '<i class="far fa copy"></i>Copiar',
        titleAttr: "Copiar",
        className: "btn btn-sm",
      },
      {
        extend: "excel",
        text: '<i class="fa fa-table"></i>Excel',
        titleAttr: "Exportar a Excel",
        className: "btn btn-sm",
      },
      {
        extend: "pdf",
        text: '<i class="far fa-file-pdf-o"></i>PDF',
        titleAttr: "Exportar a PDF",
        className: "btn btn-sm",
      },
    ],
  });

  // Login Page Flipbox control
  $('.login-content [data-toggle="flip"]').click(function () {
    $(".login-box").toggleClass("flipped");
    return false;
  });
});

function eliminar(value) {
  form = document.form;
  let eliminar = confirm('¿Desea eliminar ' + value + '?');

  if (eliminar) {
    form.submit();
  }else{

    window.location.href = "http://localhost:8080/ecommerce/productos/";
  }


}
