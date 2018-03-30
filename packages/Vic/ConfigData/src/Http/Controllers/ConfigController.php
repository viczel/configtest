<?php

namespace BrainySoft\ConfigData\Http\Controllers;

use App\Http\Controllers\Controller;
use BrainySoft\ConfigData\Services\ConfigFactory;
use Illuminate\Http\Response;

class ConfigController extends Controller
{
    protected $configFactory = null;

    /**
     * ConfigDataController constructor.
     *
     * @param \BrainySoft\ConfigData\Services\ConfigFactory $configFactory
     */
    public function __construct(ConfigFactory $configFactory)
    {
        $this->configFactory = $configFactory;
    }


}
