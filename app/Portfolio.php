<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    public function filter()
    {
        return $this->belongsTo('Corp\PortfolioFilter', 'filter_alias', 'alias');
    }
}
