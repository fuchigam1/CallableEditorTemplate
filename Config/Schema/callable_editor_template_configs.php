<?php 
class CallableEditorTemplateConfigsSchema extends CakeSchema {

	public $file = 'callable_editor_template_configs.php';

	public $connection = 'plugin';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $callable_editor_template_configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'model' => array('type' => 'string', 'null' => true, 'collate' => 'utf8_general_ci', 'comment' => 'モデル名', 'charset' => 'utf8'),
		'content_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 8, 'unsigned' => false, 'comment' => 'コンテンツID'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => '利用状態'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
