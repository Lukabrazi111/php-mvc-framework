<?php

namespace app\core;

abstract class Model
{
    protected static $RULE_REQUIRED = 'required';
    protected static $RULE_EMAIL = 'email';
    protected static $RULE_MIN = 'min';
    protected static $RULE_MAX = 'max';
    protected static $RULE_MATCH = 'match';
    protected array $errors = [];

    /**
     * Check if property exist from extended model.
     *
     * @param $data
     * @return mixed|true
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                return $this->{$key} = $value;
            }
        }

        return true;
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::$RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::$RULE_REQUIRED);
                }

                if ($ruleName === self::$RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::$RULE_MIN, $rule);
                }

                if ($ruleName === self::$RULE_MAX && strlen($value) < $rule['max']) {
                    $this->addError($attribute, self::$RULE_MAX, $rule);
                }

                if ($ruleName === self::$RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::$RULE_EMAIL, $rule);
                }

                if($ruleName === self::$RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::$RULE_MATCH, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    abstract public function rules();

    public function addError($attribute, $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        return $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::$RULE_REQUIRED => 'This field is required.',
            self::$RULE_EMAIL => 'This field must be valid email address.',
            self::$RULE_MAX => 'Max length of this field must be {max}',
            self::$RULE_MIN => 'Min length of this field must be {min}',
            self::$RULE_MATCH => 'This field must be the same as {match}',
        ];
    }
}