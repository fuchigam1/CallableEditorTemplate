<?php
/**
 * [ADMIN] CallableEditorTemplate
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @package			CallableEditorTemplate
 * @license			MIT
 */
$hasAddableBlog = false;
if (count($blogContentDatas) > 0) {
	$hasAddableBlog = true;
}
?>
<?php if ($this->request->params['action'] !== 'admin_add'): ?>
	<?php echo $this->BcForm->create('CallableEditorTemplateConfig', array('url' => array('action' => 'edit'))) ?>
	<?php echo $this->BcForm->input('CallableEditorTemplateConfig.id', array('type' => 'hidden')) ?>
	<?php echo $this->BcForm->input('CallableEditorTemplateConfig.content_id', array('type' => 'hidden')) ?>
	<?php echo $this->BcForm->input('CallableEditorTemplateConfig.model', array('type' => 'hidden')) ?>
<?php else: ?>
	<?php echo $this->BcForm->create('CallableEditorTemplateConfig', array('url' => array('action' => 'add'))) ?>
	<?php echo $this->BcForm->input('CallableEditorTemplateConfig.model', array('type' => 'hidden')) ?>
<?php endif ?>

<div id="CallableEditorTemplateConfigConfigTable">
	<h2>設定項目</h2>
	<section class="bca-section">
	<table cellpadding="0" cellspacing="0" class="form-table section bca-form-table">
		<?php if ($this->request->params['action'] !== 'admin_add'): ?>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('CallableEditorTemplateConfig.id', 'NO') ?>
				</th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->value('CallableEditorTemplateConfig.id') ?>
				</td>
			</tr>
		<?php endif ?>

		<?php if ($this->request->params['action'] === 'admin_add'): ?>
			<?php if ($hasAddableBlog): ?>
				<tr>
					<th class="col-head bca-form-table__label">
						<?php echo $this->BcForm->label('CallableEditorTemplateConfig.content_id', 'ブログ') ?>
					</th>
					<td class="col-input bca-form-table__input">
						<?php echo $this->BcForm->input('CallableEditorTemplateConfig.content_id', array('type' => 'select', 'options' => $blogContentDatas)) ?>
						<?php echo $this->BcForm->error('CallableEditorTemplateConfig.content_id') ?>
					</td>
				</tr>
			<?php else: ?>
				<tr>
					<th class="col-head bca-form-table__label">
						<?php echo $this->BcForm->label('CallableEditorTemplateConfig.content_id', 'ブログ') ?>
					</th>
					<td class="col-input bca-form-table__input">
						追加設定可能なブログがありません。
					</td>
				</tr>
			<?php endif ?>
		<?php endif ?>
		<?php if ($hasAddableBlog): ?>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('CallableEditorTemplateConfig.status', '利用状態') ?>
				</th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->input('CallableEditorTemplateConfig.status', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('利用'))) ?>
					<?php if ($this->BcBaser->siteConfig['admin_theme'] === 'admin-third'): ?>
						<i class="bca-icon--question-circle btn help bca-help"></i>
					<?php else: ?>
						<?php echo $this->BcBaser->img('admin/icn_help.png', array('id' => 'helpCallableEditorTemplateConfigStatus', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
					<?php endif; ?>
					<?php echo $this->BcForm->error('CallableEditorTemplateConfig.status') ?>

					<div id="helptextCallableEditorTemplateConfigStatus" class="helptext">
						<ul>
							<li>記事別エディターテンプレート呼出利用の有無を指定します。</li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('CallableEditorTemplateConfig.auto_display', '自動表示') ?>
				</th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->input('CallableEditorTemplateConfig.auto_display', array('type' => 'radio', 'options' => $this->BcText->booleanDoList('自動表示'))) ?>
					<?php if ($this->BcBaser->siteConfig['admin_theme'] === 'admin-third'): ?>
						<i class="bca-icon--question-circle btn help bca-help"></i>
					<?php else: ?>
						<?php echo $this->BcBaser->img('admin/icn_help.png', array('id' => 'helpCallableEditorTemplateConfigAutoDisplay', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
					<?php endif; ?>
					<?php echo $this->BcForm->error('CallableEditorTemplateConfig.auto_display') ?>

					<div id="helptextCallableEditorTemplateConfigAutoDisplay" class="helptext">
						<ul>
							<li>エディターテンプレートの自動表示利用の有無を指定します。</li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('CallableEditorTemplateConfig.title', 'タイトル') ?>
				</th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->input('CallableEditorTemplateConfig.title', array(
						'type' => 'text', 'size' => 80, 'maxlength' => 255,
						// 'class' => 'full-width',
						'data-input-text-size' => 'full-counter',
						'counter' => true, 'placeholder' => Configure::read('CallableEditorTemplate.label_name'),
					)) ?>
					<?php if ($this->BcBaser->siteConfig['admin_theme'] === 'admin-third'): ?>
						<i class="bca-icon--question-circle btn help bca-help"></i>
					<?php else: ?>
						<?php echo $this->BcBaser->img('admin/icn_help.png', array('id' => 'helpCallableEditorTemplateConfigTitle', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
					<?php endif; ?>
					<div id="helptextCallableEditorTemplateConfigTitle" class="helptext">
						<ul>
							<li>記事編集画面に表示する見出しを指定できます。</li>
						</ul>
					</div>

					<?php echo $this->BcForm->error('CallableEditorTemplateConfig.title') ?>
				</td>
			</tr>
		<?php endif ?>
	</table>
	</section>
</div>

<?php if ($hasAddableBlog): ?>
	<div class="submit bca-actions">
		<?php echo $this->BcForm->submit('保　存', array('
			div' => false, 'class' => 'btn-red button bca-btn bca-actions__item',
			'data-bca-btn-type' => 'save', 'data-bca-btn-size' => 'lg', 'data-bca-btn-width' => 'lg',
		)) ?>
	</div>
<?php endif ?>
<?php echo $this->BcForm->end() ?>
