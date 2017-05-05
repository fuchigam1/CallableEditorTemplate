<?php 
class CallableEditorTemplateConfigsSchema extends CakeSchema {

	public $file = 'callable_editor_template_configs.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $callable_editor_template_configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'model' => array('type' => 'string', 'null' => true, 'comment' => 'モデル名', 'charset' => 'utf8'),
		'content_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 8, 'unsigned' => false, 'comment' => 'コンテンツID'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => 'タイトル', 'charset' => 'utf8'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => '利用状態'),
		'auto_display' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '自動表示'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
	);

}
