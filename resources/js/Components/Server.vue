<template>
    <div class="col-span-1 border border-mh-500 p-4">
        <div class="flex justify-between items-start">
            <div>
                <h1>{{ server.name }}</h1>
                <h2>{{ server.version }}</h2>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <span :class="`badge ${server.running ? 'online' : 'offline'}`"></span>
                    <span class="pt-2">{{ server.running ? 'Online' : 'Offline' }}</span>
                </div>
                <p>{{ server.online_players }} players</p>
            </div>
        </div>
        <button type="button" class="url" v-if="server.url" @click.prevent="copy(server.url)">{{ server.url }}</button>
    </div>
</template>

<script>
export default {
    name: "Server",

    props: {
        server: {
            name: String,
            version: String,
            online_players: Number,
            url: String,
            running: Boolean,
        }
    },

    methods: {
        copy(url) {
            navigator.clipboard.writeText(url).then(() => {
                this.$toast.info(`${url} copied to clipboard.`)
            })
        }
    }
}
</script>

<style scoped>
h1 { @apply text-2xl font-bold; }
h2 { @apply text-xl font-semibold; }
.badge { @apply p-1.5 rounded-full; }
.online { @apply bg-green-400; }
.offline { @apply bg-red-400; }
.url {
    @apply text-mh-400 hover:text-white text-lg border-b border-mh-400 mt-4 px-2 rounded-sm hover:bg-mh-400;
    @apply hover:bg-opacity-30;
    @apply transition duration-150 ease-in-out;
}
</style>
