<?php
/**
 * Created by PhpStorm.
 * User: tungphung
 * Date: 3/3/17
 * Time: 9:22 AM
 */

namespace api\common\models;

use Yii;

class Device extends \common\models\Device
{
    public function  fields()
    {
        return parent::fields(); // TODO: Change the autogenerated stub
    }

    public function extraFields()
    {
        $new = ['deviceMedia', 'media', 'playlist'];
        $fields = array_merge(parent::fields(), $new);
        return $fields;
    }

}