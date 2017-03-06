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

<p>Please drag to change your sequence.</p>
<ul class="block">
    <?php
         foreach ($device as $key => $value){
             echo '<li class="slide slide1"  id= "'. $value->id .'">'.$value->sequence.  " - ". $value->mediaFile->name .'</li>';
         }
    ?>
</ul>

<button onclick="test()" class="btn btn-primary">Update order</button>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script>

//    $('.block').sortable({update: sortOtherList});
    $('.block').sortable({});


    function sortOtherList(){

        $('.block li').each(function(){

            $('.secondblock [data-block-id=' + $(this).attr('id') + ']')
                .remove()
                .appendTo($('.secondblock'));

        });
    }

    function test() {
        var IDs = [];
        var id = <?= $model->id ?>;
//            alert(model);
        $(".block").find("li").each(function(){ IDs.push(this.id); });
//        alert(JSON.stringify(IDs));
        $.ajax({
            url: '../sort',
            type: 'post',
            data: {
                model: IDs,
                id: id
//                status: $status
            },
            success: function (data) {
//                alert(data);
            },
            error: function (jqXHR, errMsg) {
                // handle error
//                flag = false;
//                alert(errMsg + $status + jqXHR);
            }
        });


    }

</script>

