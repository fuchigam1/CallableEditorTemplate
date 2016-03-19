<?php
/**
 * [ViewEventListener] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateViewEventListener extends BcViewEventListener
{
	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'contentHeader',
		'contentFooter',
	);

	/**
	 * プラグインの設定値
	 * 
	 * @var array
	 */
	private $pluginSetting = array();

	/**
	 * CallableEditorTemplateモデル
	 * 
	 * @var Object
	 */
	private $CallableEditorTemplate = null;

	/**
	 * CallableEditorTemplateデータ
	 * 
	 * @var array
	 */
	private $callableEditorTemplateData = array();

	private $currentEventName = '';

	/**
	 * モデル初期化
	 * 
	 */
	private function modelInitializer()
	{
		if (ClassRegistry::isKeySet('CallableEditorTemplate.CallableEditorTemplate')) {
			$this->CallableEditorTemplate = ClassRegistry::getObject('CallableEditorTemplate.CallableEditorTemplate');
		} else {
			$this->CallableEditorTemplate = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplate');
		}
	}

	/**
	 * contentHeader
	 * - 公開側にエディターテンプレートを表示する
	 * 
	 * @param CakeEvent $event
	 */
	public function contentHeader(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			return;
		}
		$View = $event->subject();
		$this->currentEventName = $event->name();

		if (!Hash::get($View->request->params, 'models')) {
			return;
		}

		$this->pluginSetting = Configure::read('CallableEditorTemplate.target');
		$modelName = '';
		$modelId = '';

		if ($View->BcBaser->isPage()) {
			$modelName = 'Page';
			$modelId = Hash::get($View->request->data, 'Page.id');
		} else {
			// 記事詳細は「single」変数定義を持つことを前提とする（例: ブログ記事詳細）
			if (!Hash::get($View->viewVars, 'single')) {
				return;
			}

			if (!empty($View->plugin)) {
				$setting = CallableEditorTemplateUtil::getThisPluginSetting($this->pluginSetting, $View->plugin);
				if ($View->name === $setting['view_name']) {
					$modelName = $setting['name'];
					$targetData = $View->viewVars[$setting['model_data']];
					$modelId = $targetData[$modelName]['id'];
				}
			} else {
				// コア機能は固定ページのみ対応
				return;
			}
		}

		if (!$modelName || !$modelId) {
			return;
		}

		$this->modelInitializer();
		$data = $this->CallableEditorTemplate->find('first', array(
			'conditions' => array(
				'CallableEditorTemplate.model' => $modelName,
				'CallableEditorTemplate.model_id' => $modelId,
			),
			'callbacks' => false,
		));
		$this->callableEditorTemplateData = $data;

		if (!$this->callableEditorTemplateData) {
			return;
		}

		if (Hash::get($this->callableEditorTemplateData, 'CallableEditorTemplate.display_before')) {
			$this->displayCallableEditorTemplate($View, $this->callableEditorTemplateData);
		}
	}

	/**
	 * contentHeader
	 * - 公開側にエディターテンプレートを表示する
	 * 
	 * @param CakeEvent $event
	 */
	public function contentFooter(CakeEvent $event)
	{
		if (BcUtil::isAdminSystem()) {
			return;
		}
		$View = $event->subject();
		$this->currentEventName = $event->name();

		if (!$this->callableEditorTemplateData) {
			return;
		}

		if (!Hash::get($this->callableEditorTemplateData, 'CallableEditorTemplate.display_before')) {
			$this->displayCallableEditorTemplate($View, $this->callableEditorTemplateData);
		}
	}

	/**
	 * エディタテンプレートパーツを表示する
	 * 
	 * @param Object $View
	 * @param array $data
	 */
	private function displayCallableEditorTemplate($View, $data)
	{
		if (!Hash::get($data, 'EditorTemplate.id')) {
			return;
		}
		if (!Hash::get($data, 'CallableEditorTemplate.status')) {
			return;
		}

		$View->request->data['CallableEditorTemplateData'] = $data;
		echo $View->element('CallableEditorTemplate.callable_editor_template');

//		if (strpos($this->currentEventName, '.contentHeader') !== false) {
//		}
	}

}
