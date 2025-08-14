<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h4 mb-0"><?= e($title) ?></h1>
	<div class="d-flex gap-2">
		<?php if ($resource==='enquiries'): ?><a href="/admin/resource/enquiries?export=csv" class="btn btn-outline-secondary btn-sm">Export CSV</a><?php endif; ?>
		<?php if (empty($def['read_only'])): ?><a href="/admin/resource/<?= e($resource) ?>/create" class="btn btn-primary btn-sm">Create</a><?php endif; ?>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped align-middle">
				<thead>
					<tr>
						<?php foreach ($cols as $c): ?><th><?= e(ucfirst(str_replace('_',' ',$c))) ?></th><?php endforeach; ?>
						<th class="text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($items as $it): ?>
						<tr>
							<?php foreach ($cols as $c): ?>
								<td>
									<?php if ($c==='status'): ?>
										<?php $s = strtolower((string)($it[$c] ?? '')); $badge = $s==='published'||$s==='completed'?'badge-soft-success':($s==='draft'||$s==='upcoming'?'badge-soft-secondary':'badge-soft-warning'); ?>
										<span class="badge <?= $badge ?> text-uppercase"><?= e($it[$c]) ?></span>
									<?php elseif ($c==='resolved' || $c==='reviewed'): ?>
										<?php $ok = (int)($it[$c] ?? 0)===1; ?><span class="badge <?= $ok?'badge-soft-success':'badge-soft-secondary' ?>"><?= $ok?'Yes':'No' ?></span>
									<?php else: ?>
										<?= e(is_scalar($it[$c]) ? (mb_strlen((string)$it[$c])>60?mb_substr((string)$it[$c],0,60).'…':(string)$it[$c]) : '') ?>
									<?php endif; ?>
								</td>
							<?php endforeach; ?>
							<td>
								<div class="table-actions">
									<a class="btn btn-sm btn-outline-secondary" href="/admin/resource/<?= e($resource) ?>/<?= (int)$it['id'] ?>/edit">Edit</a>
									<?php if (empty($def['read_only'])): ?>
										<form method="post" action="/admin/resource/<?= e($resource) ?>/<?= (int)$it['id'] ?>/delete" class="d-inline" onsubmit="return confirm('Delete this item?')">
											<?= csrf_field() ?>
											<button class="btn btn-sm btn-outline-danger">Delete</button>
										</form>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>