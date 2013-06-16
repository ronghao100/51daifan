<div class="row-fluid" style="margin-top: 40px">
    <div class="span6 offset2">

        <?php foreach ($orders as $item):
//            var_dump($item);
            ?>
            <div class="row-fluid" style="border-bottom: 1px solid #EAEAE2;margin-bottom: 10px">
                <div class="span1" style="width:50px">
                    <ul class="unstyled">
                        <li><a href="/users/<?php echo $item->foodOwner ?>">
                                <img style="height: 50px;width: 50px;"
                                     src="<?php
                                     if ($item->avatarThumbnail) {
                                         echo $item->avatarThumbnail;
                                     } else {
                                         echo base_url() . 'application/views/images/medium_avatar.png';
                                     }
                                     ?>" alt="<?php echo $item->foodOwnerName ?>">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="span10">
                    <ul class="unstyled">
                        <li>
                            <span>
                                <a href="/users/<?php echo $item->foodOwner ?>">
                                    <strong>
                                        <?php echo $item->foodOwnerName ?>
                                    </strong>
                                </a>
                            </span>
                        </li>
                        <li style="margin-bottom: 10px;margin-top: 10px">
                            <span>
                                <?php
                                $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                                echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                                ?>
                            </span>
                            <span>
                             带的 <strong><?php echo $item->name ?></strong>
                            </span>
                        </li>
                        <li id="li-comment-<?php echo $item->objectId ?>">
                            <?php if ($logged_in && $userid == $user->objectId) {
                                if ($item->comment) {
                                    echo '<blockquote>' . $item->comment . '</blockquote>';
                                } else {
                                    echo "<textarea id='comment-" . $item->objectId . "' style='width:514px' placeholder='吃过了，说两句吧'></textarea>";
//                                    echo "<li><i class='icon-picture'></i>";
                                    echo "<p class='btn' style='float:right'>
                                    <a data-orderid='" . $item->objectId . "' data-baseUrl='" . base_url() . "'
                                    class='comment-button' onclick='return false' href='#'><span><b></b><em>评论</em></span></a></p></li>";
                                }
                            } else {
                                if ($item->comment) {
                                    echo '<blockquote>' . $item->comment . '</blockquote>';
                                } else {
                                    echo '<blockquote>这勤劳的吃货只记得吃忘记写评论了</blockquote>';
                                }
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        endforeach
        ?>

    </div>
</div>