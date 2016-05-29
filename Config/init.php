<?php

/**
 * [Config] CallableEditorTemplate プラグイン用
 * データベース初期化
 */
$this->Plugin->initDb('plugin', 'CallableEditorTemplate');
/**
 * 固定ページ用設定データを作成する
 * 
 */
CakePlugin::load('CallableEditorTemplate');
App::uses('CallableEditorTemplateConfig', 'CallableEditorTemplate.Model');
$CallableEditorTemplateConfigModel	 = new CallableEditorTemplateConfig();
$callableEditorConfigData			 = $CallableEditorTemplateConfigModel->find('first', array('conditions' => array(
		'CallableEditorTemplateConfig.model'		 => 'Page',
		'CallableEditorTemplateConfig.content_id'	 => 0
		)));
if (!$callableEditorConfigData) {
	$savaDataPage['CallableEditorTemplateConfig']['model']		 = 'Page';
	$savaDataPage['CallableEditorTemplateConfig']['content_id']	 = 0;
	$CallableEditorTemplateConfigModel->create($savaDataPage);
	$CallableEditorTemplateConfigModel->save($savaDataPage, array('validate' => false, 'callbacks' => false));
}

/**
 * プレビュー表示のため、ユーザーグループに権限を作成する
 *   ・権限データがないグループのデータのみ作成する
 * 
 */
clearAllCache();
App::uses('UserGroup', 'Model');
$UserGroupModel		 = new UserGroup();
$userGroupDataList	 = $UserGroupModel->find('all', array('recursive' => -1));
if ($userGroupDataList) {
	App::uses('Permission', 'Model');
	$PermissionModel = new Permission();
	foreach ($userGroupDataList as $key => $userGroupData) {
		$id = $userGroupData['UserGroup']['id'];
		// 管理グループの場合は必要ないので権限追加処理をスキップする
		if ($id == 1) {
			continue;
		}
		// グループ別のアクセス制限設定を取得する
		$permissionAuthPrefix	 = $PermissionModel->UserGroup->getAuthPrefix($id);
		$permissions			 = $PermissionModel->find('all', array('conditions' => array(
				'Permission.user_group_id' => $id
		)));
		// CallableEditorTemplate 用権限の存在をチェックする
		$hasPermission			 = false;
		foreach ($permissions as $perm) {
			if ($perm['Permission']['url'] == '/' . $permissionAuthPrefix . '/callable_editor_template/callable_editor_template_configs/ajax_preview_template') {
				$hasPermission = true;
				break;
			}
		}
		$saveData = array();
		if (!$hasPermission) {
			//「記事別エディターテンプレート呼出プレビュー権限」を追加する
			$saveData['Permission']['url']			 = '/' . $permissionAuthPrefix . '/callable_editor_template/callable_editor_template_configs/ajax_preview_template';
			$saveData['Permission']['name']			 = '記事別エディターテンプレート呼出プレビュー権限';
			$saveData['Permission']['user_group_id'] = $id;
			$saveData['Permission']['auth']			 = true;
			$saveData['Permission']['status']		 = true;
			$saveData['Permission']['no']			 = $PermissionModel->getMax('no', array('user_group_id' => $id)) + 1;
			$saveData['Permission']['sort']			 = $PermissionModel->getMax('sort', array('user_group_id' => $id)) + 1;
			$PermissionModel->save($saveData, array('callbacks' => false, 'validate' => false));
		}
	}
}
