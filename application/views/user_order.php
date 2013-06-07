<div class="row" style="margin-top: 40px">
    <div class="span8 offset1">

        <?php foreach ($orders as $item):
//            var_dump($item);
            ?>
            <div class="well row">
                <div class="span1">
                    <ul class="unstyled">
                        <li><a href="/users/<?php echo $item->foodOwner ?>">
                                <strong>
                                    <?php echo $item->foodOwnerName ?>
                                </strong>
                            </a>
                        </li>
                        <li>
                            <?php
                            $eatDate = date_parse_from_format("Y-m-d\TH:i:s.Z", $item->eatDate);
                            echo $eatDate['month'] . '月' . $eatDate['day'] . '号';
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="span5">
                    <ul class="unstyled">

                        <li>带的<strong><?php echo $item->name ?></strong></li>
                        <li id="li-comment-<?php echo $item->objectId ?>">
                            <?php if ($logged_in && $userid == $user->objectId) {
                                if ($item->comment) {
                                    echo '<blockquote>' . $item->comment . '</blockquote>';
                                } else {
                                    echo "<textarea id='comment-" . $item->objectId . "' style='width:590px' placeholder='吃过了，说两句吧'></textarea>";
                                    echo "<p class='btn'><a data-orderid='" . $item->objectId . "' data-baseUrl='" . base_url() . "' class='comment-button' onclick='return false' href='#'><span><b></b><em>评论</em></span></a></p>";
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