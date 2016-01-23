<?php
namespace Asticode\Datagrid;

use Psr\Http\Message\ServerRequestInterface;

class Datagrid {

    // Attributes
    private $oPaginator;
    private $oSorter;

    // Constructor
    public function __construct(array $aConfigSorter)
    {
        $this->oSorter = new Sorter($aConfigSorter);
    }

    // Methods
    public function parseRequest(ServerRequestInterface $oRequest)
    {
        $this->oSorter->parseRequest($oRequest);
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