
/**
 * Удаление товара из корзины
 */
function deleteGood(key){
    $.ajax({
        method: "POST",
        url: "index.php?path=cart/delete",
        data: {"key": key},
        success: function(){    
            location.reload();  
       }
    });
}

/**
 * Добавление товара в корзину
 */
function addGood(id){
    console.log(1);
    let size   = $('#size_form').serialize();
    size = parseInt(size.replace(/\D/g,''));
    $.ajax({
        type: 'POST',
        url: 'index.php?path=cart/add',
        data: {size, id},
        success: function(){    
            $('.header_cart_count').load('index.php?path=page/good .header_cart_count');
            $("#modal__window").css("display", "block");
            $("#modal__content_wrp").html('Товар добавлен в корзину<a href="index.php?path=cart/cart">перейти в корзину</a>');
       }
    })
}

/**
 * Админ: Изменение статуса заказа на "Обработан"
 */
function processedOrder(id){
    $.ajax({
        method: "POST",
        url: "index.php?path=user/changeOrderStatus",
        data: { "id": id,
                "action": 'Обработан'},
        success: function(){  
            $('.user_orders').load('index.php?path=user/account .user_orders');   
        }
    });
}

/**
 * Админ: Изменение статуса заказа на "Отменен"
 */
function canselOrder(id){
    $.ajax({
        method: "POST",
        url: "index.php?path=user/changeOrderStatus",
        data: { "id": id,
                "action": 'Отменен'},
        success: function(){ 
            $('.user_orders').load('index.php?path=user/account .user_orders');    
        }
    });
}

/**
 * Админ: опубликовать отзыв
 */
function publishFeedback(id){
    $.ajax({
        method: "POST",
        url: "index.php?path=user/changeFeedbackStatus",
        data: { "id": id,
                "action": 'опубликован'},
        success: function(){  
            $('.feedbacks_wrp').load('index.php?path=user/account .feedbacks_wrp');   
        }
    });
}

/**
 * Админ: заблокировать отзыв
 */
function blockFeedback(id){
    $.ajax({
        method: "POST",
        url: "index.php?path=user/changeFeedbackStatus",
        data: { "id": id,
                "action": 'заблокирован'},
        success: function(){  
            $('.feedbacks_wrp').load('index.php?path=user/account .feedbacks_wrp');   
        }
    });
}

$(document).ready(function (e) {
    /**
	 * Форма подписки
	 */
    $('#subscribe_btn').on('click', (function(e) {
        e.preventDefault();
        let formData = new FormData($('#subscribe_form')[0]);
        $.ajax({
            type:'POST', 
            url: 'index.php?path=page/subscribe', 
            data:formData, 
            cache:false, 
            contentType: false, 
            processData: false, 
            success:function(){ 
                $('#subscribe_form').load('index.php?path=page/index #subscribe_form'); 
                $("#modal__window").css("display", "block");
                $("#modal__content_wrp").html('Спасибо за подписку!');
            },
        });
    }));  

    /**
	 * Форма добавления отзыва
	 */
    $('#add_feedback_btn').on('click', (function(){
        let rating = $('.rating').attr('data-value');
        let title = $('#add_feedback_title').val();
        let text = $('#add_feedback_text').val();
        $.ajax({
            type:'POST', 
            url: 'index.php?path=user/addFeedback', 
            data:{rating , title, text},
            success:function(){ 
                $('.rating').attr('data-value', '5');
                document.querySelectorAll('.rating').forEach(dom => new Rating(dom));
                $('#add_feedback_title').val('');
                $('#add_feedback_text').val('');
                $("#modal__window").css("display", "block");
                $("#modal__content_wrp").html('Спасибо за отзыв! <span>Он будет опубликован после модерации</span>');
            },
        });
    }));
    /**
	 * Оформление заказа
	 */
    $('#save_order').on('click', function(){
        $.ajax({
            url: 'index.php?path=cart/buy',
            success: function(){
                $('.cart').load('index.php?path=cart/cart .cart');
                $('.header_cart_count').load('index.php?path=cart/cart .header_cart_count');
                $("#modal__window").css("display", "block");
                $("#modal__content_wrp").html('Заказ успешно оформлен <a href="index.php?path=user&method=account">личный кабинет</a>');
            }
        })
    })
    
    /**
	 * Админ: Отправка данных с формы добавления товара в каталог
	 */
    $('#add_good_form').on('submit',(function(e) {
        e.preventDefault();
        let formData = new FormData($('#add_good_form')[0]);
        $.ajax({
            type:'POST', 
            url: 'index.php?path=user/addToCatalog', 
            data:formData, 
            cache:false, 
            contentType: false, 
            processData: false, 
            success:function(){
                $('.user_account_catalog_list').load('index.php?path=user/account .user_account_catalog_list');
                $('#add_good_form').load('index.php?path=user/account #add_good_form'); 
                $("#modal__window").css("display", "block");
                $("#modal__content_wrp").html('Товар успешно добавлен');
            },
        });
    })); 
    
    /**
	 * Админ: Загрузка и заполнение данными формы редактирования товара
	 */
     $('.good_edit_link').on('click',(function(e){
        e.preventDefault();
        let id = $(this).attr("data-good");
        $.ajax({
            type:'POST', 
            url: "index.php?path=user/showEditForm",
            data: {id},
            success: function(data){ 
                data = $.parseJSON(data.split('<')[0]); 

                $('.user_account_catalog_list').fadeOut(150);
                $('.user_account_edit_block').fadeIn(150);
                $('#edit_article').attr('value', data['id']);
                $('#edit_category option[value='+data['category']+']').attr('selected', 'selected'); 
                $('#edit_brand option[value='+data['brand']+']').attr('selected', 'selected'); 
                $('#edit_color option[value='+data['color']+']').attr('selected', 'selected');
                $('#edit_season option[value='+data['season']+']').attr('selected', 'selected');
                $('#edit_model').attr('value', data['model']);
                $('#edit_material').attr('value', data['material']);
                $('#edit_description').html(data['description']);
                $('#edit_price').attr('value', data['price']);
                $('#edit_img').attr('src', 'assets/img/catalog/'+data['img']);
           },
        });
     }));

     /**
	 * Админ: Выход из редактировния товара и очистка формы
	 */
     $('.user_account_edit_back_link').on('click', function(e){
        e.preventDefault();
        $('.user_account_edit_block').fadeOut(150);
        $('.user_account_catalog_list').fadeIn(150); 
        $('#edit_article').removeAttr('value');
        $('#edit_category option[selected=selected]').removeAttr('selected'); 
        $('#edit_brand option[selected=selected]').removeAttr('selected'); 
        $('#edit_color option[selected=selected]').removeAttr('selected');
        $('#edit_season option[selected=selected]').removeAttr('selected');
        $('#edit_model').removeAttr('value');
        $('#edit_material').removeAttr('value');
        $('#edit_description').html('');
        $('#edit_price').removeAttr('value');
        $('#edit_img').removeAttr('src');   
     })

    /**
	 * Админ: Отправка данных с формы редактирования товара
	 */
     $('#edit_good_form').on('submit',(function(e) {      
        e.preventDefault();
        let formData = new FormData($('#edit_good_form')[0]);
        $.ajax({
            type:'POST', 
            url: 'index.php?path=user/editGood', 
            data:formData, 
            cache:false, 
            contentType: false, 
            processData: false, 
            success:function(data){
                $('.user_account_catalog_list').load('index.php?path=user/account .user_account_catalog_list');
                $('.user_account_edit_block').fadeOut(150);
                $('.user_account_catalog_list').fadeIn(150);  
            },
        });
    })); 
});
