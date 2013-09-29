<?php

/**
 * Extended Laravel TestCase Methods:
 *
 * setUp()
 * refreshApplication()
 * call()
 * callSecure()
 * action(method, $action, $wildcards = array(), $parameters = array(), $files = array(), $server = array(), $content = null, $changeHistory = true)
 * route($method, $name, $routeParameters = array(), $parameters = array(), $files = array(), $server = array(), $content = null, $changeHistory = true)
 * assertResponseOk()
 * assertResponseStatus($code)
 * assertViewHas($key, $value = null)
 * assertViewHasAll(array $bindings)
 * assertRedirectedTo($uri, $with = array())
 * assertRedirectedToRoute($name, $parameters = array(), $with = array())
 * assertRedirectedToAction($name, $parameters = array(), $with = array())
 * assertSessionHas($key, $value = null)
 * assertSessionHasAll(array $bindings)
 * assertSessionHasErrors($bindings = array(), $format = null)
 * be(UserInterface $user, $driver = null))
 * seed($class = 'DatabaseSeeder')
 * createClient(array $server = array())
 */

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
	/**
	 * Default preparation for each test
	 *
	 */
	public function setUp()
	{
	    parent::setUp();
	 
	    $this->prepareForTests();
	}

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	 * Migrates the database and set the mailer to 'pretend'.
	 * This will cause the tests to run quickly.
	 */
	private function prepareForTests()
	{
		// Setup the SQLite database
	    Artisan::call('migrate');
	    $this->seed('TestDatabaseSeeder');

	    // Mock emails
	    Mail::pretend(true);
	}

	/**
	 * Overloading -> enhance the call() helper method
	 * 
	 * $this->client->request('GET', '/'); // Base functionality
	 * $this->call('GET', '/');            // Laravel Helper method
	 * $this->get('/')					   // This function
	 */
	public function __call($method, $args)
	{
	    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
	    {
	        return $this->call($method, $args[0]);
	    }
	 
	    throw new BadMethodCallException;
	}
}
