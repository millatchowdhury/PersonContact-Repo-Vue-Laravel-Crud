<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import CreateContact from "./CreateContact.vue";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const persons = ref([]);
const isToggle = ref(false);
const props = defineProps({
    blogs: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: "",
    address: "",
    image: "",
});
function getImage(e){
    form.image = e.target.files[0];
}

const submit = () => {
    persons.value.push(form);
    isToggle.value = !isToggle.value;
};

</script>

<template>
    <Head title="Blog Create" />

  <div v-if="!isToggle">
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Person Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <InputLabel for="Address" value="Address" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.address"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <InputLabel for="Image" value="Image" />
                                <input type="file" name="image" @change="getImage">

                               
                            </div>

                            
                            <PrimaryButton
                                type="submit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Submit
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
  </div>
  <div v-else="">
    <CreateContact v-bind:persons="persons"/>
  </div>
</template>