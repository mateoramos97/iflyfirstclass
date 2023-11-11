<?php
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<div class="filter-block-wrapper">
    <div class="filter-block-innre">
        <form action="" method="get">
            <div class="component component-radio">
                <input type="radio" id="c-0" name="continent_id" value="0"
                    <?php echo isset($filter_values['continent_id']) && $filter_values['continent_id'] == 0 ? 'checked="checked"' : '' ?>>
                <label for="c-0">World</label>
                <?php foreach($parametrs['continents'] as $key => $item) { ?>
                    <input type="radio" id="c-<?php echo Html::encode($item['id']); ?>" name="continent_id" value="<?php echo Html::encode($item['id']);?>"
                        <?php echo isset($filter_values['continent_id']) && $filter_values['continent_id'] == $item['id'] ? 'checked="checked"' : '' ?>>
                    <label for="c-<?php echo Html::encode($item['id']); ?>"><?php echo Html::encode($item['name']);?></label>
                <?php } ?>
            </div>
            <div class="component component-text">
                <input type="text" name="name" value="<?php echo isset($filter_values['name']) ? $filter_values['name'] : ''; ?>" placeholder="Name">
            </div>
            <div class="component component-select">
                <select name="order_by_id">
                    <option value="DESC" <?php echo isset($filter_values['order_by_id']) && $filter_values['order_by_id'] == 'DESC' ? 'selected="selected"' : '' ?>>Order by DESC</option>
                    <option value="ASC" <?php echo isset($filter_values['order_by_id']) && $filter_values['order_by_id'] == 'ASC' ? 'selected="selected"' : '' ?>>Order by ASC</option>
                </select>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>
