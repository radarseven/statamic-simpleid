<?php 

require_once 'config.php';

class Fieldtype_simpleid extends Fieldtype
{

	var $meta = array(
		'name'			=> SIMPLEID_NAME,
		'version'		=> SIMPLEID_VERSION,
		'author'		=> SIMPLEID_AUTHOR,
		'author_url'	=> SIMPLEID_AUTHOR_URL
	);

	static $field_settings;

	public function render()
	{
		self::$field_settings = $this->field_config;

		if( $this->field_data == '' || is_null($this->field_data) || ! $this->field_data  )
		{
			$this->field_data = self::get_simpleid();
		}

		$data = array(
			'id'       => $this->field_id,
			'value'    => $this->field_data,
			'name'     => $this->fieldname,
			'tabindex' => $this->tabindex,
		);

		$ft_template = File::get( __DIR__ . '/views/ft.simpleid.html' );
		return Content::parse($ft_template, $data);

	}

	public static function get_field_settings() {
		return self::$field_settings;
	}

	function process()
	{
		return $this->field_data;
	}

	private function get_simpleid()
	{
		/**
		 * Borrowed this from the awesome Statmic guys!
		 * @statamic
		 * @fredleblanc
		 * @jackmcdade
		 */
		return uniqid( Helper::getRandomString(6) . Helper::getRandomString(8) );
	}

}