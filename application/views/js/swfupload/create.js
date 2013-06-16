$(document).ready(function () {
    var swfu = new SWFUpload(settings);

    $('#recipe_create').bind('click', addRecipeInfo);
});

var settings = {
    flash_url: "/application/views/js/swfupload/swfupload.swf",
    upload_url: "/recipes/add_image",

    file_size_limit: "8 MB",
    file_types: "*.png;*.jpg;*.gif",
    file_types_description: "png,jpg,gif,jpeg",
    file_upload_limit: 6,
    file_queue_limit: 0,
    custom_settings: {
        progressTarget: "fsUploadProgress"
    },
    debug: false,

    button_image_url: "/application/views/images/swfupload/buttonupd.png",
    button_width: "120",
    button_height: "48",
    button_placeholder_id: "swfbtn",
    button_text: '<span class="theFont"></span>',
    button_text_style: ".theFont { font-size: 16px;}",
    button_text_left_padding: 12,
    button_text_top_padding: 3,
    button_cursor: SWFUpload.CURSOR.HAND,

    swfupload_preload_handler: preLoad,
    file_queued_handler: fileQueued,
    file_queue_error_handler: fileQueueError,
    file_dialog_complete_handler: fileDialogComplete,
    upload_start_handler: uploadStart,
    upload_progress_handler: uploadProgress,
    upload_error_handler: uploadError,
    upload_success_handler: uploadSuccess,
    upload_complete_handler: uploadComplete
};

function delimg(obj) {
    $(obj).parents('.prtp').remove();
}


function addRecipeInfo() {
    var imagelen = $(".prtp").length;
    if (imagelen == 0) {
        alert('亲，无图无真相');
        return false;
    }

    var recipe_describe = $("#recipe_describe").val();

    var recipe_name = $("#recipe_name").val();
    if (recipe_name.length == 0) {
        alert('亲，菜名');
        return false;
    }

    var images = '';
    if ($('.prtp').size() > 0) {
        $('.prtp').each(function (k, v) {
            images += '&img[]=' + encodeURIComponent($(v).find('img').attr('src'));
        })
    }

    $.ajax({
        type: 'post',
        url: '/recipes/do_create',
        data: '&name=' + recipe_name + '&describe=' + recipe_describe + images,
        dataType: 'json',
        complete: function (data) {
            window.location.href = '/recipes';
        }
    })
}

