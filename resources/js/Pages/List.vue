<template>
    <div style="display: flex">
        <Sidebar />
        <div
            class="card-body"
            style="position: absolute; z-index: 999; right: 0; width: 80.5%"
        >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div
                                    class="category text-start"
                                    style="
                                        display: flex;
                                        gap: 10px;
                                        align-content: center;
                                        align-items: center;
                                    "
                                >
                                    <b>Category: </b
                                    ><select id="ss" v-model="category">
                                        <option value="all">All</option>
                                        <option value="prod1">Prod1</option>
                                        <option value="prod2">Prod2</option>
                                    </select>
                                    <Link
                                        href="/create_product_view"
                                        class="btn btn-success"
                                        method="get"
                                        >Create</Link
                                    >
                                    <input
                                        type="text"
                                        id="search"
                                        placeholder="Search"
                                        v-model="search"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table
                                class="table table-bordered table-striped table-hover"
                            >
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th style="text-align: center">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="data in result" :key="data.id">
                                        <td>
                                            <img
                                                :src="`uploads/${data.image}`"
                                                width="50px"
                                                height="50px"
                                                alt=""
                                            />
                                        </td>
                                        <td>{{ data.name }}</td>
                                        <td>{{ data.description }}</td>
                                        <td>{{ data.category }}</td>
                                        <td>{{ data.date }}</td>
                                        <td>{{ data.time }}</td>
                                        <td style="text-align: center">
                                            <Link
                                                :href="`/update_product_view/${data.id}`"
                                                class="m-1"
                                            >
                                                <button class="btn btn-info">
                                                    <span
                                                        style="
                                                            display: flex;
                                                            gap: 5px;
                                                        "
                                                    >
                                                        <img
                                                            src="/icon/326602_create_edit_pencil_write_icon - Copy - Copy.png"
                                                            width="20px"
                                                            alt=""
                                                        />
                                                    </span>
                                                </button>
                                            </Link>
                                            <button
                                                class="btn btn-danger m-1"
                                                @click.prevent="
                                                    deleteProduct(data.id)
                                                "
                                            >
                                                <span
                                                    style="
                                                        display: flex;
                                                        gap: 5px;
                                                    "
                                                >
                                                    <img
                                                        src="/icon/1564502_basket_delete_remove_icon.png"
                                                        width="20px"
                                                        alt=""
                                                    />
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="error text-danger text-center" v-if="noData">
                <h1>OOPS!! No data found!</h1>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import Sidebar from "./Sidebar.vue";

const category = ref("");
const noData = ref(false);
const search = ref("");
const productData = ref({});
const result = ref({});

//display latest product
onMounted(async () => {
    await axios.get("/all_product_list").then((response) => {
        result.value = response.data;
    });
});

//delete product using ID
const deleteProduct = async (id) => {
    await axios.get(`/remove_product/${id}`);
    await axios.get("/all_product_list").then((response) => {
        result.value = response.data;
        alert("remove successful!");
    });
};

//display product per category
watch(
    category,
    async () =>
        await axios.get(`/productCategory/${category.value}`).then((res) => {
            result.value = res.data;
        }),
);

//display all product with (ALL CATEGORY)
watch(category, async () => {
    if (category.value == "all") {
        await axios.get("/all_product_list").then((response) => {
            result.value = response.data;
        });
    }
});

//Search product
watch(search, async () => {
    await axios
        .get(`/product_search/${search.value}`)
        .then((response) => {
            result.value = response.data;
            noData.value = false;
            if (productData.value == "") {
                noData.value = true;
            }
        })
        .catch((error) => {
            return 0;
        });
});

//Empty result search
watch(search, async () => {
    if (search.value == "") {
        await axios.get("/all_product_list").then((response) => {
            result.value = response.data;
            noData.value = false;
        });
    }
});
</script>

<style scoped>
#input:focus {
    outline: none;
    border: 0;
    border-color: red;
    border: transparent;
}
#search {
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    border-width: 2px;
    background: transparent;
    color: gray;
}
</style>
