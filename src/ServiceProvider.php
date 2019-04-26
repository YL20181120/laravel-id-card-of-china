<?php
/**
 * Date: 2019/4/26 10:56
 * Copyright (c) Youjingqiang <youjingqiang@gmail.com>
 */

namespace YL20181120\LaravelIdCard;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('idcard', function ($attribute, $value, $parameters, $validator) {
//            return IdCard::passes($value);
            $identity = new \jasmine2\IdentityCard\China\Identity($value);
            return $identity->legal();
        });
        Validator::replacer('idcard', function ($message, $attribute, $rule, $parameters) {
            return '无效的身份证号码';
        });
    }
}
