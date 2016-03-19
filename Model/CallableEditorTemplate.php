<?php
/**
 * [Model] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplate extends BcPluginAppModel
{
	/**
	 * ModelName
	 * 
	 * @var string
	 */
	public $name = 'CallableEditorTemplate';

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
	 * belongsTo
	 * 
	 * @var array
	 */
	public $belongsTo = array(
		'EditorTemplate' => array(
			'className'	=> 'EditorTemplate',
			'foreignKey' => 'editor_template_id',
		)
	);

	/**
	 * バリデーション
	 *
	 */
	public $validate = array(
	);

}
