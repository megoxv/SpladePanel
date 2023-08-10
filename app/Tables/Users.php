<?php

namespace App\Tables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Users extends AbstractTable
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
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('username', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });

        return QueryBuilder::for(User::class)
            ->defaultSort('-created_at')
            ->allowedSorts(['name', 'username', 'email'])
            ->allowedFilters(['name', 'username', 'email', 'status', $globalSearch])
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
            ->withGlobalSearch(columns: ['id', 'name', 'username', 'email'])
            ->column('name', __('main.name'), sortable: true, searchable: true)
            ->column('username', __('main.username'), sortable: true, searchable: true)
            ->column('email', __('main.email'), sortable: true, searchable: true)
            ->column(
                'created_at',
                __('main.joined'),
                as: fn ($created_at) => Carbon::parse($created_at)->format(getSetting('date_format')),
                sortable: true
            )
            ->column('roles', __('main.roles'))
            ->column('status', __('main.status'))
            ->column('actions', __('main.action'))
            ->selectFilter(key: 'status', label: __('main.status'), options: [
                'Active' => __('main.active'),
                'Banned' => __('main.banned'),
            ]);
    }
}
