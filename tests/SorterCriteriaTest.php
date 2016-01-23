<?php
namespace Asticode\Datagrid\Tests;

use Asticode\Datagrid\Enum\SorterDirection;
use Asticode\Datagrid\SorterCriteria;
use PHPUnit_Framework_TestCase;

class SorterCriteriaTest extends PHPUnit_Framework_TestCase {

    function testConstruct() {
        // Initialize
        $sLabel = 'label_test';
        $sValue = 'value_test';

        // Create sorter criterias
        $oSorterCriteria1 = new SorterCriteria($sLabel, $sValue);
        $oSorterCriteria2 = new SorterCriteria('-' . $sLabel, $sValue);

        // Assert
        $this->assertEquals(SorterDirection::ASC, $oSorterCriteria1->getDirection());
        $this->assertEquals($sValue . ' ASC', $oSorterCriteria1->getQueryString());
        $this->assertEquals(SorterDirection::DESC, $oSorterCriteria2->getDirection());
        $this->assertEquals($sValue . ' DESC', $oSorterCriteria2->getQueryString());
    }

}