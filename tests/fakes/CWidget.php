<?php
/**
 * Fake for the real CWidget class from Yii framework.
 * It's used by all widgets under test to separate them from the rest of the huge system which Yii is.
 */

class CWidget
{

	/** @var string Fake ID which we can set in our tests to get meaningful results from `getId()` calls. */
	public static $fake_id;

	public function getId()
	{
		return self::$fake_id;
	}
}