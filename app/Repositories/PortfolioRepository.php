<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 27.10.17
 * Time: 14:45
 */

namespace Corp\Repositories;

use Corp\Portfolio;

class PortfolioRepository extends Repository
{
    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }


}