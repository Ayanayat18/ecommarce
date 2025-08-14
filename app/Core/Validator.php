<?php
namespace App\Core;

class Validator
{
	protected array $data;
	protected array $files;
	protected array $rules = [];
	protected array $errors = [];
	protected array $validated = [];

	public function __construct(array $data, array $files = []) { $this->data = $data; $this->files = $files; }
	public function rules(array $rules): void { $this->rules = $rules; }
	public function errors(): array { return $this->errors; }
	public function validated(): array { return $this->validated; }

	public function validate(): bool {
		foreach ($this->rules as $field => $ruleStr) {
			$rules = is_array($ruleStr) ? $ruleStr : explode('|', $ruleStr);
			$value = $this->data[$field] ?? null;
			foreach ($rules as $rule) {
				[$name, $param] = array_pad(explode(':', $rule, 2), 2, null);
				switch ($name) {
					case 'required':
						if ($value === null || $value === '') $this->addError($field, 'This field is required.');
						break;
					case 'email':
						if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) $this->addError($field, 'Invalid email.');
						break;
					case 'min':
						if ($value !== null && mb_strlen((string)$value) < (int)$param) $this->addError($field, 'Too short.');
						break;
					case 'max':
						if ($value !== null && mb_strlen((string)$value) > (int)$param) $this->addError($field, 'Too long.');
						break;
					case 'in':
						$allowed = explode(',', (string)$param);
						if ($value !== null && !in_array($value, $allowed, true)) $this->addError($field, 'Invalid value.');
						break;
					case 'int':
						if ($value !== null && filter_var($value, FILTER_VALIDATE_INT) === false) $this->addError($field, 'Must be integer.');
						break;
					case 'numeric':
						if ($value !== null && !is_numeric($value)) $this->addError($field, 'Must be numeric.');
						break;
					case 'file':
						if (!isset($this->files[$field]) || $this->files[$field]['error'] === UPLOAD_ERR_NO_FILE) {
							$this->addError($field, 'File is required.');
						}
						break;
					case 'mimes':
						$allowed = explode(',', (string)$param);
						if (isset($this->files[$field]) && $this->files[$field]['error'] === UPLOAD_ERR_OK) {
							$finfo = new \finfo(FILEINFO_MIME_TYPE);
							$mime = $finfo->file($this->files[$field]['tmp_name']);
							$map = [
								'jpg' => 'image/jpeg','jpeg' => 'image/jpeg','png' => 'image/png','webp' => 'image/webp','pdf' => 'application/pdf'
							];
							$ok = false;
							foreach ($allowed as $ext) { if (($map[$ext] ?? '') === $mime) { $ok = true; break; } }
							if (!$ok) $this->addError($field, 'Invalid file type.');
						}
						break;
					case 'max_mb':
						$maxBytes = (int)$param * 1024 * 1024;
						if (isset($this->files[$field]) && $this->files[$field]['error'] === UPLOAD_ERR_OK) {
							if ($this->files[$field]['size'] > $maxBytes) $this->addError($field, 'File too large.');
						}
						break;
				}
			}
			if (!isset($this->errors[$field])) {
				$this->validated[$field] = is_string($value) ? trim($value) : $value;
			}
		}
		return empty($this->errors);
	}

	protected function addError(string $field, string $message): void { $this->errors[$field][] = $message; }
}