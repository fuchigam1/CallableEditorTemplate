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
<p class="bca-search__input-list">
	<span class="bca-search__input-item">
		<?php echo $this->BcForm->label('CallableEditorTemplateConfig.model', 'コンテンツ名') ?>
		&nbsp;<?php echo $this->BcForm->input('CallableEditorTemplateConfig.model', array('type' => 'select', 'options' => $this->CallableEditorTemplate->types)) ?>
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<span class="bca-search__input-item">
		<?php echo $this->BcForm->label('CallableEditorTemplateConfig.status', '利用状態') ?>
		&nbsp;<?php echo $this->BcForm->input('CallableEditorTemplateConfig.status', array('type' => 'select', 'options' => $this->BcText->booleanMarkList(), 'empty' => '指定なし')) ?>
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<span class="bca-search__input-item">
		<?php echo $this->BcForm->label('CallableEditorTemplateConfig.status', '自動表示') ?>
		&nbsp;<?php echo $this->BcForm->input('CallableEditorTemplateConfig.auto_display', array('type' => 'select', 'options' => $this->BcText->booleanMarkList(), 'empty' => '指定なし')) ?>
	</span>
</p>
<div class="button bca-search__btns">
	<?php if ($this->BcBaser->siteConfig['admin_theme'] === 'admin-third'): ?>
		<div class="bca-search__btns-item">
			<?php $this->BcBaser->link(__d('baser', '検索'), "javascript:void(0)", ['id' => 'BtnSearchSubmit', 'class' => 'bca-btn bca-btn-lg', 'data-bca-btn-size'=>"lg"]) ?>
		</div>
		<div class="bca-search__btns-item">
			<?php $this->BcBaser->link(__d('baser', 'クリア'), "javascript:void(0)", ['id' => 'BtnSearchClear', 'class' => 'bca-btn']) ?>
		</div>
	<?php else: ?>
		<?php $this->BcBaser->link($this->BcBaser->getImg('admin/btn_search.png', array('alt' => '検索', 'class' => 'btn')), "javascript:void(0)", array('id' => 'BtnSearchSubmit')) ?>
		<?php $this->BcBaser->link($this->BcBaser->getImg('admin/btn_clear.png', array('alt' => 'クリア', 'class' => 'btn')), "javascript:void(0)", array('id' => 'BtnSearchClear')) ?>
	<?php endif; ?>
</div>
<?php echo $this->BcForm->end() ?>
