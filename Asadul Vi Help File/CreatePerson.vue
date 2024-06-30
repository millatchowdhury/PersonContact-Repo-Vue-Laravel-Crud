<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
  
}); 
</script>
<script>
import CreateEmailToggle from './CreateEmailToggle.vue'
import {ref} from 'vue'
const persons = ref([])
const isToggle = ref(false)
const avatar = ref('')

export default {
    data(){
        return{
        }
    },
    methods:{
    },
    components:{
        CreateEmailToggle
    }
}

const form = useForm({
    name: "",
    address: "",
    avatar: '',
});
const handleFileChange = (event) => {
    console.log(event.target.files[0])
    form.avatar = event.target.files[0];
};

const submit = () => {
persons.value.push(form)
isToggle.value = !isToggle.value
};
</script>
<template>
    <div>
      <div v-if="!isToggle">
        <GuestLayout>
                <Head title="Person in" />
                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="address" value="address" />

                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.address"
                        />
                    </div>
                    <div>
                        <InputLabel for="avatar" value="avatar" />

                        <TextInput
                            id="avatar"
                            type="file"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username"
                            @change="handleFileChange"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.avatar"
                        />
                    </div>
                      <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"  
                        >
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </GuestLayout>
        </div>   
        <div v-else>
          <CreateEmailToggle v-bind:persons="persons"/>   
        </div> 
   </div>
</template>
