<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 3/3/17
 * Time: 9:22 AM
 */

namespace api\common\models;

use Yii;

class MediaFile extends \common\models\MediaFile
{
    public function  fields()
    {
        $new = [];
        $fields = array_merge(parent::fields(), $new);
//        unset($fields['link']);
        return $fields;
    }

    public function extraFields()
    {
        $new = [];
        $fields = array_merge(parent::fields(), $new);
        return $fields;
    }

}