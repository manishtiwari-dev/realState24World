<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'user_logs';
    protected $guarded = array();

    function addToLog($module, $subject, $querytype, $queryrequest)
    {
        if ($queryrequest != NULL) {
            $queryrequest = json_encode($queryrequest);
        }
        $log = [];
        $log['module'] = $module;
        $log['subject'] = $subject;
        $log['query_type'] = $querytype;
        $log['query_request'] = $queryrequest;
        $log['url'] = request()->fullUrl();
        $log['method'] = request()->method();
        $log['ip'] = request()->ip();
        $log['agent'] = request()->header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 0;

        static::create($log);
        
        return true;
    }
}
