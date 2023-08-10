<?php

namespace App\Tables;

use App\Models\RateLimitDetail;
use App\Models\TrafficsLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TrafficsLogs extends AbstractTable
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
                        ->orWhere('ip', 'LIKE', "%{$value}%")
                        ->orWhere('created_at', 'LIKE', "%{$value}%");
                });
            });
        });

        return QueryBuilder::for(RateLimitDetail::class)
            ->defaultSort('-created_at')
            ->allowedSorts(['ip', 'created_at'])
            ->allowedFilters(['ip', 'created_at', $globalSearch])
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
            ->column('user.name', __('main.name'))
            ->column('coming_from', __('main.coming_from'))
            ->column('entered', __('main.entered'))
            ->column('ip', __('main.ip'), sortable: true)
            ->column('device_details', __('main.device_details'))
            ->column(
                'created_at',
                __('main.created_at'),
                as: fn ($created_at) => Carbon::parse($created_at)->format(getSetting('date_format')),
                sortable: true
            );
    }
}
