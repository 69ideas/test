Hello, {{$user->email}} !
<br>
You successfully created an Event <a href="{{route('event.show',$event)}}">"{{$event->short_description}}".</a>
<br>
Description: {{$event->description}}
<br>
Event Coordinator: {{$event->full_name}}
<br>
Coordinar's Email:{{$user->email}}
<br>
Start date: {{$event->start_date->format('m/d/Y')}}
<br>
Deadline:{{$event->deadline->format('m/d/Y')}}
<br>
Amount per person: {{$event->needable_sum}}
<hr>
Vault-X