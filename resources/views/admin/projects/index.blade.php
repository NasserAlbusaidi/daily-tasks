@extends('layouts.admin')
@section('content')
    @can('task_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.projects.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.project.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Task">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.project.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.owner') }}
                            </th>

                            <th>
                                {{ trans('cruds.project.fields.estamtion_cost') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.actual_cost') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.vote_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.PDF_attachement') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.Excel_attachement') }}
                            </th>

                            <th>
                                {{ trans('cruds.project.fields.engineer_owner') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $key => $project)
                            <tr data-entry-id="{{ $project->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $project->id ?? '' }}
                                </td>
                                <td>
                                    {{ $project->title ?? '' }}
                                </td>

                                <td>
                                    {{ $project->owner_name->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->estimation_cost ?? '' }}
                                </td>
                                <td>
                                    {{ $project->actual_cost ?? '' }}
                                </td>
                                <td>
                                    {{ $project->vote_number ?? '' }}
                                </td>
                                <td>
                                    @if ($project->pdf)
                                        <a href="{{ $project->pdf->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    @if ($project->excel)
                                        <a href="{{ $project->excel->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif

                                <td>
                                    {{ $project->engineer_name->name ?? '' }}
                                </td>
                                <td>
                                    @can('task_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.projects.show', $project->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('task_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.projects.edit', $project->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>

                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.projects.tasks', $project->id) }}">
                                            {{ trans('global.tasks') }}
                                        </a>

                                    @endcan

                                    @can('task_delete')
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            @can('task_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.projects.massDestroy') }}",
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
                //add select all checkbox
                dtButtons.push(deleteButton)
                //remove export buttons from pdf and excel
                dtButtons.splice(2, 6)
            @endcan

            let exportPdfButton = {
                extend: 'pdfHtml5',
                text: 'Projects Report PDF',
                className: 'btn-info',
                //exclude columns from pdf
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 9]
                },
                //page title
                title: 'Projects Report',
                //change header width

                customize: function(doc) {

                    doc.styles.title = {
                        color: 'red',
                        fontSize: '20',
                        alignment: 'center'
                    };

                    doc.defaultStyle.alignment = 'center';
                    //set header width to 50%
                    doc.content[1].table.widths = ['*', '*', '*', '*', '*', '*'];
                                }
            }

            let exportExcelButton = {
                extend: 'excelHtml5',
                text: 'Projects Report Excel',
                className: 'btn-success',
                //exclude columns from excel
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 9]
                },
                //page title
                title: 'Projects Report',
                //change header width

                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="C"]', sheet).attr('s', '2');
                }
            }

                dtButtons.push(exportPdfButton)
                dtButtons.push(exportExcelButton)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Task:not(.ajaxTable)').DataTable({
                buttons: [
                    dtButtons
                ]

            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
