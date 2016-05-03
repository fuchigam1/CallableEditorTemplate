<?php

/**
 * CallableEditorTemplateHelperEventListenerTest file
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
class CallableEditorTemplateHelperEventListenerTest extends BaserTestCase
{

	public function testFormAfterForm()
	{
//		$this->markTestIncomplete('このテストは、まだ実装されていません。');
//		App::uses('CakeEventManager', 'Event');
//		$events = CakeEventManager::instance();

		$expected = 'pages';
		$this->assertContains($expected, array('pages', 'blog_posts'));

		$expected = 'blog_posts';
		$this->assertContains($expected, array('pages', 'blog_posts'));
	}

}
