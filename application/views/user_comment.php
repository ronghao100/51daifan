<div class="row-fluid" style="margin-top: 40px">
    <div class="span6 offset2">

        <?php foreach ($comments as $item):
//            var_dump($item);
            ?>
            <div class="row-fluid" style="border-bottom: 1px solid #EAEAE2;margin-bottom: 10px">
                <div class="span1" style="width:50px">
                    <ul class="unstyled">
                        <li><a href="/users/<?php echo $item->owner ?>">
                                <img style="height: 50px;width: 50px;"
                                     src="<?php
                                     if ($item->avatarThumbnail) {
                                         echo $item->avatarThumbnail;
                                     } else {
                                         echo base_url() . 'application/views/images/medium_avatar.png';
                                     }
                                     ?>" alt="<?php echo $item->ownerName ?>">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="span10">
                    <ul class="unstyled">

                        <li>
                            <span>
                                <a href="/users/<?php echo $item->owner ?>">
                                    <strong>
                                        <?php echo $item->ownerName ?>
                                    </strong>
                                </a>
                            </span>
                        </li>
                        <li style="margin-bottom: 10px;margin-top: 10px">
                            <?php echo $item->comment; ?>
                        </li>
                        <li>
                            <?php echo $item->updatedAt; ?>

                        </li>
                    </ul>
                </div>
            </div>
        <?php
        endforeach
        ?>

    </div>
</div>