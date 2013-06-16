<div class="row-fluid">
    <div class="span2 offset2">
        <ul class="unstyled">
            <li style="padding: 2px;border: 1px solid #E8E8E8;height: 140px;width: 140px;">
                <img style="height: 140px;width: 140px;" src="<?php
                if ($user->avatar) {
                    echo $user->avatar;
                } else {
                    echo base_url() . 'application/views/images/large_avatar.png';
                }
                ?>" alt="<?php echo $user->realname ?>">
            </li>
            <li style="text-align: center">
                <?php if ($logged_in && $userid == $user->objectId) {
                    echo '<a href="/account/avatar">更新头像</a>';
                } ?>
            </li>
        </ul>
    </div>
    <div class="span4">
        <div>
            <div>
                <h3><?php echo $user->realname ?></h3>
            </div>
            <div id="edit_intro">
                <span id="intro_display" style="display: inline;"><?php echo $user->introduce ?></span>
                <?php if ($logged_in && $userid == $user->objectId) {
                    echo '<span style="display: inline;" id="intro_disp_act">(<a href="#" class="">编辑</a>)</span>';
                } ?>
                <span style="display: none;" id="edit_intro_span">
                        <textarea id="intro" class='span12' placeholder="说说自己吧" style="overflow: hidden; height: 56px;"><?php echo $user->introduce ?></textarea><br>
                        <input type="submit" data-baseUrl="<?php echo base_url() ?>" value="保存" class="submit"
                               id="intro_submit">
                        <input type="button" value="取消" class="cancel" id="intro_cancel">
                </span>
                <span style="display: none;" id="intro_error"></span>
            </div>
            <div id="edit_address">
                <i class="icon-map-marker"></i><span id="address_display" style="display: inline;"><?php echo $user->address ?></span>
                <?php if ($logged_in && $userid == $user->objectId) {
                    echo '<span style="display: inline;" id="address_disp_act">(<a href="#" class="">编辑</a>)</span>';
                } ?>
                <span style="display: none;" id="edit_address_span">
                        <textarea id="address" class='span12' placeholder="我的工作地点" style="overflow: hidden; height: 56px;"><?php echo $user->address ?></textarea><br>
                        <input type="submit" data-baseUrl="<?php echo base_url() ?>" value="保存" class="submit"
                               id="address_submit">
                        <input type="button" value="取消" class="cancel" id="address_cancel">
                </span>
                <span style="display: none;" id="address_error"></span>
            </div>
        </div>
    </div>
    <div class="span2">
        <div style="background: none repeat scroll 0 0 #E9E1DA;padding: 10px 0;height: 36px">
            <ul class="unstyled">
                <li style="float: left;width: 61px;text-align: center"><a href="#"><?php echo $post_count ?></a><br/>带过
                </li>
                <li style="float: left;width: 61px;text-align: center"><a href="#"><?php echo $order_count ?></a><br/>吃过
                </li>
                <li style="float: left;width: 61px;text-align: center"><a href="#"><?php echo $recipe_count ?></a><br/>日记
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span5 offset4">
        <?php if ($logged_in && $userid == $user->objectId) {
            ?>
            <ul class="nav nav-pills">
                <li <?php if ($title == 'ipost') {
                    echo 'class="active"';
                } ?>>
                    <a href="/users/post/<?php echo $userid ?>">我带过的饭</a>
                </li>
                <li <?php if ($title == 'irecipe') {
                    echo 'class="active"';
                } ?>><a href="/users/recipe/<?php echo $userid ?>">我家美食</a></li>
                <li <?php if ($title == 'iorder') {
                    echo 'class="active"';
                } ?>><a href="/users/order/<?php echo $userid ?>">我吃过的饭</a></li>
                <li <?php if ($title == 'icomment') {
                    echo 'class="active"';
                } ?>>
                    <a href="/users/comment/<?php echo $userid ?>">我收到的评价</a>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="nav nav-pills">
                <li <?php if ($title == 'ipost') {
                    echo 'class="active"';
                } ?>>
                    <a href="/users/post/<?php echo $user->objectId ?>">TA带过的饭</a>
                </li>
                <li <?php if ($title == 'irecipe') {
                    echo 'class="active"';
                } ?>><a href="/users/recipe/<?php echo $user->objectId ?>">TA家美食</a></li>
                <li <?php if ($title == 'iorder') {
                    echo 'class="active"';
                } ?>><a href="/users/order/<?php echo $user->objectId ?>">TA吃过的饭</a></li>
                <li <?php if ($title == 'icomment') {
                    echo 'class="active"';
                } ?>>
                    <a href="/users/comment/<?php echo $user->objectId ?>">TA收到的评价</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>