<?php

namespace app\core;

abstract class Model
{
    protected static $RULE_REQUIRED = 'required';
    protected static $RULE_MIN = 'min';
    protected static $RULE_MAX = 'max';
    protected static $RULE_MATCH = 'match';
    protected static $RULE_EMAIL = 'email';

    abstract public function rules();
}