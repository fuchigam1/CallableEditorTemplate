<?php

/**
 * CallableEditorTemplateConfigsControllerTest file
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
App::uses('CallableEditorTemplateConfigsController', 'CallableEditorTemplate.Controller');

class CallableEditorTemplateConfigsControllerTest extends BaserTestCase
{

	public $fixtures = array(
		'plugin.callable_editor_template.Default/CallableEditorTemplateConfig',
	);

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function test_admin_index()
	{
		$this->markTestIncomplete('このテストは、まだ実装されていません。');
	}

}
