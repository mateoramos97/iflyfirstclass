<?php
/**
 * Created by PhpStorm.
 * User: Valeriy
 * Date: 17.06.2016
 * Time: 16:46
 */
?>

<div class="imagemanager-unorderedstyle-component">

    <div class="config">{"Path":"<?php echo $config['path']; ?>","ModelPrefix":"<?php echo $config['model_prefix']; ?>",
        "Route":"<?php echo $config['route']; ?>",
        "EnableReplaceButton":<?php echo $config['enable_replace_button'] ? 'true' : 'false' ?>,
        "EnableDeleteButton":<?php echo $config['enable_delete_button'] ? 'true' : 'false' ?>,
        "EnableAddButton":<?php echo $config['enable_add_button'] ? 'true' : 'false' ?>,
        "EnableTitle":<?php echo $config['enable_title'] ? 'true' : 'false' ?>,
        "ContentID":<?php echo $config['content_id']; ?>,"ContentFieldID":<?php echo $config['content_field_id']; ?>,
        "EnableRotateButton":<?php echo $config['enable_rotate_button'] ? 'true' : 'false' ?>}</div>
    <div class="dropzone-wrapper">
        <div class="dropzone"></div>
    </div>

    <div class="gallery-photo-link">
        <ul class="sortable">

            <?php $loc_view_ind = 0; ?>

            <? foreach($images as $image): ?>
                <?php if(count($images)!= 0) { ?>
                    <li>
                        <?php if ($config['enable_mainimage_button']) { ?>

                        <form action="<?php echo $config['route']; ?>/mainimage" method="post">

                            <?php } ?>
                            <div class="file-process-wrapper hidden">
                                <span class="icon"></span>
                            </div>
                            <div class="file-add-wrapper <?php echo isset($image['alias']) && $image['alias'] !== NULL ? 'hidden' : ''; ?>">
                                <a href="#" class="addfile-link"></a>
                            </div>
                            <div class="file-added-wrapper <?php echo isset($image['alias']) && $image['alias'] === NULL ? 'hidden' : ''; ?>">
                                <div class="actions">
                                    <a href="#" class="rotate-link"></a>
                                    <a href="#" class="replace-link"></a>
                                    <a href="#" class="delete-link"></a>
                                </div>
                                <img src="<?php echo isset($image['alias']) && $image['alias'] !== NULL ? URL::base() .'public/images/'. $image['alias'] : ''; ?>" title="" alt="" class="addedimg" />

                                <?php if ($config['enable_mainimage_button']) { ?>

                                    <span class="profile-photo">
                            <input type="submit" class="profile-photo-link" value="Make Profile Photo">
                        </span>

                                <?php } ?>

                                <a id="gallery-link" class="gallery-link" href="<?php echo isset($image['alias']) && $image['alias'] !== NULL ? URL::base() .'public/images/'. $image['alias'] : ''; ?>">
                                    <div class="gallery-link-link">View</div>
                                </a>

                            </div>
                            <div class="components-wrapper">
                                <input type="hidden" name="content_id" value="<?php echo $config['content_id']; ?>">
                                <input type="hidden" name="content_field_id" value="<?php echo $config['content_field_id']; ?>">
                                <input class="file-alias" name="image[<?php echo $loc_view_ind; ?>][alias]" type="hidden" value="<?php echo isset($image['alias']) ? $image['alias'] : ''; ?>" />
                                <input class="file-title" name="image[<?php echo $loc_view_ind; ?>][title]" type="hidden" value="<?php echo isset($image['alias']) ? $image['alias'] : ''; ?>" />
                                <input class="file-queue" name="image[<?php echo $loc_view_ind; ?>][queue]" type="hidden" value="<?php echo isset($image['alias']) ? $image['alias'] : ''; ?>" />
                            </div>

                            <?php if ($config['enable_mainimage_button']) { ?>

                        </form>

                    <?php } ?>
                    </li>
                <?php } ?>
                <?php $loc_view_ind++; ?>
            <? endforeach; ?>


            <li>

                <?php if ($config['enable_mainimage_button']) { ?>

                <form action="<?php echo $config['route']; ?>/mainimage" method="post">

                    <?php } ?>

                    <div class="file-process-wrapper hidden">
                        <span class="icon"></span>
                    </div>
                    <div class="file-add-wrapper ">
                        <a href="#" class="addfile-link"></a>
                    </div>
                    <div class="file-added-wrapper hidden">
                        <div class="actions">
                            <a href="#" class="rotate-link"></a>
                            <a href="#" class="replace-link"></a>
                            <a href="#" class="delete-link"></a>
                        </div>
                        <img src="#" title="" alt="" class="addedimg" />

                        <?php if ($config['enable_mainimage_button']) { ?>

                            <span class="profile-photo">
                            <input type="submit" class="profile-photo-link" value="Make Profile Photo">
                        </span>

                        <?php } ?>

                    </div>
                    <div class="components-wrapper">
                        <input type="hidden" name="content_id" value="<?php echo $config['content_id']; ?>">
                        <input type="hidden" name="content_field_id" value="<?php echo $config['content_field_id']; ?>">
                        <input class="file-alias" name="image[<?php echo $loc_view_ind; ?>][alias]" type="hidden" value="" />
                        <input class="file-title" name="image[<?php echo $loc_view_ind; ?>][title]" type="hidden" value="" />
                        <input class="file-queue" name="image[<?php echo $loc_view_ind; ?>][queue]" type="hidden" value="0" />
                    </div>

                    <?php if ($config['enable_mainimage_button']) { ?>

                </form>

            <?php } ?>

            </li>

        </ul>
    </div>
    <div class="fineuploader-component"></div>

</div>
