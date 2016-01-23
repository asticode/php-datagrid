<?php
namespace Asticode\Datagrid;

use Psr\Http\Message\ServerRequestInterface;

class Sorter {

    // Attributes
    private $aAllowedLabels;
    private $aCriterias;
    private $aCriteriaQueryStrings;

    // Constructor
    public function __construct(array $aAllowedLabels)
    {
        $this->aAllowedLabels = $aAllowedLabels;
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
        $aStrings = [$sBeforeQueryString];
        $aStrings += $this->aCriteriaQueryStrings;
        $aStrings = array_merge($aStrings, $sAfterQueryString);

        // Return
        return 'ORDER BY ' . implode(',', $aStrings);
    }

}