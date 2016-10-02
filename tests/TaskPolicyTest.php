<?php

class TaskPolicyTest extends TestCase
{
    public function testDestroyGood()
    {
        $User = new \App\User();
        $User->id = 2;
        $Task = new \App\Task();
        $Task->user_id = 2;
        $TaskPolicy = new \App\Policies\TaskPolicy();
        $this->assertEquals(true, $TaskPolicy->destroy($User, $Task));
    }

    public function testDestroyBad()
    {
        $User = new \App\User();
        $User->id = 1;
        $Task = new \App\Task();
        $Task->user_id = 2;
        $TaskPolicy = new \App\Policies\TaskPolicy();
        $this->assertEquals(false, $TaskPolicy->destroy($User, $Task));
    }
}
