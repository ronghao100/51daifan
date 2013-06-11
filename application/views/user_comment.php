<div class="row" style="margin-top: 40px">
    <div class="span8 offset1">

        <?php foreach ($comments as $item):
//            var_dump($item);
            ?>
            <div class="well row">
                <div class="span1">
                    <ul class="unstyled">
                        <li><a href="/users/<?php echo $item->owner ?>">
                                <img style="height: 50px;width: 50px;"
                                     src="<?php
                                     if ($item->avatarThumbnail) {
                                         echo $item->avatarThumbnail;
                                     } else {
                                         echo base_url().'application/views/images/medium_avatar.png';
                                     }
                                     ?>" alt="<?php echo $item->ownerName ?>">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="span5">
                    <ul class="unstyled">

                        <li>
                            <span>
                                <a href="/users/<?php echo $item->owner ?>">
                                    <strong>
                                        <?php echo $item->ownerName ?>
                                    </strong>
                                </a>
                            </span>
                            <span><?php echo $item->updatedAt;?> 说</span>
                        </li>
                        <li>
                            <?php echo '<blockquote>' . $item->comment . '</blockquote>'; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        endforeach
        ?>

    </div>
</div>