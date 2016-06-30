<div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Participant</th>
            <th>Email</th>
            <th>Amount Deposit</th>
            <th>Deposit Type</th>
            <th>Deposit Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @forelse($entity->participants as $participant)
                <td>@if(isset($participant->user_id)){{$participant->user->full_name}}@else Anonymous @endif</td>
                <td>@if(isset($participant->user_id)){{$participant->user->email}}@else Anonymous @endif</td>
                <td>{{number_format($participant->amount_deposited,2)}}</td>
                <td>{{$participant->deposit_type}}</td>
                <td>@if (isset($participant->deposit_date)){{$participant->deposit_date->format('m/d/Y')}}@endif</td>
                <td>
                    @if(!$entity->is_close)
                        <a href="{!! route('admin.participant.edit', ['participant'=>$participant, 'type'=>get_class($participant), 'id'=>$participant->id]) !!}"
                           class="btn btn-xs btn-primary edit-participant">
                            <i class="fa fa-edit"></i>
                        </a>
                        {!! Form::open(['route'=>['admin.participant.destroy', $participant->id], 'method'=>'DELETE', 'style'=>'display:inline-block'])!!}
                        <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                    @else
                        Unavailable
                    @endif
                </td>
        </tr>
        @empty
            <tr>
                <td class="bg-info text-center text-bold" colspan="18">
                    No participants attached to this {{$module}}
                </td>
            </tr>
        @endforelse
        <tbody>
    </table>
    @if(!$entity->is_close)
        <div class="form-group">
            <a href="/admin/participant/create?type={{get_class($entity)}}&id={{$entity->id}}"
               class="btn btn-primary add-participant"><i class="glyphicon glyphicon-plus"></i>Add Participant</a>
        </div>
    @endif
</div>