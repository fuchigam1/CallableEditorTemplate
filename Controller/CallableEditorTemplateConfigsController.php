<?php

/**
 * [Controller] CallableEditorTemplateConfigs
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
App::uses('CallableEditorTemplateApp', 'CallableEditorTemplate.Controller');

class CallableEditorTemplateConfigsController extends CallableEditorTemplateAppController {

	/**
	 * ControllerName
	 * 
	 * @var string
	 */
	public $name = 'CallableEditorTemplateConfigs';

	/**
	 * Model
	 * 
	 * @var array
	 */
	public $uses = array('CallableEditorTemplate.CallableEditorTemplateConfig');

	/**
	 * ぱんくずナビ
	 *
	 * @var string
	 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => '記事別エディターテンプレート呼出設定管理', 'url' => array('plugin' => 'callable_editor_template', 'controller' => 'callable_editor_template_configs', 'action' => 'index'))
	);

	/**
	 * 管理画面タイトル
	 *
	 * @var string
	 */
	public $adminTitle = '記事別エディターテンプレート呼出設定';

	/**
	 * beforeFilter
	 *
	 */
	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	 * [ADMIN] 設定一覧
	 * 
	 */
	public function admin_index() {
		$this->pageTitle = $this->adminTitle . '一覧';
		$this->search	 = 'callable_editor_template_configs_index';
		$this->help		 = 'callable_editor_template_configs_index';
		parent::admin_index();
	}

	/**
	 * [ADMIN] 編集
	 * 
	 * @param int $id
	 */
	public function admin_edit($id = null) {
		$this->pageTitle = $this->adminTitle . '編集';
		parent::admin_edit($id);
	}

	/**
	 * [ADMIN] 追加
	 * 
	 */
	public function admin_add() {
		$this->pageTitle = $this->adminTitle . '追加';

		if ($this->request->is('post')) {
			if ($this->{$this->modelClass}->save($this->request->data)) {
				$this->setMessage('追加が完了しました。');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setMessage('入力エラーです。内容を修正して下さい。', true);
			}
		} else {
			$this->request->data							 = $this->{$this->modelClass}->getDefaultValue();
			$this->request->data[$this->modelClass]['model'] = 'BlogContent';
		}

		// 設定データがあるブログは選択リストから除外する
		$dataList = $this->{$this->modelClass}->find('all', array(
			'conditions' => array(
				'model' => 'BlogContent',
			),
		));
		if ($dataList) {
			foreach ($dataList as $data) {
				unset($this->blogContentDatas[$data[$this->modelClass]['content_id']]);
			}
		}

		$this->set('blogContentDatas', $this->blogContentDatas);
		$this->render('form');
	}

	/**
	 * [ADMIN] 削除
	 *
	 * @param int $id
	 */
	public function admin_delete($id = null) {
		parent::admin_delete($id);
	}

	/**
	 * [ADMIN] 各ブログ別の記事別エディターテンプレート呼出設定データを作成する
	 *   ・記事別エディターテンプレート呼出設定データがないブログ用のデータのみ作成する
	 * 
	 */
	public function admin_first() {
		if ($this->request->data) {
			$count = 0;
			if ($this->blogContentDatas) {
				foreach ($this->blogContentDatas as $key => $blog) {
					$configData = $this->CallableEditorTemplateConfig->findByContentId($key);
					if (!$configData) {
						$this->request->data['CallableEditorTemplateConfig']['content_id']	 = $key;
						$this->request->data['CallableEditorTemplateConfig']['model']		 = 'BlogContent';
						$this->CallableEditorTemplateConfig->create($this->request->data);
						if (!$this->CallableEditorTemplateConfig->save($this->request->data, false)) {
							$this->log(sprintf('ブログID：%s の登録に失敗しました。', $key));
						} else {
							$count++;
						}
					}
				}
			}

			$message = sprintf('%s 件の記事別エディターテンプレート呼出設定を登録しました。', $count);
			$this->setMessage($message, false, true);
			$this->redirect(array('controller' => 'callable_editor_template_configs', 'action' => 'index'));
		}

		$this->pageTitle = $this->adminTitle . 'データ作成';
	}

	/**
	 * エディターテンプレートのプレビュー用呼出し
	 * 
	 */
	public function admin_ajax_preview_template() {
		$id = $this->request->data['id'];

		if (ClassRegistry::isKeySet('EditorTemplate')) {
			$EditorTemplateModel = ClassRegistry::getObject('EditorTemplate');
		} else {
			$EditorTemplateModel = ClassRegistry::init('EditorTemplate');
		}
		$data = $EditorTemplateModel->find('first', array(
			'conditions' => array(
				'EditorTemplate.id' => $id,
			),
			'recursive'	 => -1,
			'callbacks'	 => false,
		));
		$this->set('data', $data);
	}

	/**
	 * 一覧用の検索条件を生成する
	 *
	 * @param array $data
	 * @return array $conditions
	 */
	public function _createAdminIndexConditions($data) {
		$conditions	 = array();
		$model		 = '';

		if (isset($data[$this->modelClass]['model'])) {
			$model = $data[$this->modelClass]['model'];
		}
		if (isset($data[$this->modelClass]['status']) && $data[$this->modelClass]['status'] === '') {
			unset($data[$this->modelClass]['status']);
		}
		if (isset($data[$this->modelClass]['custom']) && $data[$this->modelClass]['custom'] === '') {
			unset($data[$this->modelClass]['custom']);
		}

		unset($data['_Token']);
		unset($data[$this->modelClass]['model']);

		// 条件指定のないフィールドを解除
		foreach ($data[$this->modelClass] as $key => $value) {
			if ($value === '') {
				unset($data[$this->modelClass][$key]);
			}
		}

		if ($data[$this->modelClass]) {
			$conditions = $this->postConditions($data);
		}

		if ($model) {
			$conditions['and'] = array(
				$this->modelClass . '.model' => $model
			);
		}

		if ($conditions) {
			return $conditions;
		} else {
			return array();
		}
	}

}
