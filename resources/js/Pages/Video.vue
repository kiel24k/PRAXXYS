<template>
    <div class="create" style="display: flex">
        <Sidebar />
        <div
            class="card card-primary"
            style="width: auto; margin: auto; margin-top: 50px"
        >
            <p style="font-size: 25px; font-weight: 500; text-align: center">
                Video Test
            </p>
            <video
                ref="videoPlayer"
                class="video-js vjs-default-skin"
                controls
                preload="auto"
                width="640"
                height="264"
            >
                <source
                    :src="`/videos/${props.res.original}`"
                    type="video/mp4"
                />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider
                    upgrading to a web browser that
                    <a
                        href="https://videojs.com/html5-video-support/"
                        target="_blank"
                        >supports HTML5 video</a
                    >
                </p>
            </video>
        </div>
    </div>
</template>

<script setup>
import Sidebar from "./Sidebar.vue";
import { ref, onMounted, onBeforeUnmount } from "vue";
import videojs from "video.js";
import "video.js/dist/video-js.css";


//video testing via URL
//video1.mp4 and video2.mp4 is available on public/videos
const videoPlayer = ref(null);
let player = null;
const props = defineProps({
    res: Array,
});

onMounted(() => {
    player = videojs(videoPlayer.value, {
        autoplay: false,
        controls: true,
        sources: [
            {
                src: `/videos/${props.res.original}`,
                type: "video/mp4",
            },
        ],
    });
});
onBeforeUnmount(() => {
    if (player) {
        player.dispose();
    }
});
</script>
