<?php App\Core\View::extend('admin'); ?>
<?php App\Core\View::start('content'); ?>
<h1 class="h4 mb-3"><?= e($title) ?></h1>
<div class="row">
	<div class="col-lg-8">
		<div class="card mb-3">
			<div class="card-body">
				<form method="post" enctype="multipart/form-data" action="<?= isset($item['id'])?'/admin/resource/'.e($resource).'/'.(int)$item['id'].'/edit':'/admin/resource/'.e($resource) ?>">
					<?= csrf_field() ?>
					<?php foreach ($def['fields'] as $name => $f): $type = $f['type'] ?? 'text'; if ($type==='manyToMany' || $type==='file_link') continue; ?>
						<div class="form-section">
							<label class="form-label"><?= e($f['label'] ?? ucfirst($name)) ?></label>
							<?php if ($type==='textarea' || $type==='wysiwyg'): ?>
								<textarea name="<?= e($name) ?>" class="form-control <?= $type==='wysiwyg'?'wysiwyg':'' ?>" rows="5"><?php if (!empty($item[$name])) echo e($item[$name]); ?></textarea>
							<?php elseif ($type==='image' || $type==='file'): ?>
								<?php if (!empty($item[$name])): ?><div class="mb-1"><a target="_blank" href="/uploads/<?= e($item[$name]) ?>">Current</a></div><input type="hidden" name="_keep_<?= e($name) ?>" value="1"><?php endif; ?>
								<input type="file" name="<?= e($name) ?>" class="form-control" <?= $type==='image'?'accept="image/*"':'accept="application/pdf"' ?>>
							<?php elseif ($type==='select'): ?>
								<select name="<?= e($name) ?>" class="form-select">
									<?php foreach (($f['options'] ?? []) as $val => $label): $sel = (string)($item[$name] ?? '')===(string)$val?'selected':''; ?>
										<option value="<?= e($val) ?>" <?= $sel ?>><?= e($label) ?></option>
									<?php endforeach; ?>
								</select>
							<?php elseif ($type==='select_query'): $opts = $relations[$name] ?? []; ?>
								<select name="<?= e($name) ?>" class="form-select">
									<?php foreach ($opts as $row): $sel = (string)($item[$name] ?? '')===(string)$row['id']?'selected':''; ?>
										<option value="<?= (int)$row['id'] ?>" <?= $sel ?>><?= e($row['title'] ?? $row['name']) ?></option>
									<?php endforeach; ?>
								</select>
							<?php else: ?>
								<input name="<?= e($name) ?>" class="form-control" type="<?= $type==='password'?'password':($type==='number'?'number':($type==='date'?'date':($type==='datetime'?'datetime-local':'text'))) ?>" value="<?= e($item[$name] ?? '') ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
					<?php foreach ($def['fields'] as $name => $f): if (($f['type'] ?? '')!=='manyToMany') continue; $opts = $relations[$name] ?? []; $selected = $relations[$name.'_selected'] ?? []; ?>
						<div class="form-section">
							<label class="form-label"><?= e($f['label'] ?? ucfirst($name)) ?></label>
							<select name="<?= e($name) ?>[]" class="form-select" multiple size="6">
								<?php foreach ($opts as $row): $sel = in_array((int)$row['id'], $selected, true)?'selected':''; ?>
									<option value="<?= (int)$row['id'] ?>" <?= $sel ?>><?= e($row['title'] ?? $row['name']) ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endforeach; ?>
					<div class="form-actions sticky-bottom bg-white pt-3">
						<button class="btn btn-primary">Save</button>
						<a class="btn btn-outline-secondary" href="/admin/resource/<?= e($resource) ?>">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<h6 class="text-muted">Tips</h6>
				<p class="small text-muted mb-0">Use descriptive titles and keep content concise. Upload images in JPG/PNG/WebP.</p>
			</div>
		</div>
	</div>
</div>
<?php App\Core\View::end(); ?>