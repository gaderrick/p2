<?php
# Extended the Form class with additional functionality

namespace Derrick;

class MyForm extends \DWA\Form
{

    /**
     * Returns value if the given value is LESS THAN (non-inclusive) the given parameter
     * @param $value
     * @param $parameter
     * @return bool
     */
    protected function maxlength($value, $parameter)
    {
        return strlen($value) <= $parameter;
    }
}