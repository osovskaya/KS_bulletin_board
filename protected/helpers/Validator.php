<?php

class Validator
{
    private static $defaultRules = array(
        'string' => ['length_max', 'length_strict', 'value',],
        'integer',
        'file' => ['mime-type', 'size',]
    );

    private $fields;
    private $rules;

    public function __construct($fields, $rules)
    {
        $this->fields = $fields;
        $this->rules = $rules;
    }

    /**
     * @param $postFields
     * @return bool
     */
    public function checkFields($postFields)
    {
        foreach($postFields as $key => $value)
        {
            if (array_search($key, array_keys($this->fields)) === false) return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function validateFields($postFields)
    {
        foreach($postFields as $key => $value)
        {
            if (!empty($this->rules[$key]['string']))
            {
                if (!is_string($value) && !preg_match('/^[\pL\pM]+$/u', $value))
                {
                    return false;
                }

                $value = strip_tags(htmlentities($value));

                if (array_key_exists('length_max', $this->rules[$key]) &&
                    strlen($value) > $this->rules[$key]['length_max'])
                {
                    return false;
                }

                if (array_key_exists('length_strict', $this->rules[$key]) &&
                    strlen($value) != $this->rules[$key]['length_strict'])
                {
                    return false;
                }

                if (array_key_exists('value', $this->rules[$key]) &&
                    array_search($value, $this->rules[$key]['value']) === false)
                {
                    return false;
                }
            }

            if (!empty($this->rules[$key]['integer']))
            {
                if (!preg_match('/^[0-9]+$/', $value))
                {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function validateFiles($files)
    {
        foreach ($files as $key => $file)
        {
            if ($file['type'] != $this->rules[$key]['file']['mime-type'])
            {
                return false;
            }

            if ($file['size'] > $this->rules[$key]['file']['size'])
            {
                return false;
            }
        }
        return true;
    }
}