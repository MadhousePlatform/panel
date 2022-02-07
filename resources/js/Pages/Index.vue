<template>
    <x-head title="Welcome to Madhouse Miners"/>
    <portal to="page-header">
        Welcome to Madhouse Miners!
    </portal>
    <div>
        AHHHHHH
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import BaseLayout from "@/Layouts/BaseLayout";

export default defineComponent({
    components: {
        BaseLayout,
    },

    layout: BaseLayout,

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    }
})
</script>
