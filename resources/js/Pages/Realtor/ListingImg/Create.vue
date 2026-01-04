<template>
    <!-- upload images -->
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <Box>
            <template #header>
                Upload new images
            </template>
            <div class="flex flex-col sm:flex-row gap-2 mt-4">
                <div class="flex-col">
                    <div class="flex items-center gap-1">
                        <label for="choose" class="form-label">Choose file</label>
                        <input ref="imgInputs" @change="e => form.images = e.target.files" type="file" id="choose"
                            class="form-input hover:bg-gray-50" multiple accept=".jpeg, .png, .jpg, .gif, .svg" />
                    </div>
                    <p v-if="uploadImgErrs.length" class="form-error mt-2">{{ uploadImgErrs[0] }}</p>
                </div>
                <div class="flex items-center gap-1">
                    <button class="submit-btn w-24" type="submit">Upload</button>
                    <button class="link-btn" type="reset" @click="cancel">Cancel</button>
                </div>
            </div>
        </Box>
    </form>

    <!-- display existing images -->
    <Box v-if="listing.listing_imgs.length">
        <template #header>
            Existing listing images
        </template>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <div v-for="img in listing.listing_imgs" :key="img.id" class="flex flex-col gap-2">
                <img :src="img.image_url" :alt="`Image ${img.id} for listing ${listing.id}`"
                    class="border rounded-md border-gray-300 shadow-lg" />
                <Link class="submit-btn" :href="route('realtor.listing.img.destroy', [listing.id, img.id])"
                    method="delete" as="button">Delete</Link>
            </div>
        </div>
    </Box>
</template>

<script setup>
import Box from '../../../Components/UI/Box.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    listing: Object,
});
const form = useForm({
    images: [],
});
const imgInputs = ref(null);
const uploadImgErrs = computed(() => {
    return Object.values(form.errors);
});

const submit = () => {
    form.post(
        route('realtor.listing.img.store', props.listing.id),
        {
            onSuccess: () => {
                // reset state
                form.reset('images')

                //reset file input
                if (imgInputs.value) {
                    imgInputs.value.value = null;
                }
            }
        });
};

const cancel = () => {
    form.reset('images');
};
</script>