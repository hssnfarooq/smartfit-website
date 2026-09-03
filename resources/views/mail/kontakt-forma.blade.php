<h2><span style="color: blueviolet">{{$title}}</span> has submited web contact form.</h2>

<div style="padding: 3px 0"><strong>Name:</strong> {{$title}}</div>
<div style="padding: 3px 0"><strong>Email:</strong> {{$email}}</div>
<div style="padding: 3px 0"><strong>Phone:</strong> {{$phone}}</div>
<div style="padding: 3px 0"><strong>Subject:</strong> {{$subject}}</div>

<div style="padding: 10px 0">
<strong>Message/Question:</strong>
<div>{!!nl2br($question)!!}</div>
</div>