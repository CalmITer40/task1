<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait RequestDataHelper
{
    /**
     * @param Request $request
     * @return array
     */
    public function getData(Request $request)
    {
        return [
            'user' => $request->user(),
            'query' => $request->query(),
            'body' => $request->all()
        ];
    }
}
