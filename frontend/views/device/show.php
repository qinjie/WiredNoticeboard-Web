<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 2/3/17
 * Time: 10:02 AM
 */
use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="slides">
    <?php
         foreach ($device as $key => $value){
    //         foreach ($value as $k => $item){
    //             echo $item . "<br>";
    //         }
             echo '<li class="slide slide1">' .$value->sequence.'</li>';
//             echo $value->sequence;
         }

    ?>
</ul>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script>

    $(".slides").sortable({
        placeholder: 'slide-placeholder',
        axis: "y",
        revert: 150,
        start: function(e, ui){

            placeholderHeight = ui.item.outerHeight();
            ui.placeholder.height(placeholderHeight + 15);
            $('<div class="slide-placeholder-animator" data-height="' + placeholderHeight + '"></div>').insertAfter(ui.placeholder);

        },
        change: function(event, ui) {

            ui.placeholder.stop().height(0).animate({
                height: ui.item.outerHeight() + 15
            }, 300);

            placeholderAnimatorHeight = parseInt($(".slide-placeholder-animator").attr("data-height"));

            $(".slide-placeholder-animator").stop().height(placeholderAnimatorHeight + 15).animate({
                height: 0
            }, 300, function() {
                $(this).remove();
                placeholderHeight = ui.item.outerHeight();
                $('<div class="slide-placeholder-animator" data-height="' + placeholderHeight + '"></div>').insertAfter(ui.placeholder);
            });

        },
        stop: function(e, ui) {

            $(".slide-placeholder-animator").remove();

        },
    });


</script>

