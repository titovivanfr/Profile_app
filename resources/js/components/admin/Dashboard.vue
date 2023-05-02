<template>
    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
        <router-link :to="{name: 'Add'}" class="text-blue-500 bg-gray-100 my-2 mr-4 rounded-lg transition-colors duration-200 hover:text-indigo-500 focus:outline-none float-right p-3">
            Add
        </router-link>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    id
                </th>
                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    Name
                </th>
                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    Bio
                </th>
                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  Actions
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
            <tr v-for="user in users">
                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ user.id }}</td>
                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                    <div class="flex items-center gap-x-2">
                        <img class="object-cover w-8 h-8 rounded-full" v-bind:src="user.avatar">
                        <h2 class="text-sm font-medium text-gray-800 dark:text-white">{{ user.first_name }} {{ user.last_name }}</h2>
                    </div>
                </td>
                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ user.bio }}</td>
                <td class="px-4 py-4 text-sm whitespace-nowrap">
                    <div class="flex items-center gap-x-6">
                        <router-link :to="{name: 'Edit', params: { id: user.id}}" class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                            Edit
                        </router-link>
                        <button class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none" @click="deleteProfile(user.id)">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: []
        }
    },
    mounted() {
        console.log(this.testFilter)
    },
    created() {
        axios.get('/api/stars/')
            .then(response => {
                this.users = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        deleteProfile(id) {
            if(confirm('Are sure want to delete this profile?')){
                axios
                    .delete(`/api/stars/${id}`)
                    .then(() => {
                        let i = this.users.map(data => data.id).indexOf(id);
                        this.users.splice(i, 1)
                    });
            }
        }
    }
}
</script>
