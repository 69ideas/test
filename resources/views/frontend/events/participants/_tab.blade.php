<div>
    <table class="searchable table table-bordered table-hover">
        <thead>
        <tr>
            <th>Date Collected
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Data when payment was made">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Name of Participant
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Name of the person who give money">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Method
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="How participant payed">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>Cash to Coordinator
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="How much coordinator got for this event">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>CC Fees
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="We use PayPal to process credit card.  PayPal fees are 2.9% plus 30 cents.">
                    <i class="fa fa-info-circle"></i>
                </small>
            </th>
            <th>VaultX Collected
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="VaultX fees are .5%, no less than 20 cents.">
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
            @if ($entity->isCoordinator(auth()->user()))
                <th>Refund
                    <small
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Mark payment as refunded">
                        <i class="fa fa-info-circle"></i>
                    </small>
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @forelse($entity->payed_participants as $participant)
            <tr>
                <td>@if (isset($participant->deposit_date)){{$participant->deposit_date->format('m/d/Y')}}@endif</td>
                <td>@if(isset($participant->user_id)){{$participant->user->full_name}}@else {{$participant->name}} @endif</td>
                <td>{{ $participant->deposit_type }}</td>
                <td>${{ number_format($participant->coordinator_collected, 2) }}</td>
                <td>${{ number_format($participant->cc_fees, 2) }}</td>
                <td>${{ number_format($participant->vxp_fees, 2) }}</td>
                <td>${{ number_format($participant->amount_deposited, 2) }}</td>
                @if ($entity->isCoordinator(auth()->user()))
                    <td><a href="{!! route('participant.refund', [$participant]) !!}">Refund</a></td>
                @endif
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
        @if($entity->payed_participants->count() > 0)
            <tr>
                <td colspan="3" style="text-align: right">Total:</td>
                <td>${{ number_format($entity->coordinator_collected, 2) }}</td>
                <td>${{ number_format($entity->commission, 2) }}</td>
                <td>${{ number_format($entity->vault_x_collected, 2) }}</td>
                <td>${{ number_format($entity->total, 2) }}</td>
                @if ($entity->isCoordinator(auth()->user()))
                    <td></td>
                @endif
            </tr>
        @endif
        @if($entity->number_participants != 0 && ($entity->payed_participants->count() >= $entity->number_participants) && $event->allow_anonymous)
            <tr>
                <td colspan="8"><p style="color:red">Maximum number of participants has been reached</p></td>
            </tr>
        @endif
        </tfoot>
    </table>
    <div class="col-sm-12">
        <div class="row form-group" style="padding-top: 2.5%;">
            @if(!$entity->is_close)
                @if ($entity->isCoordinator(auth()->user()) && ((count($event->payed_participants)<$event->number_participants) || ($event->number_participants==0 && is_null($event->closed_date))))

                    <a href="/participant/create?type={{get_class($entity)}}&id={{$entity->id}}&needable_sum={{$event->needable_sum}}&start_date={{$event->start_date->yesterday()}}"
                       class="btn btn-primary add-participant"><i class="glyphicon glyphicon-plus"></i>Enter a Cash
                        to Coordinator Payment
                        <small
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Payments made to coordinator in cash"
                        >
                            <i class="fa fa-info-circle"></i>
                        </small>
                    </a>
                @endif
                @if($is_guest)
                    @if(((count($event->payed_participants) < $event->number_participants || $event->number_participants==0)&& is_null($event->closed_date))&&$event->allow_anonymous)
                        <a href="{{route('payment',[$event])}}"
                           class="btn btn-primary make-payment alignright "><i class="fa fa-paypal"></i> Make a
                            Payment</a>
                    @endif
                @else
                    @if(((count($event->payed_participants) < $event->number_participants || $event->number_participants==0)&& is_null($event->closed_date)))
                        <a href="{{route('payment',[$event])}}"
                           class="btn btn-primary make-payment alignright"><i class="fa fa-paypal"></i> Make a
                            Payment</a>
                    @endif
                @endif
            @endif
        </div>
        <div class="row">
            <label style="padding-top: 0.5%;">Remaining Vaultx Balance :</label>

            @if ($entity->isCoordinator(auth()->user()))
            <a class="btn btn-primary pull-right" href="#" onclick="return false;">
                Clear VaultX Balance
                <small
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Please clear your VaultX balance through a VaultX transfer"
                >
                    <i class="fa fa-info-circle"></i>
                </small></a>
            @endif

            <hr>
        </div>
    </div>
</div>