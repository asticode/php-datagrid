<?php
namespace Asticode\Datagrid;

use Psr\Http\Message\ServerRequestInterface;

class Sorter {

    // Attributes
    private $aAllowedLabels;
    private $aCriterias;
    private $aCriteriaQueryStrings;

    // Constructor
    public function __construct(array $aOptions)
    {
        $this->aAllowedLabels = isset($aOptions['allowed_labels']) ? $aOptions['allowed_labels'] : [];
        foreach ($this->aAllowedLabels as $sLabel => $sValue) {
            $this->aAllowedLabels['-' . $sLabel] = $sValue;
        }
        $this->aCriterias = [];
        $this->aCriteriaQueryStrings = [];
    }

    // Methods
    public function parseRequest(ServerRequestInterface $oRequest)
    {
        // Sort query parameter exists
        if (array_key_exists('sort', $oRequest->getQueryParams())) {
            // Loop through sort labels
            foreach (explode(',', $oRequest->getQueryParams()['sort']) as $sLabel) {
                // Label is allowed
                if (array_key_exists($sLabel, $this->aAllowedLabels)) {
                    // Create sorter criteria
                    $oSorterCriteria = new SorterCriteria($sLabel, $this->aAllowedLabels[$sLabel]);

                    // Update
                    $this->aCriterias[] = $oSorterCriteria;
                    $this->aCriteriaQueryStrings[] = $oSorterCriteria->getQueryString();
                }
            }
        }
    }

    public function getQueryString($sBeforeQueryString = '', $sAfterQueryString = '')
    {
        // Initialize
        $aStrings = $this->aCriteriaQueryStrings;
        if ($sBeforeQueryString !== '') {
            array_unshift($aStrings, $sBeforeQueryString);
        }
        if ($sAfterQueryString !== '') {
            array_push($aStrings, $sAfterQueryString);
        }

        // Return
        return count($aStrings) > 0 ? 'ORDER BY ' . implode(',', $aStrings) : '';
    }

}