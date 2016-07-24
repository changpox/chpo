<?php
/**
 * Created by PhpStorm.
 * User: kkisgod
 * Date: 2016/7/23
 * Time: 19:20
 */

namespace chpo\captcha;

use yii\captcha\CaptchaAction;

class NumCaptchaAction extends CaptchaAction
{
    /**
     * Generates a new verification code.
     * @return string the generated verification code
     */
    protected function generateVerifyCode()
    {
        if ($this->minLength > $this->maxLength) {
            $this->maxLength = $this->minLength;
        }
        if ($this->minLength < 3) {
            $this->minLength = 3;
        }
        if ($this->maxLength > 20) {
            $this->maxLength = 20;
        }
        $length = mt_rand($this->minLength, $this->maxLength);

        $letters = '0123456789';
        $vowels = '0123456789';
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 5) {
                $code .= $vowels[mt_rand(0, 9)];
            } else {
                $code .= $letters[mt_rand(0, 9)];
            }
        }

        return $code;
    }
}