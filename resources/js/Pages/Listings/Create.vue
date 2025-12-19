<template>
    <form @submit.prevent="create">
        <div>
            <div>
                <label for="">Beds</label>
                <input type="number" name="beds" v-model="form.beds" />
                <div>
                    <p v-if="form.errors.beds" class="text-red-500">{{ form.errors.beds }}</p>
                </div>
            </div>
            <div>
                <label for="">Baths</label>
                <input type="number" name="baths" v-model="form.baths" />
                <div>
                    <p v-if="form.errors.baths" class="text-red-500">{{ form.errors.baths }}</p>
                </div>
            </div>
            <div>
                <label for="">Area</label>
                <input type="number" name="area" v-model="form.area" />
                <div>
                    <p v-if="form.errors.area" class="text-red-500">{{ form.errors.area }}</p>
                </div>
            </div>
            <div>
                <label for="">City</label>
                <input type="text" name="city" v-model="form.city" />
                <div>
                    <p v-if="form.errors.city" class="text-red-500">{{ form.errors.city }}</p>
                </div>
            </div>
            <div>
                <label for="">Postal Code</label>
                <input type="text" name="postal_code" v-model="form.code" />
                <div>
                    <p v-if="form.errors.code" class="text-red-500">{{ form.errors.code }}</p>
                </div>
            </div>
            <div>
                <label for="">Street</label>
                <input type="text" name="street" v-model="form.street" />
                <div>
                    <p v-if="form.errors.street" class="text-red-500">{{ form.errors.street }}</p>
                </div>
            </div>
            <div>
                <label for="">Street number</label>
                <input type="number" name="street_nr" v-model="form.street_nr" />
                <div>
                    <p v-if="form.errors.street_nr" class="text-red-500">{{ form.errors.street_nr }}</p>
                </div>
            </div>
            <div>
                <label for="">Price</label>
                <input type="number" name="price" v-model="form.price" />
                <div>
                    <p v-if="form.errors.price" class="text-red-500">{{ form.errors.price }}</p>
                </div>
            </div>
            <button type="submit">Create</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    code: '',
    street: '',
    street_nr: 0,
    city: '',
    price: 0,
});

function create() {
    form.post(route('listings.store'));
}
</script>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px;
}
</style>