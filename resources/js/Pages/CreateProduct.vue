<template>
    <div class="create" style="display: flex">
        <Sidebar />
        <div class="card card-primary" style="width: 50rem; margin: auto">
            <div class="card-header bg-dark">
                <h3 class="card-title text-white">Create Form</h3>
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
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Enter Name"
                            v-model="input.name"
                        />
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select
                            v-model="input.category"
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
                            name=""
                            id=""
                            cols="30"
                            rows="5"
                            class="form-control"
                            v-model="input.description"
                        ></textarea>
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
                                    v-model="input.date"
                                />
                            </div>
                            <div class="col">
                                <label>Time</label>
                                <input
                                    type="Time"
                                    class="form-control"
                                    id=""
                                    placeholder="Enter Name"
                                    v-model="input.time"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input
                            type="File"
                            class="form-control"
                            multiple
                            placeholder="Enter Name"
                            @change="image"
                        />
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

//validation and input fields
const validation = ref({});
const input = ref({
    name: "",
    category: "",
    description: "",
    image: "",
    date: "",
    time: "",
});

//get the image file
const file = ref(null);
const image = (event) => {
    const imageFile = event.target.files[0];
    if (imageFile) {
        file.value = imageFile;
    }
};

//submit form 
const submit = async () => {
    await axios.get("/sanctum/csrf-cookie");
    await axios({
        method: "POST",
        url: "/create_product",
        data: {
            name: input.value.name,
            category: input.value.category,
            description: input.value.description,
            date: input.value.date,
            time: input.value.time,
            image: file.value,
        },
        headers: {
            "content-type": "multipart/form-data",
        },
    })
        .then((response) => {
            if (response.status === 200) {
                window.location = "/dashboard";
            }
        })
        .catch((er) => {
            validation.value = er.response.data.errors;
            console.log(er);
        });
};
</script>

<style scoped></style>
