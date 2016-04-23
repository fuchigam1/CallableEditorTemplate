<?php

/**
 * [ModelEventListener] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateModelEventListener extends BcModelEventListener
{

	/**
	 * 登録イベント
	 *
	 */
	public $events = array(
		'EditorTemplate.afterSave',
		'EditorTemplate.afterDelete',
		'Page.beforeFind',
		'Page.afterDelete',
		'Page.afterSave',
		'Blog.BlogPost.beforeFind',
		'Blog.BlogPost.afterDelete',
		'Blog.BlogPost.afterSave',
		'Blog.BlogContent.afterDelete',
	);

	/**
	 * コーラブルエディターテンプレートモデル
	 * 
	 * @var Object
	 */
	private $CallableEditorTemplateModel = null;

	/**
	 * ブログ記事多重保存の判定
	 * 
	 * @var boolean
	 */
	private $throwBlogPost = false;

	/**
	 * editorTemplateAfterSave
	 * 
	 * @param CakeEvent $event
	 */
	public function editorTemplateAfterSave(CakeEvent $event)
	{
		clearAllCache();
		return;
	}

	/**
	 * editorTemplateAfterDelete
	 * 
	 * @param CakeEvent $event
	 * @return boolean
	 */
	public function editorTemplateAfterDelete(CakeEvent $event)
	{
		clearAllCache();
		return true;
	}

	/**
	 * pageBeforeFind
	 * 
	 * @param CakeEvent $event
	 */
	public function pageBeforeFind(CakeEvent $event)
	{
		$Model		 = $event->subject();
		$association = array(
			'CallableEditorTemplate' => array(
				'className'	 => 'CallableEditorTemplate.CallableEditorTemplate',
				'conditions' => array(
					'CallableEditorTemplate.model' => $Model->alias
				),
				'foreignKey' => 'model_id'
			)
		);
		$Model->bindModel(array('hasOne' => $association));
	}

	/**
	 * blogBlogPostBeforeFind
	 * 
	 * @param CakeEvent $event
	 */
	public function blogBlogPostBeforeFind(CakeEvent $event)
	{
		$Model		 = $event->subject();
		$association = array(
			'CallableEditorTemplate' => array(
				'className'	 => 'CallableEditorTemplate.CallableEditorTemplate',
				'conditions' => array(
					'CallableEditorTemplate.model' => $Model->alias
				),
				'foreignKey' => 'model_id'
			)
		);
		$Model->bindModel(array('hasOne' => $association));
	}

	/**
	 * pageAfterDelete
	 * - 固定ページ削除時、そのコンテンツが持つコーラブルエディターテンプレート情報を削除する
	 * 
	 * @param CakeEvent $event
	 */
	public function pageAfterDelete(CakeEvent $event)
	{
		$Model						 = $event->subject();
		$CallableEditorTemplateModel = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplate');
		$data						 = $CallableEditorTemplateModel->find('first', array('conditions' => array(
				'CallableEditorTemplate.model'		 => $Model->alias,
				'CallableEditorTemplate.model_id'	 => $Model->id
		)));
		if ($data) {
			if (!$CallableEditorTemplateModel->delete($data['CallableEditorTemplate']['id'])) {
				$this->log('ID:' . $data['CallableEditorTemplate']['id'] . 'のコーラブルエディターテンプレートの削除に失敗しました。');
			}
		}
		return true;
	}

	/**
	 * blogBlogPostAfterDelete
	 * - ブログ記事削除時、そのコンテンツが持つコーラブルエディターテンプレート情報を削除する
	 * 
	 * @param CakeEvent $event
	 */
	public function blogBlogPostAfterDelete(CakeEvent $event)
	{
		$Model						 = $event->subject();
		$CallableEditorTemplateModel = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplate');
		$data						 = $CallableEditorTemplateModel->find('first', array('conditions' => array(
				'CallableEditorTemplate.model'		 => $Model->alias,
				'CallableEditorTemplate.model_id'	 => $Model->id
		)));
		if ($data) {
			if (!$CallableEditorTemplateModel->delete($data['CallableEditorTemplate']['id'])) {
				$this->log('ID:' . $data['CallableEditorTemplate']['id'] . 'のコーラブルエディターテンプレートの削除に失敗しました。');
			}
		}
		return true;
	}

	/**
	 * blogBlogContentAfterDelete
	 * 
	 * @param CakeEvent $event
	 */
	public function blogBlogContentAfterDelete(CakeEvent $event)
	{
		$Model								 = $event->subject();
		// ブログ設定削除時、そのコンテンツが持つコーラブルエディターテンプレート設定情報を削除する
		$CallableEditorTemplateConfigModel	 = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplateConfig');
		$data								 = $CallableEditorTemplateConfigModel->find('first', array('conditions' => array(
				'CallableEditorTemplateConfig.model'		 => $Model->alias,
				'CallableEditorTemplateConfig.content_id'	 => $Model->id
		)));
		if ($data) {
			if (!$CallableEditorTemplateConfigModel->delete($data['CallableEditorTemplateConfig']['id'])) {
				$this->log('ID:' . $data['CallableEditorTemplateConfig']['id'] . 'のコーラブルエディターテンプレート設定の削除に失敗しました。');
			}
		}
		return true;
	}

	/**
	 * pageAfterSave
	 * 
	 * @param CakeEvent $event
	 */
	public function pageAfterSave(CakeEvent $event)
	{
		$Model = $event->subject();
		// CallableEditorTemplateのデータがない場合は save 処理を実施しない
		if (!isset($Model->data['CallableEditorTemplate']) || empty($Model->data['CallableEditorTemplate'])) {
			return;
		}

		$saveData = $this->generateSaveData($Model, $Model->id);
		if (!$this->CallableEditorTemplateModel->save($saveData)) {
			$this->log(sprintf('ID：%s のコーラブルエディターテンプレートの保存に失敗しました。', $Model->data['CallableEditorTemplate']['id']));
		}
	}

	/**
	 * blogBlogPostAfterSave
	 * 
	 * @param CakeEvent $event
	 */
	public function blogBlogPostAfterSave(CakeEvent $event)
	{
		$Model = $event->subject();
		// CallableEditorTemplateのデータがない場合は save 処理を実施しない
		if (!isset($Model->data['CallableEditorTemplate']) || empty($Model->data['CallableEditorTemplate'])) {
			return;
		}

		$saveData = $this->generateSaveData($Model, $Model->id);
		// 2周目では保存処理に渡らないようにしている
		if (!$this->throwBlogPost) {
			if (!$this->CallableEditorTemplateModel->save($saveData)) {
				$this->log(sprintf('ID：%s のコーラブルエディターテンプレートの保存に失敗しました。', $Model->data['CallableEditorTemplate']['id']));
			}
		}
		// ブログ記事コピー保存時、アイキャッチが入っていると処理が2重に行われるため、1周目で処理通過を判定し、
		// 2周目では保存処理に渡らないようにしている
		$this->throwBlogPost = true;
	}

	/**
	 * 保存するデータの生成
	 * 
	 * @param Object $Model
	 * @param int $contentId
	 * @return array
	 */
	public function generateSaveData($Model, $contentId)
	{
		$params								 = Router::getParams();
		$this->CallableEditorTemplateModel	 = ClassRegistry::init('CallableEditorTemplate.CallableEditorTemplate');
		$data								 = array();
		if ($Model->alias == 'BlogPost') {
			$modelId = $contentId;
			if (!empty($params['pass'][1])) {
				$oldModelId = $params['pass'][1];
			}
		}
		if ($Model->alias == 'Page') {
			$modelId = $contentId;
			// 固定ページテンプレート読込の場合は $params['pass'] に値が入らないため判定する
			if (!empty($params['pass'][0])) {
				$oldModelId = $params['pass'][0];
			}
		}

		if ($contentId) {
			$data = $this->CallableEditorTemplateModel->find('first', array(
				'conditions' => array(
					'CallableEditorTemplate.model'		 => $Model->alias,
					'CallableEditorTemplate.model_id'	 => $contentId
				),
				'recursive'	 => -1
			));
		}

		switch ($params['action']) {
			case 'admin_add':
				// 追加時
				$data['CallableEditorTemplate']['model']	 = $Model->alias;
				$data['CallableEditorTemplate']['model_id']	 = $contentId;
				break;

			case 'admin_edit':
				// 編集時
				$data['CallableEditorTemplate']				 = $Model->data['CallableEditorTemplate'];
				$data['CallableEditorTemplate']['model']	 = $Model->alias;
				$data['CallableEditorTemplate']['model_id']	 = $contentId;
				break;

			case 'admin_ajax_copy':
				// Ajaxコピー処理時に実行
				// ブログコピー保存時にエラーがなければ保存処理を実行
				if (empty($Model->validationErrors)) {
					$_data = $this->CallableEditorTemplateModel->find('first', array(
						'conditions' => array(
							'CallableEditorTemplate.model'		 => $Model->alias,
							'CallableEditorTemplate.model_id'	 => $oldModelId
						),
						'recursive'	 => -1
					));
					// XXX もしコーラブルエディターテンプレート設定の初期データ作成を行ってない事を考慮して判定している
					if ($_data) {
						// コピー元データがある時
						$data['CallableEditorTemplate']				 = $_data['CallableEditorTemplate'];
						$data['CallableEditorTemplate']['model']	 = $Model->alias;
						$data['CallableEditorTemplate']['model_id']	 = $contentId;
						unset($data['CallableEditorTemplate']['id']);
					} else {
						// コピー元データがない時
						$data['CallableEditorTemplate']['model']	 = $Model->alias;
						$data['CallableEditorTemplate']['model_id']	 = $modelId;
					}
				}
				break;

			default:
				break;
		}

		return $data;
	}

}
