<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <form  @submit.prevent="submit" >
            <div class="w-full mt-4 p-10">
                <button
                    type="button"
                    class="flex justify-start ml-2 rounded-md border px-3 py-2 bg-pink-600 text-white"
                    @click="addMore()"
                >

                    Add More
                </button>
                <div v-for="(course, index) in courses" :key="index">
                    <div class="flex justify-start ml-2 mt-4">
                        <input
                            v-model="form.email"
                            placeholder="enter email of phone"
                            class="w-full py-2 border border-indigo-500 rounded"
                        />
                        <button
                            type="button"
                            class="ml-2 rounded-md border px-3 py-2 bg-red-600 text-white"
                            @click="remove(index)"
                            v-show="index != 0"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            </div>
            <button class="bg-gray-400 p-1 ml-14" type="submit">Submit</button>
        </form>
    </div>
</template>
<script setup>
import {ref} from 'vue'
import {  useForm } from "@inertiajs/vue3";
const props = defineProps({
    persons:Object,
    id: {
        type: Number,
        required: true,
      }
});
const form = useForm({
    email:"",
    person:props?.persons
});
const submit = () => {
    form.post(route("person.store"));
};
</script>
<script>

export default {
    name: "HelloWorld",
    data() {
        return {
            courses: [
                {
                    Email: "",
                },
            ]
        };
    },
    methods: {
        addMore() {
            this.courses.push({
                Email: "",
            });
        },
        remove(index) {
            this.courses.splice(index, 1);
        },
    },
};


</script>
