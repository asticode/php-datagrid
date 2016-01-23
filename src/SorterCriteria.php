<?php
namespace Asticode\Datagrid;

use Asticode\Datagrid\Enum\SorterDirection;

class SorterCriteria {

    // Attributes
    private $sDirection;
    private $sQueryString;
    private $sValue;

    // Constructor
    public function __construct($sLabel, $sValue)
    {
        if ($sLabel[0] == '-') {
            $this->sDirection = SorterDirection::DESC;
        } else {
            $this->sDirection = SorterDirection::ASC;
        }
        $this->sValue = $sValue;
        $this->sQueryString = $sValue . ' ' . $this->sDirection;
    }

    // Methods
    public function getDirection() {
        return $this->sDirection;
    }

    public function getQueryString() {
        return $this->sQueryString;
    }

    public function getValue() {
        return $this->sValue;
    }

}