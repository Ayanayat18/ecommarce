<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h4 mb-0"><?= e($title) ?></h1>
	<?php if (empty($def['read_only'])): ?><a href="/admin/resource/<?= e($resource) ?>/create" class="btn btn-primary btn-sm">Create</a><?php endif; ?>
</div>
<div class="table-responsive">
	<table class="table table-striped table-sm align-middle">
		<thead>
			<tr>
				<?php foreach ($cols as $c): ?><th><?= e(ucfirst(str_replace('_',' ',$c))) ?></th><?php endforeach; ?>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $it): ?>
				<tr>
					<?php foreach ($cols as $c): ?>
						<td><?= e(is_numeric($it[$c]) ? (string)$it[$c] : (mb_strlen((string)$it[$c])>60?mb_substr((string)$it[$c],0,60).'…':(string)$it[$c])) ?></td>
					<?php endforeach; ?>
					<td class="text-nowrap">
						<a class="btn btn-sm btn-outline-secondary" href="/admin/resource/<?= e($resource) ?>/<?= (int)$it['id'] ?>/edit">Edit</a>
						<?php if (empty($def['read_only'])): ?>
							<form method="post" action="/admin/resource/<?= e($resource) ?>/<?= (int)$it['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete this item?')">
								<?= csrf_field() ?>
								<button class="btn btn-sm btn-outline-danger">Delete</button>
							</form>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php App\Core\View::end(); ?>