<?php

namespace common\models\form;

use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;

class ChangeEmailForm extends Model
{
    public $email;

    /**
     * @var User
     */
    private $_user;

    /**
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }

    public function init()
    {
        $this->email = $this->_user->email;
        parent::init();
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => 'Email already exists.',
                'filter' => function (ActiveQuery $query) {
                    $query->andWhere(['<>', 'id', $this->_user->id]);
                },
            ],
            ['email', 'string', 'max' => 255],
        ];
    }

    /**
     * @return bool
     */
    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
} 