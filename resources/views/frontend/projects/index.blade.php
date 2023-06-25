@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('task_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.tasks.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.task.title_singular') }}
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Task">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.project.fields.id') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.title') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.estimation_cost') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.engineer_owner') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.project_owner') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.pdf_attachment') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.assigned_to') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.project.fields.status') }}
                                        </th>
                                        <th>
                                            {{ trans('global.actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $key => $project )
                                    <tr data-entry-id="{{ $project->id }}">
                                        <td>
                                            {{ $project->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $project->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $project->estimation_cost ?? '' }}
                                        </td>
                                        <td>
                                           {{
                                            $project->engineer_owner
                                           }}

                                        </td>
                                        <td>
                                           {{
                                            $project->project_owner
                                           }}
                                        </td>
                                        <td>
                                            @if ($project->pdf_attachment)
                                                <a href="{{ $project->pdf_attachment ->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $project->assigned_to }}
                                        </td>

                                        <td>
                                            @can('task_show')
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('frontend.tasks.show', $project->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('task_edit')
                                                <a class="btn btn-xs btn-info"
                                                    href="{{ route('frontend.tasks.edit', $project->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('task_delete')
                                                <form action="{{ route('frontend.tasks.destroy', $project->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger"
                                                        value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                            @can('task_edit')
                                                {{-- set status to cloded --}}
                                            @endcan

                                        </td>

                                    </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('task_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('frontend.tasks.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Task:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
