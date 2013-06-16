<div class="row-fluid">

    <div class="span6 offset3">

        <fieldset>
            <legend>记录咱家的美食</legend>
            <div class="span12">
                <input type="text" name="recipe_name" id="recipe_name" value="<?php echo set_value('recipe_name'); ?>" placeholder="菜名">
            </div>
            <div class="span12" id="fsUploadProgress"></div>
            <div class="span12">
                <span id="swfbtn"></span>
                <span style="color: #999999">支持上传最多6张图片！ 支持JPG、 GIF或PNG格式。</span>
            </div>

            <div class="span12">
                <textarea class="span10" name="recipe_describe" id="recipe_describe" placeholder="你此刻的想法"><?php echo set_value('recipe_describe'); ?></textarea>
            </div>
            <div class="span12">
                <input id="recipe_create" value="发布" type="submit" class="btn btn-primary ">
            </div>
        </fieldset>
    </div>
</div>
