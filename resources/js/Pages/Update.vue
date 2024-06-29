<template>
    <div class="create" style="display: flex">
        <Sidebar />
        <div class="card card-primary" style="width: 50rem; margin: auto">
            <div class="card-header bg-dark">
                <h3 class="card-title text-white">Update Form</h3>
            </div>
            <form
                action=""
                @submit.prevent="submit"
                enctype="multipart/form-data"
            >
                <div class="card-body">
                    <div
                        class="validation"
                        v-for="error in validation"
                        :key="error"
                    >
                        <li class="text-danger">{{ error[0] }}</li>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input
                        v-model="currentData.name"
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Enter Name"

                        />
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select
                        v-model="currentData.category"
                            class="form-control"
                            style="width: 100%"
                        >
                            <option>prod1</option>
                            <option>prod2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea
                        v-model="currentData.description"
                            name=""
                            id=""
                            cols="30"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input
                            type="File"
                            class="form-control"
                            multiple
                            placeholder="Enter Name"
                            @change="updateImage"
                        />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Date</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id=""
                                    placeholder="Enter Name"
                                    v-model="currentData.date"
                                />
                            </div>
                            <div class="col">
                                <label>Time</label>
                                <input
                                    type="Time"
                                    class="form-control"
                                    id=""
                                    placeholder="Enter Name"
                                    v-model="currentData.time"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref, watch } from "vue";
import Sidebar from "./Sidebar.vue";


const props = defineProps({
    haha: {
        type: Array
    },
});

const currentData = ref({
    id: '',
    name: '',
    category: '',
    description: '',
    image: null,
    date: '',
    time: '',
})
const updateImage  = (event) => {
    const updatedFile = event.target.files[0];
    if(updatedFile){
        currentData.value.image = updatedFile;
    }
}

onMounted(() => {
     currentData.value = props.haha.original
})

//validation and input fields
const validation = ref({});

//get the image file
const file = ref(null);

//get the current value


//submit form method
const submit = async () => {
    await axios.get("/sanctum/csrf-cookie");
    await axios({
        method: "POST",
        url: `/update_product/${currentData.value.id}`,
        data: {
            name: currentData.value.name,
            category: currentData.value.category,
            description: currentData.value.description,
            date: currentData.value.date,
            time:currentData.value.time,
            image: currentData.value.image,
        },
        headers: {
            "content-type": "multipart/form-data",
        },
    })
        .then((response) => {
            console.log(response);
           if(response.status == 200){
            window.location= '/dashboard'
           }
        console.log(response);
        })
        .catch((er) => {
            console.log(er);
             if (er.response.status == 422){
                validation.value = er.response.data.errors
                console.log(er.response.data.errors);
             }
        });
};
</script>

<style scoped></style>
