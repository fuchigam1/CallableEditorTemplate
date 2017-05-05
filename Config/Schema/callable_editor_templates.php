<?php 
class CallableEditorTemplatesSchema extends CakeSchema {

	public $file = 'callable_editor_templates.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $callable_editor_templates = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'model' => array('type' => 'string', 'null' => true, 'default' => null, 'comment' => 'モデル名', 'charset' => 'utf8'),
		'model_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'モデルID'),
		'editor_template_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index', 'comment' => 'エディターテンプレートID'),
		'display_before' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'コンテンツ上部に表示する'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'comment' => '利用状態'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'editor_template_id' => array('column' => 'editor_template_id', 'unique' => 0)
		),
	);

}
