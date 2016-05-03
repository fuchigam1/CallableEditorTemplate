<?php

/**
 * [Config] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
App::uses('CallableEditorTemplateUtil', 'CallableEditorTemplate.Lib');
/**
 * Test実行時に有効化する
 */
Configure::write('BcApp.corePlugins', Hash::merge(Configure::read('BcApp.corePlugins'), array('CallableEditorTemplate')));
/**
 * システムナビ
 */
$config['BcApp.adminNavi.callable_editor_template']	 = array(
	'name'		 => '記事別エディターテンプレート呼出 プラグイン',
	'contents'	 => array(
		array('name'	 => '記事別エディターテンプレート呼出設定一覧',
			'url'	 => array(
				'admin'		 => true,
				'plugin'	 => 'callable_editor_template',
				'controller' => 'callable_editor_template_configs',
				'action'	 => 'index')
		)
	)
);
/**
 * モデル判定用設定
 * 
 */
$config['CallableEditorTemplate']					 = array(
	'label_name' => 'エディターテンプレート',
	// フィールドタイプ種別
	'target'	 => array(
//		設定用雛形
//		'PLUGIN_NAME.MODEL_NAME' => array(
//			モデル名の定義
//			'name' => 'MODEL_NAME',
//			'title' => 'MODEL_TITLE',
//			編集リンクのタイトル文字列用のフィールド定義
//			'fields' => array(
//				'MODEL_NAME.FIELD_NAME' => 'FIELD_TITLE',
//				),
//			編集画面へのリンク定義
//			'edit_url' => array(
//				'plugin' => 'plugin_name',
//				'controller' => 'controller_name',
//				'action' => 'action_name',
//				'pass' => array('paramater'),
//			),
//			'view_name' => 'VIEW_NAME',
//			'model_data' => 'VARIAVLE_DATA_NAME',
//		),
		'Page'			 => array(
			'name'		 => 'Page',
			'title'		 => '固定ページ',
			'fields'	 => array(
				'Page.title' => 'ページタイトル',
			),
			'edit_url'	 => array(
				'plugin'	 => null,
				'controller' => 'pages',
				'action'	 => 'edit',
				'pass'		 => array('id'),
			),
			'view_name'	 => 'Page',
			'model_data' => 'data',
		),
		'Blog.BlogPost'	 => array(
			'name'		 => 'BlogPost',
			'title'		 => 'ブログ記事',
			'fields'	 => array(
				'BlogPost.name' => 'タイトル',
			),
			'edit_url'	 => array(
				'plugin'	 => 'blog',
				'controller' => 'blog_posts',
				'action'	 => 'edit',
				'pass'		 => array('blog_content_id', 'id'),
			),
			'view_name'	 => 'Blog',
			'model_data' => 'post',
		),
	),
);
