<template>
    <div class="w-full mx-auto relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
        <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
            relative z-10">
            <p class="w-full text-4xl font-medium text-center leading-snug font-serif">Add profile</p>
            <form @submit="formSubmit" enctype="multipart/form-data" class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8">
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                        First name</p>
                    <input v-model="name" placeholder="some name" type="text" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md"/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                        Name</p>
                    <input v-model="name" placeholder="some name" type="text" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md"/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                        Bio</p>
                    <textarea v-model="bio" placeholder="some text" type="text" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md"/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
              absolute">Avatar</p>
                    <input @change="handleFileUpload" type="file" id="image" ref="image" placeholder="Avatar" accept="image/*" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md"/>
                </div>
                <div class="relative">
                    <button type="submit" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-indigo-500
              rounded-lg transition duration-200 hover:bg-indigo-600 ease">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

export default {
    name: 'Add',
    data() {
        return {
            name: '',
            bio: '',
            image: '',
        };
    },
    methods: {
        handleFileUpload(event) {
            this.file = event.target.files[0]
        },
        formSubmit(e) {
            e.preventDefault();
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let formData = new FormData();
            formData.append('image', this.$refs.image.files[0]);
            formData.append('name', this.name);
            formData.append('bio', this.bio);
            axios.post(`/api/profile/`, formData, config)
                .then(function () {
                })
                .catch(function (err) {
                    console.log("Error")
                })
        }
    }
}
</script>
