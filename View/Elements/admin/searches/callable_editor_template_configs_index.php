<?php
/**
 * [ADMIN] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
?>
<?php echo $this->BcForm->create('CallableEditorTemplateConfig', array('url' => array('action' => 'index'))) ?>
<p>
	<span>
		<?php echo $this->BcForm->label('CallableEditorTemplateConfig.model', 'コンテンツ名') ?>
		&nbsp;<?php echo $this->BcForm->input('CallableEditorTemplateConfig.model', array('type' => 'select', 'options' => $this->CallableEditorTemplate->types)) ?>
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<span>
		<?php echo $this->BcForm->label('CallableEditorTemplateConfig.status', '利用状態') ?>
		&nbsp;<?php echo $this->BcForm->input('CallableEditorTemplateConfig.status', array('type' => 'select', 'options' => $this->BcText->booleanMarkList(), 'empty' => '指定なし')) ?>
	</span>
</p>
<div class="button">
	<?php echo $this->BcForm->submit('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn'), array('div' => false, 'id' => 'BtnSearchSubmit')) ?>
</div>
<?php echo $this->BcForm->end() ?>
