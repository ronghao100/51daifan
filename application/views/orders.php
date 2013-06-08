<div class="row-fluid">

    <div class="span8">
        <div class="row-fluid">
            <div class="page-header columns">
                <h1>我吃过</em></h1>
            </div>
        </div>
        <?php foreach ($orders as $item):
            ?>
            <div class="row-fluid">
                <div class="span12 well">
                    <div class="span2">
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
                    <div class="span10">
                        <ul class="unstyled">
                            <li>带的<strong><?php echo $item->name ?></strong></li>
                            <li id="li-comment-<?php echo $item->objectId ?>">
                                <?php if ($item->comment) {
                                    echo '<blockquote>' . $item->comment . '</blockquote>';
                                } else {
                                    echo "<textarea id='comment-" . $item->objectId . "' style='width:650px' placeholder='吃过了，说两句吧'></textarea>";
                                    echo "<p class='btn'><a data-orderid='" . $item->objectId . "' data-baseUrl='" . base_url() . "' class='comment-button' onclick='return false' href='#'><span><b></b><em>评论</em></span></a></p>";
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        endforeach
        ?>
    </div>

    <div class="span4">
        <div class="row-fluid">
            <div class="span12 well columns">
                <ul class="unstyled">
                    <li><a href="/users/<?php echo $userid ?>"><strong><?php echo $realname ?></strong></a></li>
                    <li>带过 <a href="/posts"><?php echo $post_count ?></a></li>
                    <li>吃过 <a href="/orders"><?php echo $order_count ?></a></li>
                    <li>帮助人数 <em style="color: green"><?php echo $order_count ?></em></li>
                </ul>
            </div>
        </div>
    </div>
</div>



