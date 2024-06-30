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
    personData:{
        type:Object
    }
  
}); 
const form = useForm({
    name:props?.personData[0].name,
    address:props?.personData[0].address,
    image:props?.personData[0].image,
    email: props?.personData[0].get_contact.contact
});
const handleFileChange = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    form.post(route("person.update", props?.personData[0].id));
};

// const submit = () => {
// form.post("/update/"+props?.personData[0].id);
// };
</script>
<script>
import {ref} from 'vue'
export default {
    data(){
        return{
        }
    },
    methods:{
    },
    components:{
     
    },
 
}


</script>
<template>
    <div>
      <div>
        <!-- {{ personData[0].get_contact.contact }} -->
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
                        <InputLabel for="Email" value="Email" />
                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.email"
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
                        <img class="h-10 w-20" :src="'/persons/'+ (form.image)" alt=""> ​
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
