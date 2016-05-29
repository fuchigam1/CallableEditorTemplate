<?php

/**
 * [Lib] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateUtil extends Object
{

	/**
	 * 設定ファイルから、該当するプラグイン名の設定値を取得する
	 * 
	 * @param array $setting
	 * @param string $targetPluginName
	 * @return type
	 */
	public static function getThisPluginSetting($setting, $targetPluginName)
	{
		$targetData = array();
		foreach ($setting as $key => $value) {
			if (strpos($key, '.') === false) {
				continue;
			}

			list($pluginName, $pluginModelName) = explode('.', $key);
			if ($targetPluginName === $pluginName) {
				$targetData = $value;
			}
		}
		return $targetData;
	}

	public static function getModelTitle($modelName)
	{
		$setting	 = Configure::read('CallableEditorTemplate.target');
		$targetData	 = array();
		foreach ($setting as $key => $value) {
			if ($value['name'] === $modelName) {
				$targetData = $value['title'];
			}
		}
		return $targetData;
	}

	/**
	 * モデル名.フィールド名の文字列から配列を生成して返す
	 * 
	 * @param string $value
	 * @return array
	 */
	public static function splitName($value = '')
	{
		// 例: $value = Page.name
		$exploded		 = explode('.', $value);
		$searchTarget	 = array(
			'modelName'	 => $exploded[0],
			'field'		 => $exploded[1],
		);
		return $searchTarget;
	}

	/**
	 * getUseModel
	 * 設定ファイルから利用モデル一覧を取得する
	 * 
	 * @param array $setting
	 * @return array
	 */
	public static function getUseModel($setting)
	{
		$useModel = array();
		foreach ($setting as $model => $data) {
			$useModel[$data['name']] = $data['title'];
		}
		return $useModel;
	}

	/**
	 * 指定のURLを、アクセス制限で許可されているURLか判定する
	 * - ajaxの利用やURL文字列を利用する箇所にて利用できる
	 * - BcBaserHelper::link() が利用できない場合に利用できる
	 * 
	 * @param int $userGroupId
	 * @param string $url
	 *  - Router::url(array('plugin' => 'PLUGIN_NAME', 'controller' => 'CONTROLLER_NAME', 'action' => 'ACTION_NAME'))
	 * @return boolean
	 */
	public static function hasAablePermission($userGroupId, $url)
	{
		if (ClassRegistry::isKeySet('Permission')) {
			$Permission = ClassRegistry::getObject('Permission');
		} else {
			$Permission = ClassRegistry::init('Permission');
		}

		$checkUrl = preg_replace('|^/index.php|', '', $url);
		return $Permission->check($checkUrl, $userGroupId);
	}

}
