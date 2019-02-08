<div class='col-md-3' v-bind:class="deadFrame(pet.pet_hunger.value)">
    <img :src="'/img/' + pet.name.toLowerCase() + '.jpg'">
</div>
<div class='col-md-3'>
    <h2>@{{pet.name}}</h2>
    <div class="attribute">
        Care: @{{pet.pet_care.value}}
        <div v-bind:style="{ width: pet.pet_care.value + '%' }" class="progress" v-bind:class="makeClass(pet.pet_care.value)"></div>
    </div>
    <button v-on:click="care(pet.id)" class="btn btn-sm btn-outline-primary" :disabled="pet.pet_care.value > 95">Lets play!</button>
    <div class="attribute">
        Hunger: @{{pet.pet_hunger.value}}
        <div v-bind:style="{ width: pet.pet_hunger.value + '%' }" class="progress" v-bind:class="makeClass(pet.pet_hunger.value)"></div>
    </div>
    <button v-on:click="feed(pet.id)" class="btn btn-sm btn-outline-primary" :disabled="pet.pet_hunger.value > 95">Take some food</button>
    <div class="attribute">
        Sleepy: @{{pet.pet_sleeping.value}}
        <div v-bind:style="{ width: pet.pet_sleeping.value + '%' }" class="progress" v-bind:class="makeClass(pet.pet_sleeping.value)"></div>
    </div>
    <button v-on:click="sleep(pet.id)" class="btn btn-sm btn-outline-primary" :disabled="pet.pet_hunger.value > 90">Go sleep</button>
</div>