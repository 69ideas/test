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
        @forelse($entity->participants as $participant)
            <tr>
                <td>@if (isset($participant->deposit_date)){{$participant->deposit_date->format('m/d/Y')}}@endif</td>
                <td>@if(isset($participant->user_id)){{$participant->user->full_name}}@else Anonymous @endif</td>
                <td>{{ $participant->deposit_type }}</td>
                <td>{{ number_format($participant->vault_x_collected, 2) }}</td>
                <td>{{ number_format($participant->coordinator_collected, 2) }}</td>
                <td>{{ number_format($participant->commission, 2) }}</td>
                <td>{{ number_format($participant->total, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td class="bg-info text-center text-bold" colspan="18">
                    No participants attached to this {{$module}}
                </td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
        @if($entity->participants->count() > 0)
            <tr>

                <td colspan="3" style="text-align: right">Total:</td>
                <td>{{ number_format($entity->vault_x_collected, 2) }}</td>
                <td>{{ number_format($entity->coordinator_collected, 2) }}</td>
                <td>{{ number_format($entity->commission, 2) }}</td>
                <td>{{ number_format($entity->total, 2) }}</td>
            </tr>

        @endif
        </tfoot>
    </table>
</div>