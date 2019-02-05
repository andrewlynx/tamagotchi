<div class='col-md-3'>
    <a href="pet/{{$pet->id}}">
        <img src="img/{{strtolower($name)}}.jpg">
    </a>
</div>
<div class='col-md-3'>
    <p>Care: {{$pet->petCare->value}}</p>
    <p>Hunger: {{$pet->petHunger->value}}</p>
    <p>Sleepy: {{$pet->petSleeping->value}}</p>
</div>