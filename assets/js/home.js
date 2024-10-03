//Modales
var modalAgregarEmpleado = $("#modalAgregarEmpleado");
var modalEditarEmpleado = $("#modalEditarEmpleado");
var empleadoListado = $("[name=empleadoList]");
//botones
var btnAbrir = $("#btnAbrir");
var btnGuardar = $("[name=btnGuardar]");
var btnEditar = $("[name=btnEditar]");

// input
var nombre = $("[name=nombre]");
var email = $("[name=email]");
var nombreEdit = $("[name=nombreEdit]");
var emailEdit = $("[name=emailEdit]");
var area = $("[name=area]");
var areaEdit = $("[name=areaEdit]");
var sexo = $("[name=sexo]");
var descripcion = $("[name=descripcion]");
var confirm = $("[name=confirm]");
var sexoEdit = $("[name=sexoEdit]");
var descripcionEdit = $("[name=descripcionEdit]");
var confirmEdit = $("[name=confirmEdit]");
var roles = $("[name=roles]");
var rolesEdit = $("[name=rolesEdit]");
var rol = $("[name=rol]");
var boletin = $("[name=confirm]");
var boletinEdit = $("[name=boletinEdit]");

//template

var tempSelect = '<option value="{0}">{1}</option>';

// funcionalidades
btnAbrir.on("click", function () {
  modalAgregarEmpleado.modal("show");
});

var getAreas = function () {
  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/getAreas",
    type: "POST",
    dataType: "json",
    data: {},
    success: function (data) {
      if (data.success === true) {
        var detalle = data.data;
        for (var i = 0; i < detalle.length; i++) {
          area.append(
            '<option value="' +
              detalle[i]["id"] +
              '">' +
              detalle[i]["nombre"] +
              "</option>"
          );
          areaEdit.append(
            '<option value="' +
              detalle[i]["id"] +
              '">' +
              detalle[i]["nombre"] +
              "</option>"
          );
        }
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
};

var getRoles = function () {
  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/getRoles",
    type: "POST",
    dataType: "json",
    data: {},
    success: function (data) {
      if (data.success === true) {
        var detalle = data.data;
        for (var i = 0; i < detalle.length; i++) {
          roles.append(
            '<div class="form-group form-check">' +
              '<input type="checkbox" class="form-check-input" id="rol_' +
              detalle[i]["id"] +
              '" name="rolEdit" value="' +
              detalle[i]["id"] +
              '" required>' +
              '<label class="form-check-label" for="confirm">' +
              detalle[i]["nombre"] +
              "</label></div>"
          );
          rolesEdit.append(
            '<div class="form-group form-check">' +
              '<input type="checkbox" class="form-check-input" id="rol_' +
              detalle[i]["id"] +
              '" name="rolEdit" value="' +
              detalle[i]["id"] +
              '" required>' +
              '<label class="form-check-label" for="confirm">' +
              detalle[i]["nombre"] +
              "</label></div>"
          );
        }
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
};

getRoles();
getAreas();

btnGuardar.on("click", function () {
  if (nombre.val() == "" || nombre.val() == null) {
    alert("Debe agregar un nombre");
    return;
  }
  if (email.val() == "" || email.val() == null) {
    alert("Debe agregar un email");
    return;
  }
  if (descripcion.val() == "" || descripcion.val() == null) {
    alert("Debe agregar una descripción");
    return;
  }
  if (area.val() == "" || area.val() == null) {
    alert("Debe seleccionar un area");
    return;
  }
  if (!$('input[name="sexo"]:checked').val()) {
    alert("Debe seleccionar su sexo");
    return;
  }
  if (!$('input[name="rol"]:checked').val()) {
    alert("Debe seleccionar un rol");
    return;
  }
  var datos = {
    nombre: nombre.val(),
    email: email.val(),
    sexo: $('input[name="sexo"]:checked').val(),
    area: area.val(),
    boletin: boletin.is(":checked") ? 1 : 0,
    descripcion: descripcion.val(),
    rol: $('input[name="rol"]:checked').val(),
  };

  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/createEmpleado",
    type: "POST",
    dataType: "json",
    data: JSON.stringify(datos),
    success: function (data) {
      if (data.success === true) {
        nombre.val("");
        email.val("");
        area.val("");
        descripcion.val("");
        boletin.prop("checked", false);
        rol.prop("checked", false);
        getEmpleados();
        modalAgregarEmpleado.modal("hide");
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
});

var getEmpleados = function () {
  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/getEmpleados",
    type: "POST",
    dataType: "json",
    data: {},
    success: function (data) {
      var html = "";
      if (data.success === true) {
        for (var i = 0; i < data.data.length; i++) {
          var item = data.data[i];
          html += "<tr>";
          html += "<td>" + item.nombre + "</td>";
          html += "<td>" + item.email + "</td>";
          html += "<td>" + item.area + "</td>";
          html += "<td>" + item.boletin + "</td>";
          html +=
            '<td> <span class="fas fa-edit" id="btnEditar" \n\
            style="font-size:20px; cursor:pointer;" title="Editar" name="btnEditar" \n\
            data-codigo="' +
            item.id +
            '"> \n\
            <td> <span class="fas fa-trash" id="btnEliminar" \n\
            style="font-size:20px; cursor:pointer;" title="Eliminar" name="btnEliminar" \n\
            data-codigo="' +
            item.id +
            '"> \n</td>';
          html += " </tr>";
        }
        if (html === "") {
          html = "<i>No se encontraron datos</i>";
        }
        empleadoListado.html(html);

        $("[name=btnEditar]").on("click", function () {
          var codigo = $(this).data("codigo");
          $("[name=codigo]").val("");
          $("[name=codigo]").val(codigo);
          getEmpleado(codigo);
          modalEditarEmpleado.modal("show");
        });

        $("[name=btnEliminar]").on("click", function () {
          var codigo = $(this).data("codigo");
          eliminar(codigo);
        });
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
};

getEmpleados();

var getEmpleado = function (codigo) {
  var dato = {
    id: codigo,
  };
  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/getEmpleado",
    type: "POST",
    dataType: "json",
    data: JSON.stringify(dato),
    success: function (data) {
      if (data.success === true) {
        var detalle = data.data;
        for (var i = 0; i < detalle.length; i++) {
          nombreEdit.val(detalle[i]["nombre"]);
          emailEdit.val(detalle[i]["email"]);
          areaEdit.val(detalle[i]["area_id"]);
          descripcionEdit.val(detalle[i]["descripcion"]);
          if (detalle[i]["boletin"] == 1) {
            boletinEdit.prop("checked", true);
          }
          rolEdit.val(detalle[i]["rol_id"]);
        }
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
};

btnEditar.on("click", function () {
  if (nombreEdit.val() == "" || nombreEdit.val() == null) {
    alert("Debe agregar un nombre");
    return;
  }
  if (emailEdit.val() == "" || emailEdit.val() == null) {
    alert("Debe agregar un email");
    return;
  }
  if (descripcionEdit.val() == "" || descripcionEdit.val() == null) {
    alert("Debe agregar una descripción");
    return;
  }
  if (areaEdit.val() == "" || areaEdit.val() == null) {
    alert("Debe seleccionar un area");
    return;
  }
  if (!$('input[name="sexoEdit"]:checked').val()) {
    alert("Debe seleccionar su sexo");
    return;
  }
  if (!$('input[name="rolEdit"]:checked').val()) {
    alert("Debe seleccionar un rol");
    return;
  }
  var datos = {
    nombre: nombreEdit.val(),
    email: emailEdit.val(),
    sexo: $('input[name="sexoEdit"]:checked').val(),
    area: areaEdit.val(),
    boletin: boletinEdit.is(":checked") ? 1 : 0,
    descripcion: descripcionEdit.val(),
    rol: $('input[name="rolEdit"]:checked').val(),
    id: $("[name=codigo]").val(),
  };

  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/updateEmpleado",
    type: "POST",
    dataType: "json",
    data: JSON.stringify(datos),
    success: function (data) {
      if (data.success === true) {
        getEmpleados();
        modalEditarEmpleado.modal("hide");
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
});

var eliminar = function (codigo) {
  var datos = {
    id: codigo,
  };

  $.ajax({
    url: "http://localhost/prueba-tecnica/public/index.php/home/eliminarEmpleado",
    type: "POST",
    dataType: "json",
    data: JSON.stringify(datos),
    success: function (data) {
      if (data.success === true) {
        getEmpleados();
      }
    },
    error: function (error) {
      console.error("Error en la petición:", error);
    },
  });
};
