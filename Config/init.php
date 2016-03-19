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
	$CallableEditorTemplateConfigModel = new CallableEditorTemplateConfig();
	$callableEditorConfigData = $CallableEditorTemplateConfigModel->find('first', array('conditions' => array(
		'CallableEditorTemplateConfig.model' => 'Page',
		'CallableEditorTemplateConfig.content_id' => 0
	)));
	if (!$callableEditorConfigData) {
		$savaDataPage['CallableEditorTemplateConfig']['model'] = 'Page';
		$savaDataPage['CallableEditorTemplateConfig']['content_id'] = 0;
		$CallableEditorTemplateConfigModel->create($savaDataPage);
		$CallableEditorTemplateConfigModel->save($savaDataPage, array('validate' => false, 'callbacks' => false));
	}
