<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";



const props = defineProps({
    // persons: {
    //     type: Object,
    //     default: () => ({}),
    // },
    persons:Object,
    id: {
        type: Number,
        required: true,
      }
});

const form = useForm({
    email: "",
    persons: props?.persons
});

const submit = () => {
    form.post(route("person.store"));
};

</script>

<template>
    <Head title="Blog Create" />

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
                               <InputLabel for="Email" value="Email" />
                               <input type="email" v-model="form.email" placeholder="Email Or Phone"> 
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
</template>