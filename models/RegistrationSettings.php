<?php

namespace core\models;

use app\models\mlm_user\MlmRegistrationSources;
use app\modules\api\models\MlmUser;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "registration_settings".
 *
 * @property int $id Id
 * @property int $mlm_user_id Пользователь
 * @property int $linear_mentor Линейный наставник
 * @property int $binar_mentor Бинарный наставник
 * @property int|null $side Сторона бинарной регистрации
 * @property int|null $registration_source Источник регистрации
 * @property string|null $created_at Время создания
 *
 * @property MlmUser $binarMentor
 * @property MlmUser $linearMentor
 * @property MlmUser $mlmUser
 * @property MlmRegistrationSources $registrationSources
 */
class RegistrationSettings extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'registration_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['mlm_user_id', 'linear_mentor', 'binar_mentor'], 'required'],
            [['mlm_user_id', 'linear_mentor', 'binar_mentor', 'side', 'registration_source'], 'integer'],
            [['created_at'], 'safe'],
            [['mlm_user_id', 'registration_source'], 'unique', 'targetAttribute' => ['mlm_user_id', 'registration_source']],
            [['binar_mentor'], 'exist', 'skipOnError' => true, 'targetClass' => MlmUser::class, 'targetAttribute' => ['binar_mentor' => 'id']],
            [['linear_mentor'], 'exist', 'skipOnError' => true, 'targetClass' => MlmUser::class, 'targetAttribute' => ['linear_mentor' => 'id']],
            [['registration_source'], 'exist', 'skipOnError' => true, 'targetClass' => MlmRegistrationSources::class, 'targetAttribute' => ['registration_source' => 'id']],
            [['mlm_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MlmUser::class, 'targetAttribute' => ['mlm_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'Id',
            'mlm_user_id' => 'Пользователь',
            'linear_mentor' => 'Линейный наставник',
            'binar_mentor' => 'Бинарный наставник',
            'side' => 'Сторона бинарной регистрации',
            'registration_source' => 'Источник регистрации',
            'created_at' => 'Время создания',
        ];
    }

    public function getBinarMentor(): ActiveQuery
    {
        return $this->hasOne(MlmUser::class, ['id' => 'binar_mentor']);
    }

    public function getLinearMentor(): ActiveQuery
    {
        return $this->hasOne(MlmUser::class, ['id' => 'linear_mentor']);
    }

    public function getRegistrationSources(): ActiveQuery
    {
        return $this->hasOne(MlmRegistrationSources::class, ['id' => 'registration_source']);
    }

    public function getMlmUser(): ActiveQuery
    {
        return $this->hasOne(MlmUser::class, ['id' => 'mlm_user_id']);
    }
}
