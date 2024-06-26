<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use illuminate\Http\Request;

class InvoicesFilter extends ApiFilter
{
    protected $safeParms = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'lt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'billedDate' => ['eq', 'lt', 'lte', 'gte'],
        'postDate' => ['eq', 'lt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'postDate' => 'post_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];

    // public function transform(Request $request)
    // {
    //     $eloQuery = [];
    //     foreach ($this->safeParms as $parm => $operators) {
    //         $query = $request->query($parm);

    //         if (!isset($query)) {
    //             continue;
    //         }
    //         $column = $this->columnMap[$parm] ?? $parm;
    //         foreach ($operators as $operator) {
    //             if (isset($query[$operator])) {
    //                 $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
    //             }
    //         }
    //     }
    //     return $eloQuery;
    // }
}
