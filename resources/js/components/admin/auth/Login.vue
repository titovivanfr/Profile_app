<template>
    <div class="w-full mx-auto relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
        <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
            relative z-10">
            <p class="w-full text-4xl font-medium text-center leading-snug font-serif">Sign up for an account</p>
            <form @submit="formSubmit" class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8">
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">
                        Email</p>
                    <input v-model="form.email" placeholder="123@ex.com" type="text" class="border placeholder-gray-400 focus:outline-none
                  focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                  border-gray-300 rounded-md" required/>
                </div>
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                  absolute">Password</p>
                    <input placeholder="Password" v-model="form.password" type="password" class="border placeholder-gray-400 focus:outline-none
                  focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                  border-gray-300 rounded-md" required/>
                </div>
                <div class="relative">
                    <button type="submit" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center
                    text-white bg-indigo-500 rounded-lg transition duration-200 hover:bg-indigo-600 ease">
                        Submit
                    </button>
                    <router-link :to="{name: 'Home'}" type="submit" class="mt-3 w-full inline-block pt-4 pr-5 pb-4 pl-5
                    text-xl font-medium text-center text-white bg-gray-500 rounded-lg transition duration-200 hover:bg-indigo-600 ease">
                        Back
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        formSubmit() {
            const config = {
                headers: {
                    'Content-Type': `multipart/form-data;`,
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }

            let form = new FormData
            form.append('email', this.form.email)
            form.append('password', this.form.password)
            axios.post('/api/login', form, config)
                .then(response => {
                    // Store the generated token in localStorage
                    localStorage.setItem('adminToken', response.data.token);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
}
</script>
