<?php

namespace Tests\Unit;

use App\Traits\LogData;
use PHPUnit\Framework\TestCase;

class LogTraitTest extends TestCase
{
    use LogData;

    public Array $old = [];
    public Array $dirty = [];

    function getOriginal(): Array {
        return $this->old;
    }

    function getDirty(): Array {
        return $this->dirty;
    }

    function test_model_has_no_change() {
        $this->old = [];
        $this->dirty = [];

        $data = $this->logProp();

        $this->assertEmpty($data['old']);
    }

    function test_model_has_one_change() {
        $this->old = ["name" => "John", "age" => 12];
        $this->dirty = ["age" => "12"];

        $data = $this->logProp();

        $this->assertCount(1, $data['new']);
        $this->assertArrayHasKey("age", $data['new']);
        $this->assertEquals('12', $data['new']['age']);
    }

}
