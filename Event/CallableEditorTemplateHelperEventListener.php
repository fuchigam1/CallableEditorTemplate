<?php
/**
 * [HelperEventListener] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateHelperEventListener extends BcHelperEventListener
{
	/**
	 * 登録イベント
	 *
	 */
	public $events = array(
		'Form.afterForm',
	);

	/**
	 * 処理対象とするコントローラー
	 * 
	 * @var array
	 */
	private $targetController = array('pages', 'blog_posts');

	/**
	 * 処理対象アクション
	 * 
	 * @var array
	 */
	private $targetAction = array('admin_edit', 'admin_add');

	/**
	 * formAfterInput
	 * 
	 * @param CakeEvent $event
	 * @return string
	 */
	public function formAfterForm(CakeEvent $event)
	{
		if (!BcUtil::isAdminSystem()) {
			return;
		}

		$View = $event->subject();

		if (!in_array($View->request->params['controller'], $this->targetController)) {
			return;
		}

		if (!in_array($View->request->params['action'], $this->targetAction)) {
			return;
		}

		if (!$View->get('callableEditorTemplateConfig')) {
			return;
		}

		if (!Hash::get($View->get('callableEditorTemplateConfig'), 'status')) {
			return;
		}

		// ブログ記事：エディターテンプレート呼出欄を表示する
		echo $View->element('CallableEditorTemplate.callable_editor_template_form');
	}

}
