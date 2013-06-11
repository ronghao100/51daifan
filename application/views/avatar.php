<div>

    <?php echo form_open_multipart('account/upload_avatar'); ?>

    <fieldset>
        <legend>添加或更改你的头像</legend>
        <?php echo $error; ?>
        <div class="row-fluid">
            <div class="span2 offset1">
                <div style="padding: 2px;border: 1px solid #E8E8E8;height: 140px;width: 140px;">
                    <img style="height: 140px;width: 140px;" src="<?php
                    if ($avatar) {
                        echo $avatar;
                    } else {
                        echo base_url().'application/views/images/large_avatar.png';
                    }
                    ?>">
                </div>
            </div>
            <div class="span3">
                <ul class="unstyled">
                    <h4>从电脑中选择你喜欢的照片:</h4>
                    <li>你可以上传JPG、JPEG、GIF或PNG文件。</li>
                    <li>
                        <input type="file" name="userfile" size="20"/>

                        <br/><br/>

                        <input type="submit" value="设置头像"/>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2 offset1">
                <h4>这是你的小头像图标:</h4>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2 offset1">
                <div style="padding: 2px;border: 1px solid #E8E8E8;height: 50px;width: 50px;">
                    <img style="height: 50px;width: 50px;" src="<?php
                    if ($avatar_thumbnail) {
                        echo $avatar_thumbnail;
                    } else {
                        echo base_url().'application/views/images/medium_avatar.png';
                    }
                    ?>">
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span2 offset1" style="margin-top: 20px">
                <a class="btn btn-primary" href='/users/<?php echo $userid; ?>'>好了，很靓</a>
            </div>
        </div>
    </fieldset>

    </form>

</div>