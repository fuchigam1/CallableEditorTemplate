<?php

/**
 * [Model] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateConfig extends BcPluginAppModel
{

	/**
	 * ModelName
	 * 
	 * @var string
	 */
	public $name = 'CallableEditorTemplateConfig';

	/**
	 * PluginName
	 * 
	 * @var string
	 */
	public $plugin = 'CallableEditorTemplate';

	/**
	 * actsAs
	 * 
	 * @var array
	 */
	public $actsAs = array('BcCache');

	/**
	 * バリデーション
	 *
	 */
	public $validate = array(
		'model' => array(
			'notEmpty'	 => array(
				'rule'		 => array('notEmpty'),
				'message'	 => 'モデル名を入力してください。',
			),
			'maxLength'	 => array(
				'rule'		 => array('maxLength', 255),
				'message'	 => 'モデル名は255文字以内で入力してください。',
			),
		),
	);

	/**
	 * 初期値を取得する
	 *
	 * @return array
	 */
	public function getDefaultValue()
	{
		$data = array(
			$this->name => array(
				'status' => false,
				'title'	 => Configure::read('CallableEditorTemplate.label_name'),
			),
		);
		return $data;
	}

}
