<template>
    <form @submit.prevent="create">
        <div class="mx-auto max-w-md">
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Beds</label>
                <input class="col-span-8 form-input" type="number" name="beds" v-model="form.beds" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.beds" class="form-error">{{ form.errors.beds }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Baths</label>
                <input class="col-span-8 form-input" type="number" name="baths" v-model="form.baths" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.baths" class="form-error">{{ form.errors.baths }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Area</label>
                <input class="col-span-8 form-input" type="number" name="area" v-model="form.area" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.area" class="form-error">{{ form.errors.area }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">City</label>
                <input class="col-span-8 form-input" type="text" name="city" v-model="form.city" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.city" class="form-error">{{ form.errors.city }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Postal Code</label>
                <input class="col-span-8 form-input" type="text" name="postal_code" v-model="form.code" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.code" class="form-error">{{ form.errors.code }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Street</label>
                <input class="col-span-8 form-input" type="text" name="street" v-model="form.street" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.street" class="form-error">{{ form.errors.street }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Street number</label>
                <input class="col-span-8 form-input" type="number" name="street_nr" v-model="form.street_nr" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.street_nr" class="form-error">{{ form.errors.street_nr }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Price</label>
                <input class="col-span-8 form-input" type="number" name="price" v-model="form.price" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.price" class="form-error">{{ form.errors.price }}</p>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-12">
                <button type="submit" class="submit-btn col-span-8 col-start-5 mx-auto">Create new</button>
            </div>
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