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
<!-- pagination -->
<?php $this->BcBaser->element('pagination') ?>

<?php if ($this->BcBaser->siteConfig['admin_theme'] === 'admin-third'): ?>
	<table cellpadding="0" cellspacing="0" class="list-table sort-table bca-table-listup" id="ListTable">
		<thead class="bca-table-listup__thead">
			<tr>
				<th class="bca-table-listup__thead-th">
					<?php echo $this->Paginator->sort('id', array(
						'asc' => '<i class="bca-icon--asc"></i> NO',
						'desc' => '<i class="bca-icon--desc"></i> NO'),
						array('escape' => false, 'class' => 'btn-direction bca-table-listup__a',
					))?>
				</th>
				<th class="bca-table-listup__thead-th">
					<?php echo $this->Paginator->sort('content_id', array(
						'asc' => '<i class="bca-icon--asc"></i> コンテンツ名',
						'desc' => '<i class="bca-icon--desc"></i> コンテンツ名'),
						array('escape' => false, 'class' => 'btn-direction bca-table-listup__a',
					)) ?>
				</th>
				<th class="bca-table-listup__thead-th">
					<?php echo $this->Paginator->sort('title', array(
						'asc' => '<i class="bca-icon--asc"></i> タイトル',
						'desc' => '<i class="bca-icon--desc"></i> タイトル'),
						array('escape' => false, 'class' => 'btn-direction bca-table-listup__a',
					)) ?>
				</th>
				<th class="bca-table-listup__thead-th">
					<?php echo $this->Paginator->sort('auto_display', array(
						'asc' => '<i class="bca-icon--asc"></i> 自動表示',
						'desc' => '<i class="bca-icon--desc"></i> 自動表示'),
						array('escape' => false, 'class' => 'btn-direction bca-table-listup__a',
					)) ?>
				</th>
				<th class="bca-table-listup__thead-th">
					<?php echo $this->Paginator->sort('created', array(
						'asc' => '<i class="bca-icon--asc"></i> 登録日',
						'desc' => '<i class="bca-icon--desc"></i> 登録日'),
						array('escape' => false, 'class' => 'btn-direction bca-table-listup__a',
					)) ?>
					<br />
					<?php echo $this->Paginator->sort('modified', array(
						'asc' => '<i class="bca-icon--asc"></i> 更新日',
						'desc' => '<i class="bca-icon--desc"></i> 更新日'),
						array('escape' => false, 'class' => 'btn-direction bca-table-listup__a',
					)) ?>
				</th>
				<th class="bca-table-listup__thead-th">
					<?php echo __d('baser', 'アクション') ?>
				</th>
			</tr>
		</thead>
	<tbody>
		<?php if (!empty($datas)): ?>
			<?php foreach ($datas as $data): ?>
				<?php $this->BcBaser->element('callable_editor_template_configs/index_row', array('data' => $data)) ?>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="6"><p class="no-data">データがありません。</p></td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

<?php else: ?>
	<table cellpadding="0" cellspacing="0" class="list-table sort-table" id="ListTable">
		<thead class="bca-table-listup__thead">
			<tr>
				<th class="list-tool" style="width: 50px;">
					<div>
						<?php $this->BcBaser->link(
							$this->BcBaser->getImg('admin/btn_add.png', array('alt' => '新規追加', 'class' => 'btn')) .'新規追加',
							array('action' => 'add')
						) ?>
					</div>
				</th>
				<th><?php echo $this->Paginator->sort('id', array(
						'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' NO',
						'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' NO'),
						array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('content_id', array(
						'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' コンテンツ名',
						'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' コンテンツ名'),
						array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('title', array(
						'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' タイトル',
						'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' タイトル'),
						array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('auto_display', array(
						'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 自動表示',
						'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 自動表示'),
						array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
				<th><?php echo $this->Paginator->sort('created', array(
						'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 登録日',
						'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 登録日'),
						array('escape' => false, 'class' => 'btn-direction')) ?>
					<br />
					<?php echo $this->Paginator->sort('modified', array(
						'asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')).' 更新日',
						'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')).' 更新日'),
						array('escape' => false, 'class' => 'btn-direction')) ?>
				</th>
			</tr>
		</thead>
		<tbody>
	<?php if(!empty($datas)): ?>
		<?php foreach($datas as $data): ?>
			<?php $this->BcBaser->element('callable_editor_template_configs/index_row', array('data' => $data)) ?>
		<?php endforeach; ?>
	<?php else: ?>
			<tr>
				<td colspan="6"><p class="no-data">データが見つかりませんでした。</p></td>
			</tr>
	<?php endif; ?>
		</tbody>
	</table>
<?php endif; ?>

<!-- list-num -->
<?php $this->BcBaser->element('list_num') ?>
