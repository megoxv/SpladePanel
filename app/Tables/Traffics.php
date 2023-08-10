<?php

namespace App\Tables;

use App\Models\RateLimit;
use App\Models\Traffic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Traffics extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('traffic_landing', 'LIKE', "%{$value}%")
                        ->orWhere('ip', 'LIKE', "%{$value}%")
                        ->orWhere('operating_system', 'LIKE', "%{$value}%")
                        ->orWhere('code', 'LIKE', "%{$value}%")
                        ->orWhere('country_code', 'LIKE', "%{$value}%")
                        ->orWhere('country_name', 'LIKE', "%{$value}%")
                        ->orWhere('domain', 'LIKE', "%{$value}%");
                });
            });
        });

        return QueryBuilder::for(RateLimit::class)
            ->defaultSort('-created_at')
            ->allowedSorts(['traffic_landing', 'domain', 'ip', 'operating_system', 'created_at'])
            ->allowedFilters(['traffic_landing', 'domain', 'ip', 'operating_system', 'created_at', $globalSearch])
            ->paginate()
            ->withQueryString();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id'])
            ->column('traffic_landing', __('main.traffic_landing'), sortable: true, searchable: true)
            ->column('domain', __("main.domain"), sortable: true, searchable: true)
            ->column('ip', __('main.ip'), sortable: true, searchable: true)
            ->column('operating_system', __('main.operating_system'), sortable: true)
            ->column('browser', __('main.browser'), sortable: true)
            ->column('country', __('main.country'))
            ->column(
                'created_at',
                __('main.created_at'),
                as: fn ($created_at) => Carbon::parse($created_at)->format(getSetting('date_format')),
                sortable: true
            );
    }
}
