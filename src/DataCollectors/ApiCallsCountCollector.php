<?php

namespace InfyOm\RoutesExplorer\DataCollectors;

use Illuminate\Http\Request;
use InfyOm\RoutesExplorer\Models\ApiCallsCount;

class ApiCallsCountCollector implements DataCollectorInterface
{
    public function collect(Request $request)
    {
        $apiCall = new ApiCallsCount([
            'url' => $request->route()->uri()
        ]);

        $providerId = \Request::header('provider-Id');
        $adminId = \Auth::id();

        $providerId = isset($providerId)?$providerId:null;
        $adminId = isset($adminId)?$adminId:null;

        $apiCall->adminUserId = $adminId;
        $apiCall->corporateClientId = $providerId;
        $apiCall->save();
    }
}
