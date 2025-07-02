var videos = [];

$(document).ready(function () {
  $(".img-producto")
    .wrap('<span style="display:inline-block"></span>')
    .css("display", "block")
    .parent()
    .zoom();

  AOS.init();
  $(".tooltip1").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized"],
    position: "top",
  });
  $(".tooltip2").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized2"],
    position: "top",
  });
  $(".tooltip3").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized3"],
    position: "top",
  });
  $(".tooltip4").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized4"],
    position: "top",
  });
  $(".tooltip5").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized5"],
    position: "top",
  });
  $(".tooltip6").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized6"],
    position: "top",
  });
  $(".tooltip7").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized7"],
    position: "top",
  });
  $(".tooltip8").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized8"],
    position: "top",
  });
  $(".tooltip9").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized9"],
    position: "top",
  });
  $(".tooltip10").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized10"],
    position: "top",
  });
  $(".tooltip11").tooltipster({
    theme: ["tooltipster-noir", "tooltipster-noir-customized11"],
    position: "left",
  });
  $(".file-image").fileinput({
     maxFileSize: 2048,
    previewFileType: "image",
    allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
    browseClass: "btn  btn-verde",
    showUpload: false,
    showRemove: false,
    browseIcon: '<i class="fas fa-image"></i> ',
    browseLabel: "Imagen",
    language: "es",
    dropZoneEnabled: false,
    showCancel: false,

  });
  $(".ir-arriba").click(function () {
    $("body, html").animate(
      {
        scrollTop: "0px",
      },
      300
    );
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $(".ir-arriba").slideDown(300);
    } else {
      $(".ir-arriba").slideUp(300);
    }
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  $(".carouselsection").carousel({
    quantity: 4,
    sizes: {
      900: 3,
      500: 1,
    },
  });
    $(".carousel").carousel({
    quantity: 1,
  
  });
  $(".banner-video-youtube").each(function () {
    //console.log($(this).attr("data-video"));
    var datavideo = $(this).attr("data-video");
    var idvideo = $(this).attr("id");
    var playerDefaults = {
      autoplay: 0,
      autohide: 1,
      modestbranding: 0,
      rel: 0,
      showinfo: 0,
      controls: 0,
      disablekb: 1,
      enablejsapi: 0,
      iv_load_policy: 3,
    };
    var video = { videoId: datavideo, suggestedQuality: "hd720" };
    videos[videos.length] = new YT.Player(idvideo, {
      videoId: datavideo,
      playerVars: playerDefaults,
      events: {
        onReady: onAutoPlay,
        onStateChange: onFinish,
      },
    });
  });
  function onAutoPlay(event) {
    event.target.playVideo();
    // event.target.mute();
  }
  function onFinish(event) {
    if (event.data === 0) {
      // event.target.playVideo();
    }
  }

  function addCommas(nStr) {
    nStr += "";
    x = nStr.split(".");
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, "$1" + "," + "$2");
    }
    return x1 + x2;
  }

  function calcularvalorcarrito() {
    var total = 0;
    var cantidadtotal = 0;
    $(".btn-minus").each(function () {
      var id = $(this).attr("data-id");
      var cantidad = $("#cantidad" + id).val();
      var valorunitario = $("#valorunitario" + id).val();
      var valortotal = parseInt(valorunitario) * parseInt(cantidad);
      total = parseInt(total) + parseInt(valortotal);
      cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
    });
    //console.log(total);
    //console.log(cantidadtotal);
    $("#totalpagar").html("$" + addCommas(total));
    calcularenvio();
    $("#cantidad-total-items").html(cantidadtotal);
  }

  function calcularenvio() {
    var total = 0;
    var cantidadtotal = 0;
    var envio = $("#pedido_envio").val();
    if (!envio) {
      envio = 0;
    }
    $(".btn-minus").each(function () {
      var id = $(this).attr("data-id");
      var cantidad = $("#cantidad" + id).val();
      var valorunitario = $("#valorunitario" + id).val();
      var valortotal = parseInt(valorunitario) * parseInt(cantidad);
      total = parseInt(total) + parseInt(valortotal);
      cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
    });
    var valorpagar = parseInt(envio) + total;

    $("#pedido_valorpagar").html(
      "$ " + addCommas(parseInt(valorpagar)) + " COP"
    );
    $("#pedido_enviocosto").html("$ " + addCommas(parseInt(envio)) + " COP");
    $("#pedido_valorpagar1").val(parseInt(valorpagar));
  }

  $("body").on("change", "#pedido_envio", function () {
    calcularenvio();
  });
  traercarrito(0);

  $("body").on("click", ".additemsolo", function () {
    var id = $(this).attr("data-id");
    $.post(
      "/page/carrito/additem",
      { producto: id, cantidad: 1 },
      function (res) {
        traercarrito(1);
      }
    );
  });

  $("body").on("click", ".addnom", function () {
    var id = $(this).attr("data-id");
    var nombre = $("#nombre" + id).val();
    var imagen1 = $("#imagen" + id).val();
    var imagen = "/images/" + imagen1;
    var descripcion = $("#descripcion" + id).val();
    var precio1 = $("#precio" + id).val();
    var precio = '<i class="fas fa-tag etiqueta_precio"></i> $' + precio1;
    var id = $("#id" + id).val();

    if (imagen1 == "") {
      imagen = "/corte/product.png";
    }

    document.getElementById("nombremodal").innerHTML = nombre;
    document.getElementById("nombremodal2").innerHTML = nombre;
    document.getElementById("imagenmodal").src = imagen;
    document.getElementById("descripcionmodal").innerHTML = descripcion;
    document.getElementById("btnModal").dataset.id = id;
    document.getElementById("preciomodal").innerHTML = precio;
  });

  $("body").on("click", ".additem", function () {
    var id = $(this).attr("data-id");
    var cantidad = $("#cantidad" + id).val();
    $.post(
      "/page/carrito/additem",
      { producto: id, cantidad: cantidad },
      function (res) {
        traercarrito(1);
      }
    );
  });

  $("body").on("click", ".btn-minus", function () {
    var id = $(this).attr("data-id");
    var cantidad = parseInt($("#cantidad" + id).val()) - 1;
    if (parseInt(cantidad) < 1) {
      cantidad = 1;
    }
    var valorunitario = $("#valorunitario" + id).val();
    $("#valortotal" + id).html(
      "$ " + addCommas(parseInt(valorunitario) * parseInt(cantidad))
    );
    $("#cantidad" + id).val(cantidad);
    $.post(
      "/page/carrito/changecantidad",
      { producto: id, cantidad: cantidad },
      function (res) {
        calcularvalorcarrito();
      }
    );
  });

  $("body").on("click", ".btn-plus", function () {
    var id = $(this).attr("data-id");
    var cantidad = parseInt($("#cantidad" + id).val()) + 1;

    var max = parseInt($("#cantidad" + id).attr("max"));
    if (cantidad > max) {
      cantidad = max;
    }

    var valorunitario = $("#valorunitario" + id).val();
    $("#valortotal" + id).html(
      "$ " + addCommas(parseInt(valorunitario) * parseInt(cantidad))
    );
    $("#cantidad" + id).val(cantidad);
    $.post(
      "/page/carrito/changecantidad",
      { producto: id, cantidad: cantidad },
      function (res) {
        calcularvalorcarrito();
      }
    );
  });
  $(".ver-carrito").on("click", function () {
    $(".caja-carrito").show(1000);
  });
  $(".ver-carrito2").on("click", function () {
    $(".caja-carrito").show(1000);
    $(".botonera-resposive").slideUp(300);
  });
  $("body").on("click", ".btn-cerrar-carrito", function () {
    $(".caja-carrito").hide(1000);
  });
  $("body").on("click", ".btn-eliminar-carrito", function () {
    var id = $(this).attr("data-id");
    $.post("/page/carrito/deleteitem", { producto: id }, function (res) {
      traercarrito(1);
    });
  });

  function traercarrito(ver) {
    $.get("/page/carrito", function (res) {
      $("#micarrito").html(res);
      calcularvalorcarrito();
      $(".caja-carrito").hide();
      if (parseInt(ver) == 1) {
        $(".caja-carrito").show(1000);
      }
    });
  }
  traercarrito(0);

  if ($(window).width() <= 991) {
    $(".btn-menu").on("click", function () {
      if ($(".botonera-resposive").is(":visible")) {
        $(".botonera-resposive").hide(300);
      } else {
        $(".botonera-resposive").show(300);
      }
    });
  } else {
    $(".btn-menu").click(function () {
      if ($(".botonera").is(":visible")) {
        $(".botonera").stop().hide(500);
        $(".btn-menu .cerrar").stop().hide();
        $(".btn-menu .abrir").stop().show();
      } else {
        $(".botonera").stop().show(500);
        $(".btn-menu .abrir").stop().hide();
        $(".btn-menu .cerrar").stop().show();
      }
    });
  }

  /*

  $("#buscar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mydiv .product").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
*/

  tinymce.init({
    selector: "textarea.tinyeditor-simple",
    plugins: ["lists"],
    menubar: false, // 👈 esto oculta el menú superior
    toolbar: "bold italic underline | bullist numlist | removeformat",
    paste_as_text: true, // 👈 fuerza pegar como texto plano
    language: "es",
    browser_spellcheck: true,
    contextmenu: false,
    skin: "oxide-dark",
    content_css: "tinymce-5",
    setup: function (editor) {
      editor.on("init", function () {
        const content = editor.getContent({ format: "text" });
        charCount.innerText = `${content.length}/${maxChars}`;
      });

      editor.on("input", function () {
        const content = editor.getContent({ format: "text" });
        if (content.length > maxChars) {
          editor.setContent(content.substring(0, maxChars)); // corta el texto si se pasa
          alert(`Máximo ${maxChars} caracteres permitidos.`);
        }
        document.getElementById(
          "char-count"
        ).innerText = `${content.length}/${maxChars}`;
      });
      editor.on("change keyup", () => {
        tinymce.triggerSave(); // sincroniza contenido en el <textarea>
        // validateCommercialActivity(false); // re­valida sin pintar errores
        // toggleSubmit(); // y habilita/deshabilita el botón
      });
    },
  });
 $(".selectpagination").change(function () {
    var route = $("#page-route").val();
    var pages = $(this).val();
    $.post(route, { pages: pages }, function () {
      location.reload();
    });
  });

    $(".switch-form").bootstrapToggle({
    on: "Si",
    off: "No",
    offstyle: "danger",
  });


});
