<div>
    <table class="searchable table table-bordered table-hover">
        <thead>
        <tr>
            <th>Date Collected</th>
            <th>Name of Participant</th>
            <th>Method</th>
            <th>VaultX Collected</th>
            <th>Coordinator Collected</th>
            <th>CC Fees</th>
            <th>Total Collected</th>
        </tr>
        </thead>
        <tbody>
        @forelse($entity->payed_participants as $participant)
            <tr>
                <td>@if (isset($participant->deposit_date)){{$participant->deposit_date->format('m/d/Y')}}@endif</td>
                <td>@if(isset($participant->user_id)){{$participant->user->full_name}}@else {{$participant->name}} @endif</td>
                <td>{{ $participant->deposit_type }}</td>
                <td>${{ number_format($participant->vxp_fees, 2) }}</td>
                <td>${{ number_format($participant->coordinator_collected, 2) }}</td>
                <td>${{ number_format($participant->cc_fees, 2) }}</td>
                <td>${{ number_format($participant->amount_deposited, 2) }}</td>
            </tr>
        @empty
            <tr class="bg-info">
                <td class="text-center text-bold" colspan="18">
                    No participants attached to this {{$module}}
                </td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
        @if($entity->participants->count() > 0)
            <tr>
                <td colspan="3" style="text-align: right">Total:</td>
                <td>${{ number_format($entity->vault_x_collected, 2) }}</td>
                <td>${{ number_format($entity->coordinator_collected, 2) }}</td>
                <td>${{ number_format($entity->commission, 2) }}</td>
                <td>${{ number_format($entity->total, 2) }}</td>
            </tr>
        @endif
        </tfoot>
    </table>
    @if(!$entity->is_close)
        @if(\Auth::user())
            <div class="row">
                @if ($entity->user_id==\Auth::user()->id && is_null($event->closed_date))
                    <div class="col-xs-3">
                        <div class="form-group">
                            <a href="/participant/create?type={{get_class($entity)}}&id={{$entity->id}}"
                               class="btn btn-primary add-participant"><i class="glyphicon glyphicon-plus"></i>Coordinator Payment
                                <small
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Payments made to coordinator in cash"
                                >
                                    <i class="fa fa-info-circle"></i>
                                </small>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-xs-3">
                    @if(\Auth::user() && (count($event->participants)<$event->number_participants || $event->number_participants==0)&& is_null($event->closed_date))
                        <div class="form-group">
                            <a href="{{route('payment',[$event])}}"
                               class="btn btn-primary make-payment"><i class="fa fa-paypal"></i> Make a Payment</a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endif
</div>