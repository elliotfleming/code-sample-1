<?php

use Mockery as m;

class AdminControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->mock = $this->mock('EveryEquity\Storage\User\UserRepositoryInterface');
        $this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
    }

    public function mock($class)
    {
        $mock = m::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    public function tearDown()
    {
        m::close();
    }

    public function testIndexRespondsToGetRequests()
    {
        $user = new User(array('email' => 'elliotfleming@gmail.com'));
        /*$this->mock
            ->shouldReceive('getAttribute')
            ->andReturn('attribute');*/

        $this->mock
            ->shouldReceive('all')
            ->once()
            ->andReturn($this->collection);

        //$this->be($this->mock);
        $this->be($user);

        $response = $this->get('/admin');

        $this->assertResponseOk();

        //$this->assertViewHas('users');

        //$users = $response->original->getData()['users'];

        //$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $users);
    }

    public function testIndexReturnsTheUserCollection()
    {
        /*$this->mock
            ->shouldReceive('all')
            ->once()
            ->andReturn($this->collection);

        $admin = new AdminController($this->mock);
        $admin->getIndex();*/
    }
}
