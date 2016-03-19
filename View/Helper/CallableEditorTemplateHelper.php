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
		0 => '指定しない',
		'Page' => '固定ページ',
		'BlogContent' => 'ブログ',
	);

	/**
	 * 利用状態を取得する
	 * 
	 * @param array $data
	 * @return boolean 除外状態
	 */
	public function allowPublish($data)
	{
		if (isset($data['CallableEditorTemplate'])){
			$data = $data['CallableEditorTemplate'];
		} elseif (isset($data['CallableEditorTemplateConfig'])) {
			$data = $data['CallableEditorTemplateConfig'];
		}
		$allowPublish = (int)$data['status'];
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

}
