@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.project.fields.name') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('name', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
            <label class="required" for="estimation_cost" >{{trans('cruds.project.fields.estimation_cost')}}</label>
            <input class="form-control {{ $errors->has('estimation_cost') ? 'is-invalid' : '' }}" type="number" name="estimation_cost" id="estimation_cost" value="{{ old('estimation_cost', '') }}" required>
            @if($errors->has('estimation_cost'))
                <div class="invalid-feedback">
                    {{ $errors->first('estimation_cost') }}
                </div>
            @endif
            <span class="help-block"> {{trans('cruds.project.fields.estimation_cost_helper')}}</span>
            </div>

            <div class="form-group">
            <label class="required" for="actual_cost" >{{trans('cruds.project.fields.actual_cost')}}</label>
            <input class="form-control {{ $errors->has('actual_cost') ? 'is-invalid' : '' }}" type="number" name="actual_cost" id="actual_cost" value="{{ old('actual_cost', '') }}" required>
            @if($errors->has('actual_cost'))
                <div class="invalid-feedback">
                    {{ $errors->first('actual_cost') }}
                </div>
            @endif
            <span class="help-block"> {{trans('cruds.project.fields.actual_cost_helper')}}</span>
            </div>
            {{-- project Owner

            <div class="form-group">
                <label class="required" for="project_owner">{{ trans('cruds.project.fields.project_owner') }}</label>
                <select class="form-control select2 {{ $errors->has('project_owner') ? 'is-invalid' : '' }}" name="project_owner" id="project_owner" required>
                    @foreach($project_owner as $id => $entry)
                        <option value="{{ $id }}" {{ old('project_owner') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.status_helper') }}</span>
            </div> --}}

            {{-- project Engineer --}}

            <div class="form-group">
                <label class="required" for="engineer_owner">{{ trans('cruds.project.fields.engineer_owner') }}</label>
                <select class="form-control select2 {{ $errors->has('engineer_owner') ? 'is-invalid' : '' }}" name="engineer_owner" id="engineer_owner" required>
                    @foreach($engineer_owner as $id => $entry)
                        <option value="{{ $id }}" {{ old('engineer_owner') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.status_helper') }}</span>
            </div>



            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.project.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.status_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="pdf_attachment">{{ trans('cruds.project.fields.PDF_attachement') }}</label>
                <div class="needsclick dropzone {{ $errors->has('pdf_attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('pdf_attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pdf_attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.PDF_attachement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="excel_attachment">{{ trans('cruds.project.fields.Excel_attachement') }}</label>
                <div class="needsclick dropzone {{ $errors->has('excel_attachment') ? 'is-invalid' : '' }}" id="document-dropzone">
                </div>
                @if($errors->has('excel_attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('excel_attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.PDF_attachement_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="due_date">{{ trans('cruds.project.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
                @if($errors->has('due_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('due_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="assigned_to_id">{{ trans('cruds.project.fields.assigned_to') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                    @foreach($assigned_to as $id => $entry)
                        <option value="{{ $id }}" {{ old('assigned_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assigned_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.assigned_to_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.projects.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="pdf_attachment"]').remove()
      $('form').append('<input type="hidden" name="pdf_attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="pdf_attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($project) && $project->pdf_attachment)
      var file = {!! json_encode($project->pdf_attachment) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="pdf_attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}





Dropzone.options.documentDropzone = {
    url: '{{ route('admin.projects.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="excel_attachment"]').remove()
      $('form').append('<input type="hidden" name="excel_attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="excel_attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($project) && $project->excel_attachment)
      var file = {!! json_encode($project->excel_attachment) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="excel_attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
