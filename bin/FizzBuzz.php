<?php
namespace bin;


/**
 * @author developer
 * @version 1.0
 *
 */
class FizzBuzz{
    
    private $number_Min = 0;
    
    private $number_Max = 0;
    /**
     * construct of the class
     */
    function FizzBuzz(){
        try {
            
        } catch (Exception $e) {
            
        }
    }
    /**
     * Function to calculate the process for multiple values ​​of number 3 or 5
     * @return string[]|number[]|int[]|string
     */
    public function calcValues()
    {
        try {
            //inicilize array of response
            $result = array();
            //The data will be processed
            for($i= $this->number_Min; $i <= $this->number_Max; $i++ )
            {
                $res = "";
                //If the module is 0, the word fizz is assigned to the result
                if ($i%3 == 0)
                {
                    $res = "fizz";
                }
                //If the module is 0, the word buzz is assigned to the result 
                if ($i%5 == 0)
                {
                    $res .= "buzz";
                }
                //If variable $res is empty, the number is assigned to the result
                if(empty($res))
                {
                    $res.=$i;
                }
                //if variable $i is zero the module is 0 in both cases but not is a value valid
                if($i == 0){
                    $res = $i;
                }
                //the value in de variable res is assigned to the array result
                $result[] = $res;
            }
            
            return $result;
                                    
        } catch (Exception $e) {
            //log the error
            $logger = new Logger('FizzBuzz');
            $logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::INFO));
            $logger->pushHandler(new FirePHPHandler());
            
            $logger->critical("error to calc:".$e->getMessage());
            
            return "Critic Error";
        }
    }
    
    public function validateInfo(){
        try {
            //Valid if the starting number is numeric    
            if(!is_numeric($this->number_Min))
            {
                return "The first number is invalid";
            }
            //Valid if the end number is numeric
            if(!is_numeric($this->number_Max))
            {
                return "The Second Number is invalid";
            }
            //Is validated if the initial number is greater than the final number
            if($this->number_Min > $this->number_Max)
            {
                return "The first number can not be greater than the second";
            }
            //If the process was successful
            return "sucess";
            
        } catch (Exception $e) {
            //log the error
            $logger = new Logger('FizzBuzz');
            $logger->pushHandler(new StreamHandler(__DIR__.'/log/info.log', Logger::INFO));
            $logger->pushHandler(new FirePHPHandler());
            
            $logger->critical("error to validate:".$e->getMessage());
            
            return "Critical error";
        }
    }
    /**
     * @return the $number_Min
     */
    public function getNumber_Min() {
        return $this->number_Min;
    }
    
    /**
     * @return the $number_Max
     */
    public function getNumber_Max() {
        return $this->number_Max;
    }
    
    /**
     * @param int $number_Min
     */
    public function setNumber_Min($number_Min) {
        $this->number_Min = $number_Min;
    }
    
    /**
     * @param int $number_Max
     */
    public function setNumber_Max($number_Max) {
        $this->number_Max = $number_Max;
    }
    
}