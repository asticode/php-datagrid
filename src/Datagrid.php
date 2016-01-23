<?php
namespace Asticode\Datagrid;

use Psr\Http\Message\ServerRequestInterface;

class Datagrid {

    // Attributes
    private $oPaginator;
    private $oSorter;

    // Constructor
    public function __construct(array $aOptionsSorter, array $aOptionsPaginator)
    {
        $this->oSorter = new Sorter($aOptionsSorter);
        $this->oPaginator = new Paginator($aOptionsPaginator);
    }

    // Methods
    public function parseRequest(ServerRequestInterface $oRequest)
    {
        $this->oSorter->parseRequest($oRequest);
        $this->oPaginator->parseRequest($oRequest);
    }

    public function getPaginator()
    {
        return $this->oPaginator;
    }

    public function getSorter()
    {
        return $this->oSorter;
    }

}