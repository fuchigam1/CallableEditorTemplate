<?php

/**
 * [ControllerEventListener] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateControllerEventListener extends BcControllerEventListener
{

	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'initialize',
	);

	/**
	 * initialize
	 * CallableEditorTemplateヘルパーを追加する
	 * 
	 * @param CakeEvent $event
	 */
	public function initialize(CakeEvent $event)
	{
		$Controller				 = $event->subject();
		$Controller->helpers[]	 = 'CallableEditorTemplate.CallableEditorTemplate';
	}

}
