<div class="col-sm-6">
    <h1 class="m-0">{!! $title ?? ''  !!} </h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a
                href="{{ auth()?->user()?->hasRole('super admin|doctor|manager') ? route('admin.home.index') : route('home.index') }}">Dashboard</a>
        </li>
        @php $link = '' @endphp
        @for($i = 1; $i <= count(Request::segments()); $i++)
            @if($i < count(Request::segments()) & $i > 0)
                @php $link .= "/" . Request::segment($i) @endphp
                @if ($i == 1)
                    <li class="breadcrumb-item"><a
                            href="{{ $link }}">{{ucwords(str_replace('-',' ',Request::segment($i)))}}</a></li>
                @else
                    <li class="breadcrumb-item"><a
                            href="{{ $link }}">{{ucwords(str_replace('-',' ',Request::segment($i)))}}</a></li>
                @endif
            @else
                <li class="breadcrumb-item active">{{ str_replace('-', ' ', ucwords(Request::segment($i))) }}</li>
            @endif
        @endfor
    </ol>

</div><!-- /.col -->
