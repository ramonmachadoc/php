<?php

/**
 * This is the model class for table "user_message".
 *
 * The followings are the available columns in table 'user_message':
 * @property integer $id
 * @property string $login
 * @property integer $id_funcionario
 *
 * The followings are the available model relations:
 * @property UserDevices[] $userDevices
 */
class UserMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, id_funcionario', 'required'),
			array('id_funcionario', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, id_funcionario', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userDevices' => array(self::HAS_MANY, 'UserDevices', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'id_funcionario' => 'Id Funcionario',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('id_funcionario',$this->id_funcionario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*public function behaviors()
	{
		return array(
			'RestModelBehavior' => array(
				'class' => 'WRestModelBehavior',
			)
		);
	}*/

	public function createfollow($user, $device)
	{
		$result = $this->findByAttributes(array('login' => $user->login));

		if (count($result) > 0) {
			$result2 = UserDevices::model()->findByAttributes(array('imei' => $device->imei));
			if (count($result2) > 0) {
				$result2->registrationid = $device->registrationid;
				$result2->update();
			} else {
				$userDevices = new UserDevices();
				$userDevices->attributes = (array)$device;
				$userDevices->user_id = $result->id;

				$userDevices->save();
			}
			return 3;
		} else {
			$this->attributes = (array)$user;
			$transaction = Yii::app()->db->beginTransaction();

			if ($this->save()) {
				$userDevices = new UserDevices();
				$userDevices->attributes = (array)$device;
				$userDevices->user_id = $this->id;

				if ($userDevices->save()) {
					$transaction->commit();
					return 4;
				} else {
					$transaction->rollback();
					return 5;
				}
			} else {
				$transaction->rollback();
				return 5;
			}
		}
	}
}
