
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->

        <div class="p-3 pb-0">
            Switch Portal
        </div>
@php
{{
        $portals = DB::connection('default_database')->table('user_portals')
        ->leftJoin('portals', 'portals.id', '=', 'portal_id')
        ->where('user_id', Auth::user()->id)
        ->get();
}}
@endphp

        @if($portals)
            @foreach($portals as $portal)
            <a href="{{config('app.domain').'/'.($portal->directory)}}">
                <div class="p-1 pl-3">
                    <h5 class="{{ $portal->code==config('app.title') ? 'text-success':''}}">{{$portal->title}}</h5>
                    <p>{{$portal->description}}</p>
                </div>
            </a>
            <hr>
            @endforeach
        @endif
    </aside>
    <!-- /.control-sidebar -->
