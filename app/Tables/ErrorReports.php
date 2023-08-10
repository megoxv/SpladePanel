<?php

namespace App\Tables;

use App\Models\ErrorReport;
use App\Models\ReportError;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ErrorReports extends AbstractTable
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
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        ->orWhere('code', 'LIKE', "%{$value}%")
                        ->orWhere('url', 'LIKE', "%{$value}%")
                        ->orWhere('ip', 'LIKE', "%{$value}%")
                        ->orWhere('device', 'LIKE', "%{$value}%");
                });
            });
        });

        return QueryBuilder::for(ReportError::class)
            ->defaultSort('-created_at')
            ->allowedSorts(['title', 'code', 'url', 'ip', 'device', 'created_at'])
            ->allowedFilters(['user.name', 'title', 'code', 'url', 'ip', 'device', 'created_at', $globalSearch])
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
            ->column('title', __('main.title'), sortable: true)
            ->column('code', __('main.code'), sortable: true)
            ->column('url', __('main.url'), sortable: true)
            ->column('ip', __('main.ip'), sortable: true)
            ->column('user_agent', __('main.device'))
            ->column(
                'created_at',
                __('main.created_at'),
                as: fn ($created_at) => Carbon::parse($created_at)->format(getSetting('date_format')),
                sortable: true
            )
            ->column('action', __('main.action'));
    }
}
