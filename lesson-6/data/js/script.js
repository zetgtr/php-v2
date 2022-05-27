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
  $.ajax({
    type: "POST",
    url: "index.php?act=admin_user&m=admin",
    success: function (data) {
      $(".admin").html(data);
    }
  })
};

const adminUserEdit = (id) => {
  $.ajax({
    type: "POST",
    url: "index.php?act=admin_user_edit&m=admin",
    data: "id=" + id,
    success: function (data) {
      alert(data);
    },
  });
};

const adminGoods = () => {
  $.ajax({
    type: "POST",
    url: "index.php?act=admin_goods&m=admin",
    success: function (data) {
      $(".admin").html(data);
      $(".add_goods").addClass("admin_activ");
    }
  })

};

const saveGoods = (id) => {
  $(document).ready(function ($) {
    $("#save-goods-" + id).click(function () {
      $("#save-goods-form-" + id).ajaxSubmit({
        type: "POST",
        url: "index.php?act=admin_goods_save&m=admin&id=" + id,
        success: function () {
          alert("Товар Сохранен!");
        },
      });
    });
  });
};

const addGoods = () => {
  $.ajax({
    type: "POST",
    url: "index.php?act=admin_goods_add&m=admin",
    success: function (data) {
      $(".admin_goods").append(data);
    },
  });
};

const removeGoods = (id) => {
  $(document).ready(function ($) {
    $("#remove-goods-" + id).click(function () {
      $.ajax({
        type: "POST",
        url: "index.php?act=admin_goods_remove&m=admin&id=" + id,
        success: function (data) {
          $(".admin_goods").html(data);
          alert("Товар удален!");
        },
      });
    });
  });
};
const addCatalog = (idMax) => {
  $(".loading_catalog").addClass('loading_catalog-activ')
  $(".add_catalog").addClass("no_loading")
  $.ajax({
    type: "POST",
    url: "index.php?act=add_catalog&m=catalog",
    data: {idMax},
    success: function (data) {
      $(".loading_catalog").removeClass('loading_catalog-activ')
      $(".add_catalog").removeClass("no_loading")
      $(".main_img").append(data)
      $(".add_catalog").attr("onclick","").unbind('click').click(()=>addCatalog(idMax+9))
    },
  });
};


const editCountBasket = (id, price) => {
  $(document).ready(function ($) {
    $(".basket-count-" + id).keyup(function () {
      $.ajax({
        type: "POST",
        url: "index.php?act=edit_count_basket$m=basket",
        data: { id, count: $(this).val(), price },
        success: function (data) {
          $(".basket_price-" + id).html(data);
        },
      });
    });
    $(".basket-count-" + id).click(function () {
      $.ajax({
        type: "POST",
        url: "index.php?act=edit_count_basket$m=basket",
        data: { id, count: $(this).val(), price },
        success: function (data) {
          $(".basket_price-" + id).html(data);
        },
      });
    });
  });
};

const addBasketProduct = (id) => {
    $.ajax({
      type: "POST",
      url: "index.php?act=add_basket&m=basket",
      data: "id=" + id,
      success: function (data) {
        $(".count_box-flex").html(data)
        alert("Товар добавлен!");
      },
    })
}

const removeBasket = (id) => {
  $(document).ready(function ($) {
    $(".remove-basket-"+id).click(function () {
      $.ajax({
        type: "POST",
        url: "index.php?act=del_basket&m=basket",
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

const adminModal = (id) => {
  $(".modal_img").html("");
  $(".loading").removeClass("no_loading");
  $(".admin_goods_img_modal").fadeIn();
  $.ajax({
    type: "POST",
    url: "index.php?act=admin_goods_modal&m=admin",
    data: "id=" + id,
    success: function (data) {
      $(".loading").addClass("no_loading");
      $(".modal_img").html(data);
      //слушатели при загрузке файлов
      $("#img_goods-photo1").change(function () {
        $("#img_goods-photo1-form").ajaxSubmit({
          type: "POST",
          url:
              "index.php?act=admin_goods_file&m=file&id=" +
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
              "index.php?act=admin_goods_file&m=file&id=" +
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
              "index.php?act=admin_goods_file&m=file&id=" +
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
  $(document).ready(function ($) {
  $(".admin_goods_modal-close").click(function () {
    $(this).parents(".admin_goods_img_modal").fadeOut();
    return false;
  })
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
  })
}

$(document).ready(function ($) {
  $(".basket_bay").click(function () {
    $.ajax({
      type: "POST",
      url: "index.php?act=bay_basket&m=basket",
      success: function (data) {
        $(".basket").html(data);
      },
    });
  });

  $(".listbuttom").click(function () {
    $.ajax({
      type: "POST",
      url: "index.php?act=add_basket&m=basket",
      data: "id=" + this.id,
      success: function (data) {
        $(".res").html(data);
        alert("Товар добавлен!");
      },
    });
  });
});
