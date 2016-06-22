<div class="row">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#participant" data-toggle="tab">Participants</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="participant">
                    @include('frontend.events.participants._tab',['entity'=>$event,'module'=>'Event'])
                </div>
            </div>
        </div>
    </div>
</div>
