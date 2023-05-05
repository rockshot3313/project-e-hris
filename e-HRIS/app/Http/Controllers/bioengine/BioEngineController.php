<?php

namespace App\Http\Controllers\bioengine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rr\Rewards;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Session;


class BioEngineController extends Controller
{

	public function get_settings() {
		return $this->_get_settings();
	}

	public function _get_settings() {
		/***/
		$url_base = "http://localhost:5656"; // FP local address
		/***/
		$result = [
			"api_key" => "bioEngine2023",
			"url_base" => $url_base,
			"url_check" => $url_base . "/check",
			"url_fp_get" => $url_base . "/getfp",
			"url_fp_sync_local" => $url_base . "/fpsynclocal",
			"conn_timeout" => "1000",
			"com_interval" => "1000",
			"auto_fp_data_get" => 1,
		];
		/***/
		return $result;
	}

}