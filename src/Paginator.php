<?php
namespace Asticode\Datagrid;

use Psr\Http\Message\ServerRequestInterface;

class Paginator {

    // Attributes
    private $iDefaultPerPage;
    private $iMaxPerPage;
    private $iPage;
    private $iPerPage;

    // Constructor
    public function __construct(array $aOptions = [])
    {
        $this->iDefaultPerPage = isset($aOptions['default_per_page']) ? $aOptions['default_per_page'] : 20;
        $this->iMaxPerPage = isset($aOptions['max_per_page']) ? $aOptions['max_per_page'] : 300;
        $this->iPage = 0;
        $this->iPerPage = 0;
    }

    // Methods
    public function parseRequest(ServerRequestInterface $oRequest)
    {
        // Parse page
        if (array_key_exists('page', $oRequest->getQueryParams())) {
            $this->iPage = intval($oRequest->getQueryParams()['page']);
            if ($this->iPage < 1) {
                $this->iPage = 1;
            }
        } else {
            $this->iPage = 1;
        }

        // Parse per page
        if (array_key_exists('per_page', $oRequest->getQueryParams())) {
            $this->iPerPage = min(intval($oRequest->getQueryParams()['per_page']), $this->iDefaultPerPage);
            if ($this->iPerPage < 1) {
                $this->iPerPage = $this->iDefaultPerPage;
            }
        } else {
            $this->iPerPage = $this->iDefaultPerPage;
        }
    }

    public function getQueryString()
    {
        return sprintf(
            'LIMIT %s,%s',
            ($this->iPage - 1) * $this->iPerPage,
            $this->iPerPage
        );
    }

}