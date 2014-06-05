<?php

class BaseModel extends Eloquent {

	private $rules = array();

	private $errors;

	public function validate($data) {
		$v = Validator::make($data,$this->customRules);
		if($v->fails()) {
			$this->errors = $v->errors();
			return false;
		}

		return true;
	}

	public function errors() {
		return $this->errors;
	}

}
