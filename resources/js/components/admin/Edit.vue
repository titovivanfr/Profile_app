<template>
    <div class="w-full mx-auto relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
        <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
            relative z-10">
            <p class="w-full text-4xl font-medium text-center leading-snug font-serif">Update star</p>
            <p class="w-full text-4xl font-medium text-center leading-snug font-serif">id : {{$route.params.id}}</p>
            <form @submit="formSubmit" enctype="multipart/form-data" class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8">
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                         First name</p>
                    <input v-model="form.first_name" placeholder="some name" type="text" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md" required/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                        Last name</p>
                    <input v-model="form.last_name" placeholder="some name" type="text" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md" required/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                        Bio</p>
                    <textarea v-model="form.bio" placeholder="some text" type="text" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md"/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
              absolute">Avatar</p>
                    <input @change="handleFileUpload" type="file" id="image" ref="image" placeholder="Avatar" accept="image/*" class="border placeholder-gray-400 focus:outline-none
              focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
              border-gray-300 rounded-md" required/>
                </div>
                <div class="relative">
                    <button type="submit" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-indigo-500
              rounded-lg transition duration-200 hover:bg-indigo-600 ease">Submit
                    </button>
                    <router-link :to="{name: 'Dashboard'}" type="submit" class="mt-3 w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-gray-500
              rounded-lg transition duration-200 hover:bg-indigo-600 ease">Back
                    </router-link>
                </div>
            </form>
            <h4 class="mx-auto mt-3 text-red-500 font-bold" v-if="form.success">{{form.success}}</h4>
        </div>
    </div>
</template>
<script>


export default {
    name: 'Edit',
    data() {
        return{
            form: {
                first_name: '',
                last_name: '',
                bio: '',
                image: '',
                success: null,
            }
        }
    },
    methods: {
        handleFileUpload() {
            this.form.image = this.$refs.image.files[0]
        },
        formSubmit() {
            const config = {
                headers:{
                    'Content-Type': `multipart/form-data;`,
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
            let form = new FormData
            form.append('image', this.form.image)
            form.append('firstName', this.form.first_name)
            form.append('lastName', this.form.last_name)
            form.append('bio', this.form.bio)

            axios.post(`/api/stars/edit/${this.$route.params.id}`, form, config)
                .then(response => {
                    this.form.success = response.data
                })
                .catch(function (err) {
                    console.log("Error", err)
                })
        },
    },
    created() {
        axios.get(`/api/stars/${this.$route.params.id}`)
            .then(response => {
                this.form = response.data;
            })
            .catch(function (err) {
                console.log("Error", err)
            })
    }
}
</script>
