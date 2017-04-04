<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tariffs}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property integer $count_tours
 * @property integer $count_up_tours
 * @property integer $count_visas
 * @property integer $count_up_visas
 * @property integer $news
 * @property integer $count_responses
 * @property integer $count_managers
 * @property integer $placement
 * @property integer $recommend
 */
class Tariffs extends \yii\db\ActiveRecord
{
    const INFINITY_NUMBER = 999;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tariffs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price', 'count_tours', 'count_up_tours', 'count_visas', 'count_up_visas', 'news', 'count_responses', 'count_managers', 'placement', 'recommend'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'count_tours' => 'Count Tours',
            'count_up_tours' => 'Count Up Tours',
            'count_visas' => 'Count Visas',
            'count_up_visas' => 'Count Up Visas',
            'news' => 'News',
            'count_responses' => 'Count Responses',
            'count_managers' => 'Count Managers',
            'placement' => 'Placement',
            'recommend' => 'Recommend',
        ];
    }

    public function getText($attribute) {
        $text = '';

        switch ($attribute) {
            case 'count_tours':
                $text = $this->count_tours == self::INFINITY_NUMBER ? '∞ туров в каталоге' :
                    Yii::t('app',
                        '{0, plural, one{# тур} few{# тура} other{# туров}} в каталоге',
                        $this->count_tours
                    );
                break;
            case 'count_up_tours':
                $text = Yii::t('app',
                    '{0, plural, one{# ап} few{# апа} other{# апов}} туров в каталоге',
                    $this->count_up_tours
                );
                break;
            case 'count_visas':
                $text = $this->count_visas == 0 ? 'визы' :
                    Yii::t('app',
                        '{0, plural, one{# виза} few{# виз} other{# визы}}',
                        $this->count_visas
                    );
                break;
            case 'count_up_visas':
                $text = $this->count_up_visas == 0 ? 'апы виз' :
                    Yii::t('app',
                        '{0, plural, one{# ап} few{# апа} other{# апов}} виз',
                        $this->count_up_visas
                    );
                break;
            case 'count_responses':
                if ($this->count_responses == 0)
                    $text = 'отклики на заявки';
                elseif ($this->count_responses == self::INFINITY_NUMBER)
                    $text = '∞ откликов на заявки';
                else
                    $text = Yii::t('app',
                        '{0, plural, one{# отклик} few{# отклика} other{# откликов}} на заявки',
                        $this->count_responses
                    );
                break;
            case 'count_managers':
                $text = Yii::t('app',
                    '{0, plural, one{# аккаунт} other{# аккаунтов}} менеджера',
                    $this->count_managers
                );
                break;
        }
        return $text;
    }
}
