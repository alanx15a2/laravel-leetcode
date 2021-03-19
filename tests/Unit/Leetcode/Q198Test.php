<?php

namespace Tests\Unit\Leetcode;

use PHPUnit\Framework\TestCase;

/**
 * Example 1:
 * Input: nums = [1,2,3,1]
 * Output: 4
 * Explanation: Rob house 1 (money = 1) and then rob house 3 (money = 3).
 * Total amount you can rob = 1 + 3 = 4.
 *
 * Example 2:
 *
 * Input: nums = [2,7,9,3,1]
 * Output: 12
 * Explanation: Rob house 1 (money = 2), rob house 3 (money = 9) and rob house 5 (money = 1).
 * Total amount you can rob = 2 + 9 + 1 = 12.
 */
class Q198Test extends TestCase
{
    /**
     * dynamic
     * @dataProvider question_case
     *
     * @return void
     */
    public function test_q198_dynamic($nums, $ans)
    {
        $myAns = 0;
        $pre1 = 0;
        $pre2 = 0;
        for ($i=0; $i < count($nums); $i++) {
            $myAns = max($pre2 + $nums[$i], $pre1);
            $pre2 = $pre1;
            $pre1 = $myAns;
        }

        $this->assertEquals($ans, $myAns);
    }

    /**
     * recursive
     * @dataProvider question_case
     *
     * @return void
     */
    public function test_q198_recursive($nums, $ans)
    {
        $myAns = $this->q198_recursive($nums, count($nums)-1);
        $this->assertEquals($ans, $myAns);
    }

    public function q198_recursive($nums, $i)
    {
        if ($i<2) {
            $max = 0;
            for ($j=0; $j <= $i; $j++) {
                $max = $nums[$j] > $max ? $nums[$j] : $max;
            }
            return $max;
        }

        return max($this->q198_recursive($nums, $i-2)+$nums[$i], $this->q198_recursive($nums, $i-1));
    }

    public function question_case()
    {
        return [
            [[1,2,3,1], 4],
            [[2,7,9,3,1], 12],
        ];
    }
}
