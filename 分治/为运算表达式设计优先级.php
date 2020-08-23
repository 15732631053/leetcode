<?php
/**
 * Created by PhpStorm.
 * User: luishuang
 * Date: 2020/7/28
 * Time: 下午6:08
 */
//241. 为运算表达式设计优先级
//给定一个含有数字和运算符的字符串，为表达式添加括号，改变其运算优先级以求出不同的结果。你需要给出所有可能的组合的结果。有效的运算符号包含 +, - 以及 * 。
//
//示例 1:
//
//输入: "2-1-1"
//输出: [0, 2]
//解释:
//((2-1)-1) = 0
//(2-(1-1)) = 2
//示例 2:
//
//输入: "2*3-4*5"
//输出: [-34, -14, -10, -10, 10]
//解释:
//(2*(3-(4*5))) = -34
//((2*3)-(4*5)) = -14
//((2*(3-4))*5) = -10
//(2*((3-4)*5)) = -10
//(((2*3)-4)*5) = 10
//
//https://leetcode-cn.com/problems/different-ways-to-add-parentheses/description/

class Solution {

    public  $operateMap = ["*","-","+"];
    /**
     * @param String $input
     * @return Integer[]
     */
    function diffWaysToCompute($input) {

     if(is_numeric($input)) return [$input];
     $res = [];
     for ($i=0;$i<strlen($input);$i++){
         if(in_array($input[$i],$this->operateMap)){
             $left = substr($input,0,$i);
             $left = $this->diffWaysToCompute($left);
             $right = substr($input,$i+1);
             $right = $this->diffWaysToCompute($right);
             $op = $input[$i];

             foreach ($left as $v){
                 foreach ($right as $j){
                     $res[]=$this->op($v,$op,$j);
                 }
             }

         }
     }
     return ($res);
    }

    public function op($a,$operate,$b)
    {
        switch ($operate){
            case "*";
                return $a*$b;
            case "+";
                return $a+$b;
            case "-";
                return $a-$b;
        }
    }
}

$s = new Solution();
$nums = "2*3-4*5";
$res = $s->diffWaysToCompute($nums);
var_dump($res);