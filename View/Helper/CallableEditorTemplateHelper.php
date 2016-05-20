<?php

/**
 * [Helper] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateHelper extends AppHelper
{

	/**
	 * モデル名とコンテンツ名の対応表
	 * 
	 * @var array
	 */
	public $types = array(
		0				 => '指定しない',
		'Page'			 => '固定ページ',
		'BlogContent'	 => 'ブログ',
	);

	/**
	 * 利用状態を取得する
	 * 
	 * @param array $data
	 * @return boolean 除外状態
	 */
	public function allowPublish($data)
	{
		if (isset($data['CallableEditorTemplate'])) {
			$data = $data['CallableEditorTemplate'];
		} elseif (isset($data['CallableEditorTemplateConfig'])) {
			$data = $data['CallableEditorTemplateConfig'];
		}
		$allowPublish = (int) $data['status'];
		return $allowPublish;
	}

	/**
	 * ページは削除不可にする
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function isNotDelete($data = array())
	{
		if ($data['CallableEditorTemplateConfig']['model'] == 'Page') {
			return false;
		}
		return true;
	}

	/**
	 * nameフィールドの値を取得する
	 *
	 * @param array $data
	 * @return string or ''
	 */
	public function getCallableEditorTemplateName($data = array())
	{
		if ($data) {
			if (!empty($data['CallableEditorTemplate']['name'])) {
				return $data['CallableEditorTemplate']['name'];
			}
		}
		return;
	}

	/**
	 * エディターテンプレートの利用可否を判定する
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function isShowable($data)
	{
		if (Hash::get($data, 'CallableEditorTemplate.status')) {
			return true;
		}
		return false;
	}

	/**
	 * エディターテンプレートのデータを取得する
	 * 
	 * @param array $data
	 * @return string
	 */
	public function getEditorTemplate($data)
	{
		$html = '';
		if (!$this->isShowable($data)) {
			return $html;
		}

		if (ClassRegistry::isKeySet('EditorTemplate')) {
			$EditorTemplateModel = ClassRegistry::getObject('EditorTemplate');
		} else {
			$EditorTemplateModel = ClassRegistry::init('EditorTemplate');
		}
		$editorTemplate = $EditorTemplateModel->find('first', array(
			'conditions' => array('EditorTemplate.id' => Hash::get($data, 'CallableEditorTemplate.editor_template_id')),
		));
		if ($editorTemplate) {
			$html = Hash::get($editorTemplate, 'EditorTemplate.html');
		}

		return $html;
	}

}
