<div class="card">
    <div class="card-header">
        <h3 class="card-title">{!! $table_title ?? 'Table' !!}</h3>
        {{ $filter_selection ?? '' }}
        @isset($paginator)
        <div class="card-tools">
            {{ $paginator->links('includes.pagination', ["position"=>"float-right"])}}
        </div>
        @endisset
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
            <tr>
                @foreach($theads as $thead)
                <th>{{ $thead }}</th>
{{--                <th>Task</th>--}}
{{--                <th>Progress</th>--}}
{{--                <th style="width: 40px">Label</th>--}}
                @endforeach
            </tr>
            </thead>
            <tbody>
            {{ $table_body }}
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
