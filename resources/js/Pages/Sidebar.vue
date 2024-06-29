<template>
    <aside class="" style="position:absolute; z-index:999; left:0; width:20%; height:100%">
        <div class="title text-white text-center p-4">
            <h1><b>PRAXXYS</b></h1>
        </div>
        <div class="item">
            <ul class="list-group">
                <Link href="/dashboard"><li class="list-group-item text-center">Home</li></Link>
                <Link href="/create_product_view"><li class="list-group-item text-center">Create</li></Link>
                <Link href="/video/video1.mp4"><li class="list-group-item text-center">Video</li></Link>

              </ul>
        </div>

       </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<style scoped>
aside{
    background:#343a40;
    display: row;
    justify-content: center;
    align-items: center;
    max-height:1000vh;
    position: absolute;

}
.list-group{
    display: grid;
    gap:10px;

}
.list-group-item{
    background-color:transparent;
    border:0;
    color:rgb(235, 231, 231);
    transition: all linear 0.2s;
}
.list-group-item:hover{
    background: rgb(124, 124, 124);
}
</style>
