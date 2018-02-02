<template>
<div id="preloader" v-show="counter > 0">
    <img class="image" src="/images/loader.gif" alt="Loader">
</div>
</template>

<script>
export default {
    data(){
        return {
            counter: 0
        }
    },
    mounted(){
        axios.interceptors.request.use((config) => {
            this.counter++;
            return config;
        }, (error) => {
            return Promise.reject(error);
        });

        axios.interceptors.response.use((response) => {
            this.counter--;
            return response;
        }, (error) => {
            this.counter--;
            return Promise.reject(error);
        });
    }
}
</script>


<style>
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.5);
}

#preloader .image{
    position: absolute;
    top: 50%;
    left: 50%;
    width: 70px;
    height: 70px;
    transform: translate(-50%, -50%);
    border: solid 3px #34495e;
    background: #fff;
    border-radius: 100%;
    overflow: hidden;
}
</style>