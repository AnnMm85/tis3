<?php
require_once '../tispractic3/collect/src/Collect.php';
require_once '../tispractic3/collect/src/helpers.php';

use PHPUnit\Framework\{TestCase};
use function Collect\collection;

class CollectTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect\Collect([13, 17]);
        $this->assertSame(2, $collect->count());
    }

    public function testKeys()
    {
        $collect = new Collect\Collect(array("one" => "valueOne", "two" => "valueTwo"));
        $this->assertSame(array("one", "two"), $collect->keys());
    }

    public function testValues()
    {
        $collect = new Collect\Collect(array("one" => "valueOne", "two" => "valueTwo"));
        $this->assertSame(array("valueOne", "valueTwo"), $collect->values());
    }

    public function testGet()
    {
        $mass = ["one" => 1, "" => 2, "three" => 3];
        $collect = new Collect\Collect((array)$mass[""]);
        $this->assertSame(2, $collect->get($key = ""));
    }

    public function testExcept()
    {
        $ars = array(0 => ["one" => 1, "five" => 5], 5 => "five");
        $collect = new Collect\Collect($ars);
        $this->assertSame(collection(["one" => 1, "five" => 5]), $collect->except(...$ars));
    }

    public function testOnly()
    {
        $ars = array(0 => ["one" => 1, "five" => 5], 5 => "five");
        $collect = new Collect\Collect($ars);
        $this->assertSame(collection([5 => "five"]), $collect->only(...$ars));
    }

    public function testFirst()
    {
        $ars = array(4, 0 => ["one" => 1, "five" => 5], 5 => "five");
        $collect = new Collect\Collect($ars);
        $this->assertSame([4], $collect->first());
    }

    public function testToArray()
    {
        $ars = array(4, 2, 12);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(4, 2, 12), $collect->toArray());
    }
    public function testSearch()
    {
        $ars = array("one" => 1, "two" => 2, 0 => 54);
        $collect = new Collect\Collect($ars);
        $this->assertSame(54, $collect->search("one", 1));
    }
    public function testMap()
    {   $callback = function(int $n): int{
        return ($n * 2);
    };
        $ars = array(1, 2, 3);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(2, 4, 6), $collect->map($callback));
    }
    public function testFilter()
    {   $callback = function(int $n): int{
        return (2);
    };
        $ars = array(1, 2, 3);
        $collect = new Collect\Collect($ars);
        $this->assertSame(2, $collect->filter($callback));
    }
    public function testEach()
    {   $callback = function(int $item, $key, ...$ags): array{
        return (array($item * $key => [...$ags]));
    };
        $ars = array(1 => 10, 2 => 20);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(10 => array(1 => 10, 2 => 20), 20 => array(1 => 10, 2 => 20)), $collect->each($callback, ...$ars));
    }
    public function testPush()
    {   $value = array(1, 2);
        $ars = array("one" => 1, "two" => 2, 0 => 54);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(1, 2), $collect->push($value, $key = ""));
    }
    public function testUnshift()
    {   $ars = array(1, 2);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(3, 1, 2), $collect->unshift(3));
    }
    public function testShift()
    {
        $collect = new Collect\Collect(array("one", "two", "three"));
        $this->assertSame(array("two", "three"), $collect->shift());
    }

    public function testPop()
    {
        $collect = new Collect\Collect(array("apple", "banana", "orange"));
        $this->assertSame(array("apple", "banana"), $collect->pop());
    }
    public function testSplice()
    {
        $ars = array(1, 2, 3, 4);
        $collect = new Collect\Collect($ars);
        $this->assertSame(array(1), $collect->splice($ars));
    }
}