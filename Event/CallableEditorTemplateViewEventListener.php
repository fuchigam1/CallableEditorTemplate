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
		'Pages.beforeRender',
		'Blog.BlogPosts.beforeRender',
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

	/**
	 * 現在のイベント名
	 * 
	 * @var String
	 */
	private $currentEventName = '';

	/**
	 * CallableEditorTemplate設定モデル
	 * 
	 * @var Object
	 */
	private $CallableEditorTemplateConfigModel = null;

	/**
	 * 処理対象アクション
	 * 
	 * @var array
	 */
	private $targetAction = array('admin_edit', 'admin_add');

	/**
	 * CallableEditorTemplateConfig モデルを準備する
	 * 
	 */
	private function setUpModel()
	{
		if (ClassRegistry::isKeySet('CallableEditorTemplate.CallableEditorTemplateConfig')) {
			$this->CallableEditorTemplateConfigModel = ClassRegistry::getObject('CallableEditorTemplate.CallableEditorTemplateConfig');
		} else {
			$this->CallableEditorTemplateConfigModel = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplateConfig');
		}

		if (ClassRegistry::isKeySet('EditorTemplate')) {
			$this->EditorTemplateModel = ClassRegistry::getObject('EditorTemplate');
		} else {
			$this->EditorTemplateModel = ClassRegistry::init('EditorTemplate');
		}
	}

	/**
	 * pagesBeforeRender
	 * 
	 * @param CakeEvent $event
	 */
	public function pagesBeforeRender(CakeEvent $event)
	{
		if (!BcUtil::isAdminSystem()) {
			return;
		}

		$View = $event->subject();
		if (in_array($View->request->params['action'], $this->targetAction)) {
			$this->setUpModel();
			$data = $this->CallableEditorTemplateConfigModel->find('first', array(
				'conditions' => array(
					'CallableEditorTemplateConfig.model'		 => 'Page',
					'CallableEditorTemplateConfig.content_id'	 => 0,
				),
				'recursive'	 => -1,
				'callbacks'	 => false,
			));
			if ($data) {
				$View->set('callableEditorTemplateConfig', $data['CallableEditorTemplateConfig']);
			}
			$editorTemplateList = $this->EditorTemplateModel->find('list');
			$View->set('editorTemplateList', $editorTemplateList);
		}
	}

	/**
	 * blogBlogPostBeforeRender
	 * 
	 * @param CakeEvent $event
	 */
	public function blogBlogPostsBeforeRender(CakeEvent $event)
	{
		if (!BcUtil::isAdminSystem()) {
			return;
		}

		$View = $event->subject();
		if (in_array($View->request->params['action'], $this->targetAction)) {
			$this->setUpModel();
			$data = $this->CallableEditorTemplateConfigModel->find('first', array(
				'conditions' => array(
					'CallableEditorTemplateConfig.model'		 => 'BlogContent',
					'CallableEditorTemplateConfig.content_id'	 => $View->viewVars['blogContent']['BlogContent']['id'],
				),
				'recursive'	 => -1,
				'callbacks'	 => false,
			));
			if ($data) {
				$View->set('callableEditorTemplateConfig', $data['CallableEditorTemplateConfig']);
			}
			$editorTemplateList = $this->EditorTemplateModel->find('list');
			$View->set('editorTemplateList', $editorTemplateList);
		}
	}

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
		$View = $event->subject();
		if (BcUtil::isAdminSystem()) {
			if (!Hash::get($View->viewVars, 'preview')) {
				return;
			}
		}
		$this->currentEventName = $event->name();

		if (!Hash::get($View->request->params, 'models')) {
			return;
		}

		$this->pluginSetting = Configure::read('CallableEditorTemplate.target');
		$modelName			 = '';
		$modelId			 = '';

		if ($View->BcBaser->isPage()) {
			$modelName	 = 'Page';
			$modelId	 = Hash::get($View->request->data, 'Page.id');

			$this->setUpModel();
			$configData = $this->CallableEditorTemplateConfigModel->find('first', array(
				'conditions' => array(
					'CallableEditorTemplateConfig.model'		 => 'Page',
					'CallableEditorTemplateConfig.content_id'	 => 0,
				),
				'recursive'	 => -1,
				'callbacks'	 => false,
			));
			if (!$configData) {
				return;
			}
			if (!Hash::get($configData, 'CallableEditorTemplateConfig.status')) {
				return;
			}
		} else {
			// 記事詳細は「single」変数定義を持つことを前提とする（例: ブログ記事詳細）
			if (!Hash::get($View->viewVars, 'single')) {
				return;
			}

			if (!empty($View->plugin)) {
				$setting = CallableEditorTemplateUtil::getThisPluginSetting($this->pluginSetting, $View->plugin);
				if (!$setting) {
					return;
				}

				if ($View->name === $setting['view_name']) {
					$modelName	 = $setting['name'];
					$targetData	 = $View->viewVars[$setting['model_data']];
					$modelId	 = $targetData[$modelName]['id'];

					// TODO: 設定ファイルから汎用的に設定データを取得できるようにする
					$this->setUpModel();
					$configData = $this->CallableEditorTemplateConfigModel->find('first', array(
						'conditions' => array(
							'CallableEditorTemplateConfig.model'		 => 'BlogContent',
							'CallableEditorTemplateConfig.content_id'	 => $targetData[$modelName]['blog_content_id'],
						),
						'recursive'	 => -1,
						'callbacks'	 => false,
					));
					if (!$configData) {
						return;
					}
					if (!Hash::get($configData, 'CallableEditorTemplateConfig.status')) {
						return;
					}
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
		$data								 = $this->CallableEditorTemplate->find('first', array(
			'conditions' => array(
				'CallableEditorTemplate.model'		 => $modelName,
				'CallableEditorTemplate.model_id'	 => $modelId,),
			'callbacks'	 => false,
		));
		$this->callableEditorTemplateData	 = $data;

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
		$View = $event->subject();
		if (BcUtil::isAdminSystem()) {
			if (!Hash::get($View->viewVars, 'preview')) {
				return;
			}
		}
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
