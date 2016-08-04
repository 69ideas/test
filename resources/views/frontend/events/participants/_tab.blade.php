<div>
    <table class="searchable table table-bordered table-hover">
        <thead>
        <tr>
            <th>Date Collected
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Date Collected">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Name of Participant
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Name of Participant">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Method
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Method">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>VaultX Collected
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="VaultX Collected">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Coordinator Collected
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Coordinator Collected">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>CC Fees
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="CC Fees">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Total Collected
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Total Collected">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
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
        @if($entity->number_participants != 0 && ($entity->participants->count() >= $entity->number_participants))
            <tr>
                <td colspan="8"><p style="color:red">Maximum number of participants has been reached</p></td>
            </tr>
        @endif
        </tfoot>
    </table>
    <div class="row">
        @if(!$entity->is_close)
            @if(\Auth::user())
                @if ($entity->user_id==\Auth::user()->id && ((count($event->participants)<$event->number_participants) || ($event->number_participants==0 && is_null($event->closed_date))))
                    <div class="col-xs-3">
                        <div class="form-group">
                            <a href="/participant/create?type={{get_class($entity)}}&id={{$entity->id}}&needable_sum={{$event->needable_sum}}"
                               class="btn btn-primary add-participant"><i class="glyphicon glyphicon-plus"></i>Coordinator
                                Payment
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
            @endif
            <div class="col-xs-3">
                @if((count($event->participants)<$event->number_participants || $event->number_participants==0)&& is_null($event->closed_date))
                    <div class="form-group">
                        <a href="{{route('payment',[$event])}}"
                           class="btn btn-primary make-payment"><i class="fa fa-paypal"></i> Make a Payment</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>