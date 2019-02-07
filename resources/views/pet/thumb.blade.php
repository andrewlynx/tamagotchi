<div class='col-md-3'>
    <img :src="'/img/' + pet.name.toLowerCase() + '.jpg'">
</div>
<div class='col-md-3'>
    <p>Care: @{{pet.pet_care.value}}</p>
    <p>Hunger: @{{pet.pet_hunger.value}}</p>
    <p>Sleepy: @{{pet.pet_sleeping.value}}</p>
</div>