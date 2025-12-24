<template>
    <form @submit.prevent="login">
        <div class="mx-auto max-w-md">
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Email</label>
                <input class="col-span-8 form-input" type="email" name="email" v-model="form.email" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.email" class="form-error">{{ form.errors.email }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 items-center mb-2">
                <label class="col-span-4 form-label" for="">Password</label>
                <input class="col-span-8 form-input" type="password" name="password" v-model="form.password" />
                <div class="col-span-8 col-start-5">
                    <p v-if="form.errors.password" class="form-error">{{ form.errors.password }}</p>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-12">
                <button type="submit" class="submit-btn col-span-8 col-start-5 mx-auto">Login</button>
            </div>
        </div>
    </form>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
});

function login() {
    form.post(route('login'));
}
</script>