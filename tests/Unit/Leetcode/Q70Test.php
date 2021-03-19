<?php

namespace Tests\Unit\Leetcode;

use Tests\TestCase;

/**
 * N 阶楼梯，每次可以上一阶或者两阶，求有多少种上楼梯的方法。
 */
class Q70Test extends TestCase
{
    /**
     * 數學法
     * @test
     * @dataProvider stair_provider
     *
     * @return void
     */
    public function test_climb_math($stair, $ans)
    {
        $myAns = ((sqrt(5) / 5)) * ((((1+sqrt(5)) / 2) ** ($stair+1)) - (((1-sqrt(5)) / 2) ** ($stair+1)));
        $myAns = floor($myAns);

        $this->assertEquals($ans, $myAns);
    }

    /**
     * 動態規劃法
     * @dataProvider stair_provider
     *
     * @return void
     */
    public function test_climb_dynamic($stair, $ans)
    {
        $myAns = $this->climb_dynamic($stair);
        $this->assertEquals($ans, $myAns);
    }

    public function climb_dynamic($stair)
    {
        if ($stair <= 2) {
            return $stair;
        }

        $pre1 = 2;
        $pre2 = 1;
        for ($i=2; $i < $stair; $i++) {
            $ans = $pre1 + $pre2;
            $pre2 = $pre1;
            $pre1 = $ans;
        }

        return $ans;
    }

    /**
     * 遞迴
     * @dataProvider stair_provider
     *
     * @return void
     */
    public function test_climb_recursion($stair, $ans)
    {
        $myAns = $this->climb_recursion($stair+1);
        $this->assertEquals($ans, $myAns);
    }

    public function climb_recursion($stair)
    {
        if ($stair <= 2) {
            return 1;
        }
        return $this->memo[$stair] ?? $this->memo[$stair] = $this->climb_recursion($stair-1) + $this->climb_recursion($stair-2);
    }


    public function stair_provider()
    {
        return [
            [1, 1],
            [2, 2],
            [3, 3],
            [4, 5],
            [5, 8],
            [6, 13],
            [7, 21],
            [8, 34],
            [9, 55],
            [10, 89],
        ];
    }
}
