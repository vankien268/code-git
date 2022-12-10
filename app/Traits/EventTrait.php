<?php 
namespace App\Traits;

trait EventTrait
{
	
	public function getAttribute($attribute) {
		
		return $this->{$attribute};
	}
}
	
?>