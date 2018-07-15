@extends('layouts.cambiemos')
@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title">Calendario de reuniones  | Click aqui para agregar evento ->
                            <a target="_blank" href="https://calendar.google.com/event?action=TEMPLATE&amp;tmeid=NzA1dnEzMWdqczUzMmxpdmc3dmQ2N2VvMHIgNmo5b3BuM3RhMXIycjVoaDYwNG00c2hxY3NAZw&amp;tmsrc=6j9opn3ta1r2r5hh604m4shqcs%40group.calendar.google.com"><img border="0" src="https://www.google.com/calendar/images/ext/gc_button1_es.gif"></a>
                        </h5>
                    </div>
                    <div class="row">
                        <iframe src="https://calendar.google.com/calendar/embed?src=6j9opn3ta1r2r5hh604m4shqcs%40group.calendar.google.com&ctz=America%2FArgentina%2FBuenos_Aires" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

