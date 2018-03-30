<?php

namespace BrainySoft\ConfigData\Http\Controllers;

use App\Http\Controllers\Controller;
use BrainySoft\ConfigData\Services\ConfigFactory;
use Illuminate\Http\Response;

class ConfigDataController extends Controller
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $dbConfig = $this->configFactory->getDatabaseConfig();
        return response(get_class($this) . ' index action ' . print_r($dbConfig->getAllSettings(), true));
    }

}
