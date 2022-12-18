<?php

/**
 * [Model] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateConfig extends BcPluginAppModel {

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
	 * 初期値を取得する
	 *
	 * @return array
	 */
	public function getDefaultValue() {
		$data = array(
			$this->name => array(
				'status'		 => false,
				'auto_display'	 => true,
				'title'			 => Configure::read('CallableEditorTemplate.label_name'),
			),
		);
		return $data;
	}

}
