<?php

class HomeTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');
        
        $this->assertResponseOk();
    }
}
