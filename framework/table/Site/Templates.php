<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Site;

class Templates extends \We7Table {
	protected $tableName = 'site_templates';
	protected $primaryKey = 'id';
	protected $field = array(
		'name',
		'version',
		'title',
		'description',
		'author',
		'url',
		'type',
		'sections',
	);
	protected $default = array(
		'name' => '',
		'version' => '',
		'title' => '',
		'description' => '',
		'author' => '',
		'url' => '',
		'type' => '',
		'sections' => '',
	);

	public function getAllTemplates() {
		return $this->query->getall('name');
	}

	public function getByName($name) {
		return $this->query->where('name', $name)->get();
	}
}