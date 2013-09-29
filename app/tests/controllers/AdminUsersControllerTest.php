<?php

class AdminUsersControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        //$this->mock = Mockery::mock('Eloquent', 'User');
        //$this->collection = Mockery::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
        //$this->app->instance('User', $this->mock);

        //$user = new User(array('email' => 'elliotfleming@gmail.com'));

        //$this->be($user);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testIndex()
    {
        /*$this->mock
            ->shouldReceive('withTrashed')
            ->once()
            ->andReturn($this->collection);*/
     
        $this->call('GET', '/admin/users');
     
        $this->assertViewHas('users');
    }
/*
    public function testCreate()
    {
        $response = $this->get('/admin/users/create');

        $this->assertResponseOk();
    }
*/
/*
    public function testStore()
    {
        $this->mock->shouldReceive('create')->once();
        $this->validate(true);

        $response = $this->post('/admin/users');

        //$this->assertRedirectedTo('/admin/users');
    }
*/
    protected function validate($bool)
    {
        Validator::shouldReceive('make')
                ->once()
                ->andReturn(Mockery::mock(['passes' => $bool]));
    }
}
