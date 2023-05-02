<template>
    <div class="container">
        <h1 class="text-center font-bold text-3xl mb-4">Profile Browser</h1>
        <div class="md:p-4 flex justify-center items-start h-screen">
            <ul class="w-full md:w-1/5 pt-5">
                <li v-for="(user,index) in stars" @click="star(user.id,index)" :key="index" class="md:first:border-t md:first:rounded-tl-lg md:last:rounded-bl-lg
                 border-b border-x border-gray-300 bg-gray-200 w-full py-2 md:px-8 px-4 cursor-pointer rounded-0 focus:bg-white-300 active:bg-white-300 text-start
                     focus:bg-white hover:bg-white active:bg-white focus:border-r-white hover:border-r-white active:border-r-white
                      z-30 focus:font-semibold hover:font-semibold active:font-semibold md:focus:border-b md:hover:border-b
                      active:border-b-0 focus:border-b-0 hover:border-b-0">
                    {{user.first_name}} {{user.last_name}}
                    <div v-if="show[index]" class="w-full md:hidden h-2/3 z-10 py-6" ref="toShow">
                        <img class="w-16 max-h-20 object-contain float-left border border-gray-300 p-2 shadow-lg mr-2" v-bind:src="user.avatar" alt="photo of profile">
                        <p class="font-normal">{{ user.bio }}</p>
                    </div>
                </li>
            </ul>
            <div class="border-l md:w-3/5 hidden md:block flex justify-start px-5 h-2/3 z-10 pt-4">
                <img class="w-36 h-1/3 object-contain float-left border border-gray-300 p-2 shadow-lg mr-2" v-bind:src="starProfile.avatar" alt="photo of profile">
                <h2 class="text-start font-bold text-xl mb-2">{{ starProfile.first_name }} {{ starProfile.last_name }}</h2>
                <p>{{ starProfile.bio }}</p>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'Home',
    data() {
        return {
            stars: {},
            starProfile: {},
            show: [],
        }
    },
    created() {
        axios.get('/api/stars')
            .then(response => {
                this.stars = response.data;
                this.starProfile = response.data[0];
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        star(id,index) {
            this.show = []
            this.stars.filter(x => x.id === id).map(x =>this.starProfile = x);
            this.show[index] = !this.show[index];

        }
    }

}
</script>
