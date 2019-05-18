<?php

use Camino\Lugares;

class LugaresTest extends \PHPUnit\Framework\TestCase
{
	public function testListIsNotEmpty()
	{
		$this->assertNotEmpty(\Camino\Lugares::LIST);
	}

	public function dataProviderForLugaresAreString()
	{
		return array_map(function($elemento) { return [ $elemento ]; }, Lugares::LIST);
	}

	/**
	 * @dataProvider dataProviderForLugaresAreString
	 */
	public function testLugaresAreString($value)
	{
		$this->assertInternalType('string', $value);
	}
}
