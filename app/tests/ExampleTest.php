<?php

function link_me_to($url, $body, $parameters = null)
{
	// Slime
	//return "<a href='http://:/dogs/1'>Show Dog</a>";
	
	// Generalize
	$url = url($url);
	$attributes = '';

	/*if ($parameters)
	{
		foreach($parameters as $attribute => $value)
		{
			$attributes .= " {$attribute}=\"{$value}\"";
		}
	}*/

	$attributes = $parameters ? HTML::attributes($parameters) : '';
	
	return "<a href=\"{$url}\"{$attributes}>{$body}</a>";
}

function array_until($stopPoint, $arr)
{
    $index = array_search($stopPoint, $arr);

    if (false === $index)
    {
        throw new InvalidArgumentException('Key does not exist in array');
    }

    return array_slice($arr, 0, $index);
}

class ExampleTest extends TestCase
{
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	public function testAppliesAttributesUsingArray()
	{
		$base = url(); // URL::to();

		$actual = link_me_to('/dogs/1', 'Show Dog', ['class' => 'button']);
		$expect = "<a href=\"$base/dogs/1\" class=\"button\">Show Dog</a>";

		$this->assertEquals($expect, $actual);
	}

	public function testGeneratesAnchorTag()
	{
		$base = url(); // URL::to();

		$actual = link_me_to('dogs/1', 'Show Dog');
		$expect = "<a href=\"$base/dogs/1\">Show Dog</a>";

		$this->assertEquals($expect, $actual);
	}

	/**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionIfValueDoesNotExist()
    {
        // Given this set of data
        $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];

        // When I call the until function and
        // specify a different value
        $result = array_until('Elliot', $names);

        // Then an exception should be thrown (see doc-block)
        //$expected = ['Taylor', 'Dayle'];
        //$this->assertEquals($expected, $result);
    }
}
