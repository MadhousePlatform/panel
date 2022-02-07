<template>
    <x-head title="Welcome to Madhouse Miners"/>
    <portal to="page-header">
        Welcome to Madhouse Miners!
    </portal>
    <div>
        <h1 class="text-5xl text-mh-500 mb-6">
            Welcome to Madhouse Miners!
        </h1>

        <fieldset v-for="type in servers">
            <legend class="block mb-4">
                <span class="name">{{ type.group }}</span>
                <span class="text-zinc-300 pl-2">(or use <code>{{ type.discord_command }}</code> in Discord)</span>
                <span class="url text-zinc-300" v-if="type.url">{{ type.url }}</span>
            </legend>
            <div class="grid grid-cols-4 space-x-4">
                <x-server :server="server" v-for="server in type.servers"/>
            </div>
        </fieldset>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import BaseLayout from "@/Layouts/BaseLayout";
import Server from "@/Components/Server";

export default defineComponent({
    components: {
        XServer: Server,
        BaseLayout,
    },

    layout: BaseLayout,

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },

    data() {
        return {
            servers: [
                {
                    "group": "Vanilla Minecraft Servers",
                    "url": "vanilla.madhouseminers.com",
                    "discord_command": "!vanilla",
                    "servers": [
                        {
                            "name": "Hub",
                            "version": "1.16.1",
                            "running": true,
                            "online_players": 0
                        },
                        {
                            "name": "Games",
                            "version": "1.16.1",
                            "running": false,
                            "online_players": 0
                        },
                        {
                            "name": "Survival",
                            "version": "1.16.1",
                            "running": false,
                            "online_players": 0
                        },
                        {
                            "name": "Skyblocks",
                            "version": "1.16.1",
                            "running": false,
                            "online_players": 0
                        }
                    ]
                },
                {
                    "group": "Modded Minecraft Servers",
                    "discord_command": "!modded",
                    "servers": [
                        {
                            "name": "MC Eternal",
                            "version": "1.3.7.1",
                            "running": true,
                            "online_players": 2,
                            "url": "eternal.madhouseminers.com"
                        },
                        {
                            "name": "Engineers Life",
                            "version": "2.03",
                            "running": true,
                            "online_players": 0,
                            "url": "engineers.madhouseminers.com"
                        },
                        {
                            "name": "Antimatter",
                            "version": "1.2.32",
                            "running": false,
                            "online_players": 0,
                            "url": "antimatter.madhouseminers.com"
                        }
                    ]
                }
            ]
        }
    }
})
</script>

<style scoped>
fieldset { @apply mb-4; }
.name { @apply text-3xl font-bold; }
.url { @apply block my-1 text-lg text-zinc-300; }
</style>
