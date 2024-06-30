<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    person:{
        type:Object
    }
  
}); 
const form = useForm({
    name:props?.person[0].name,
    address:props?.person[0].address,
    avatar:props?.person[0].avatar,
});
const handleFileChange = (event) => {
    form.avatar = event.target.files[0];
};

const submit = () => {
form.post(route("person.update.store"));
};
</script>
<script>
import CreateEmailToggle from './CreateEmailToggle.vue'
import {ref} from 'vue'
export default {
    data(){
        return{
        }
    },
    methods:{
    },
    components:{
        CreateEmailToggle
    },
 
}


</script>
<template>
    <div>
      <div>
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
                        <InputLabel for="avatar" value="Old Avatar" />
                        <img class="h-10 w-20" :src="'/persons/'+ (form.avatar)" alt=""> ​
                    </div>
                      <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"  
                        >
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </GuestLayout>
        </div>    
   </div>
</template>
