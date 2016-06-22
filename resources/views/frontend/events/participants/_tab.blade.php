<div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Participant</th>
            <th>Email</th>
            <th>Amount Deposit</th>
            <th>Deposit Type</th>
            <th>Deposit Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @forelse($entity->participants as $participant)
                <td>@if(isset($participant->user_id)){{$participant->user->full_name}}@else Anonymous @endif</td>
                <td>@if(isset($participant->user_id)){{$participant->user->email}}@else Anonymous @endif</td>
                <td>{{$participant->amount_deposited}}</td>
                <td>{{$participant->deposit_type}}</td>
                <td>@if (isset($participant->deposit_date)){{$participant->deposit_date->format('m/d/Y')}}@endif</td>
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
</div>