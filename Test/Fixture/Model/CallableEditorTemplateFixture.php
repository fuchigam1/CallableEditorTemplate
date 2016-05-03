<?php

/**
 * CallableEditorTemplateFixture
 *
 */
class CallableEditorTemplateFixture extends BaserTestFixture
{

	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = array(
		array(
			'id'				 => '1',
			'model'				 => 'Page',
			'model_id'			 => '1',
			'editor_template_id' => '1',
			'display_before'	 => 0,
			'status'			 => 1,
			'modified'			 => null,
			'created'			 => '2016-05-01 09:32:30',
		),
		array(
			'id'				 => '2',
			'model'				 => 'BlogPost',
			'model_id'			 => '1',
			'editor_template_id' => '1',
			'display_before'	 => 0,
			'status'			 => 1,
			'modified'			 => null,
			'created'			 => '2016-05-02 09:32:30',
		),
		array(
			'id'				 => '3',
			'model'				 => 'BlogPost',
			'model_id'			 => '2',
			'editor_template_id' => '2',
			'display_before'	 => 1,
			'status'			 => 0,
			'modified'			 => null,
			'created'			 => '2016-05-03 09:32:30',
		),
	);

}
