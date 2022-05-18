const reviewsClickOn = () => {
  $(".reviews").addClass("reviews-on");
};
const reviewsClickOff = () => {
  $(".reviews").removeClass("reviews-on");
};
const myFunction = () => {
  $(".menu").toggleClass("change");
  $(".menu_box").toggleClass("menu_activ");
};

const adminUser = () => {
  $(".admin").toggleClass("none");
  $(".admin_user").toggleClass("admin_activ");
};

const adminGoods = () => {
  $(".admin").addClass("none");
  $(".add_goods").addClass("admin_activ");
  $(".admin_goods").addClass("admin_activ");
};

const ajaxUser = (id) => {
  $.ajax({
    type: "POST",
    url: "../controlers/edit-admin.php",
    data: "id=" + id,
    success: function () {
      alert("Успешно");
    },
  });
};

const saveGoods = (id) => {
  $(document).ready(function ($) {
    $("#save-goods-" + id).click(function () {
      $("#save-goods-form-" + id).ajaxSubmit({
        type: "POST",
        url: "../controlers/save-goods.php?id=" + id,
        success: function () {
          alert("Товар Сохранен!");
        },
      });
    });
  });
};

const removeGoods = (id) => {
  $(document).ready(function ($) {
    $("#remove-goods-" + id).click(function () {
      $.ajax({
        type: "POST",
        url: "../controlers/remove-goods.php?id=" + id,
        success: function (data) {
          $(".admin_goods").html(data);
          alert("Товар удален!");
        },
      });
    });
  });
};

const editCountBasket = (id, price) => {
  $(document).ready(function ($) {
    $(".basket-count-" + id).keyup(function () {
      $.ajax({
        type: "POST",
        url: "../controlers/edit-count-basket.php",
        data: { id, count: $(this).val(), price },
        success: function (data) {
          $(".basket_price-" + id).html(data);
        },
      });
    });
    $(".basket-count-" + id).click(function () {
      $.ajax({
        type: "POST",
        url: "../controlers/edit-count-basket.php",
        data: { id, count: $(this).val(), price },
        success: function (data) {
          $(".basket_price-" + id).html(data);
        },
      });
    });
  });
};

const addGoods = () => {
  $.ajax({
    type: "POST",
    url: "../controlers/add-goods.php",
    success: function (data) {
      $(".admin_goods").html(data);
      alert("Товар добавлен!");
    },
  });
};

const addCatalog = (idMin,idMax) => {
  $(".loading_catalog").addClass('loading_catalog-activ')
  $(".add_catalog").addClass("no_loading")
  $.ajax({
    type: "POST",
    url: "../controlers/add-catalog.php",
    data: {idMin,idMax},
    success: function (data) {
      $(".cotalog_box").html(data);
    },
  });
};

const removeBasket = (id) => {
  $(document).ready(function ($) {
    $(".remove-basket-"+id).click(function () {
      $.ajax({
        type: "POST",
        url: "../controlers/del-goods.php",
        data: "id=" + this.id,
        success: function (data) {
          $(".basket_conteiner-"+id).remove()
          if(data) {
            $('.basket').html(data)
            $('.basket_bay').addClass('none')
          }
          alert("Товар удален!");
        },
      });
    });
  });
};

$(document).ready(function ($) {
  $(".basket_bay").click(function () {
    $.ajax({
      type: "POST",
      url: "../controlers/basket-bay.php",
      success: function (data) {
        $(".basket").html(data);
      },
    });
  });

  $(".listbuttom").click(function () {
    $.ajax({
      type: "POST",
      url: "../controlers/basket.php",
      data: "id=" + this.id,
      success: function (data) {
        $(".res").html(data);
        alert("Товар добавлен!");
      },
    });
  });

  $(".admin_img_open_modal").click(function () {
    $(".modal_img").html("");
    $(".loading").removeClass("no_loading");
    $(".admin_goods_img_modal").fadeIn();
    $.ajax({
      type: "POST",
      url: "../components/goods-modal.php",
      data: "id=" + $(this).get()[0]["alt"],
      success: function (data) {
        $(".loading").addClass("no_loading");
        $(".modal_img").html(data);
        //слушатели при загрузке файлов
        $("#img_goods-photo1").change(function () {
          $("#img_goods-photo1-form").ajaxSubmit({
            type: "POST",
            url:
              "/controlers/file.php?id=" +
              $(this).get()[0].labels[0].id +
              "&num=photo1&photo=" +
              $(".modal_photo-1").get()[0].lastElementChild.alt,
            target: ".modal_photo-1",
            success: function () {
              $("#photo-" + this.id)[0].src = this.lastElementChild.src;
              // После загрузки файла очистим форму.
              $("#img_goods-photo1-form")[0].reset();
            },
          });
        });
        $("#img_goods-photo2").change(function () {
          $("#img_goods-photo2-form").ajaxSubmit({
            type: "POST",
            url:
              "/controlers/file.php?id=" +
              $(this).get()[0].labels[0].id +
              "&num=photo2",
            target: ".modal_photo-2",
            success: function () {
              alert("Загружено");
              $("#img_goods-photo2-form")[0].reset();
            },
          });
        });
        $("#img_goods-photo3").change(function () {
          $("#img_goods-photo3-form").ajaxSubmit({
            type: "POST",
            url:
              "/controlers/file.php?id=" +
              $(this).get()[0].labels[0].id +
              "&num=photo3",
            target: ".modal_photo-3",
            success: function () {
              alert("Загружено");
              $("#img_goods-photo3-form")[0].reset();
            },
          });
        });
        return false;
      },
    });
  });
  $(".admin_goods_modal-close").click(function () {
    $(this).parents(".admin_goods_img_modal").fadeOut();
    return false;
  });
  $(document).keydown(function (e) {
    if (e.keyCode === 27) {
      e.stopPropagation();
      $(".admin_goods_img_modal").fadeOut();
    }
  });
  $(".admin_goods_img_modal").click(function (e) {
    if ($(e.target).closest(".admin_goods_modal").length == 0) {
      $(this).fadeOut();
    }
  });
});
