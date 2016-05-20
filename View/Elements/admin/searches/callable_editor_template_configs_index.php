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
	&nbsp;&nbsp;&nbsp;&nbsp;
	<span>
		<?php echo $this->BcForm->label('CallableEditorTemplateConfig.status', '自動表示') ?>
		&nbsp;<?php echo $this->BcForm->input('CallableEditorTemplateConfig.auto_display', array('type' => 'select', 'options' => $this->BcText->booleanMarkList(), 'empty' => '指定なし')) ?>
	</span>
</p>
<div class="button">
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn')), "javascript:void(0)", array('id' => 'BtnSearchSubmit')) ?>
	<?php $this->BcBaser->link($this->BcBaser->getImg('admin/btn_clear.png', array('alt' => 'クリア', 'class' => 'btn')), "javascript:void(0)", array('id' => 'BtnSearchClear')) ?>
</div>
<?php echo $this->BcForm->end() ?>
